<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sitio extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		//inicio sesion de usuario preguntandole al modelo
		$this->UsuarioSession = $this->usuarios_model->isLogin();

	}


	public function index(){
		
		if($this->UsuarioSession){
			$data['usuario'] = $this->UsuarioSession['nombre'];
			$data['usuarioSession'] = $this->UsuarioSession;
		}
		$seccion = "servicios-solicitados";

		$destacados  	 = $this->servicios_model->getServiciosDestacados();
		$solicitados 	 = $this->_setPagSolicitados($seccion);
		// print_d($this->db->last_query());
		if(!empty($destacados)){
			$data['destacados'] = $destacados;
		}else{
			$data['destacados'] = null;
		}

		if(!empty($solicitados)){
			$data['solicitados'] = $solicitados['result'];
		}else{
			$data['solicitados'] = null;
		}

		$data['paginacion'] = $solicitados['links'];
		$data['vista'] = 'index_view';
		$data['current_page'] = $solicitados['current_page'];

		if ($this->input->is_ajax_request()) {
			$this->load->view('servicios_solicitados',$data);
		
		}else{
			$this->load->view('home_view',$data);
       
		}
	}

	public function comentar_servicio(){
	
		$usuario 		= $this->UsuarioSession;
		$post 			= $this->input->post();
		$id_servicio 	= $this->input->post('id_servicio');
		$id_usuario  	= $usuario['id'];
		$comentario 	= $this->input->post('comentario');
		$validacion 	= $this->_validar_consulta($usuario);


		if($validacion['error'] == false){
			
			$post['nombreUsuario'] = $usuario['nombre'];
			$post['telUsuario']    = $usuario['telefono'];
			$post['emailUsuario']  = $usuario['email'];

			$email = $this->sendContacto($post);
			if($email){
				$this->servicios_model->setConsultaServicio($id_servicio, $id_usuario, $comentario);
			}
			else
			{
				$validacion['mensaje'] = 'No se ha podido enviar su consulta. Intente mas tarde.';
			}
		
		}

		echo json_encode($validacion);

	}


	public function recomendar_servicio(){
		$fechaHoy      =  date('Y-m-d');
		$userID		   = (!($this->UsuarioSession)) ? $this->uri->segment(4) : 0; ;
		$post 		   = $this->input->post();
		$json 		   = $this->_validar_recomendacion();


		$user = $this->UsuarioSession;
		if($user){
			$userID = $user['id'];
		}else{
			$userID = "null";
		}
		
		if(!$json['error']){
			$this->servicios_model->setRecomendacion($userID ,$post);
			$this->sendRecomendacion($post);
		}

		
		echo json_encode($json);


	}

	private function _validar_recomendacion(){

		$json = array();
	 	$this->form_validation->set_rules('nombreAmigo', 'nombreAmigo', 'trim|required');
	 	$this->form_validation->set_rules('emailAmigo', 'emailAmigo', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{
			$json['error'] 	 = true;
			$json['mensaje'] = "Error en la validacion del formulario";

		}
		else
		{
			$json['error'] 	 = false;
			$json['mensaje'] = "Recomendación enviada con exito. Gracias por recomendar este servicio.";
		}

		return $json;
	}

	private function _validar_consulta($usuario){
		if(!empty($usuario)){
				$this->form_validation->set_rules('comentario', 'comentario', 'trim|required|xss_clean');
				if($this->form_validation->run() == FALSE){
					$comentario_result = array(
					'error' => true,
					'mensaje'=>'Por favor ingrese un comentario.',
					 );		
				}else{
					$comentario_result = array(
					'error' => false,
					'mensaje'=>'Su consulta ha sido enviado exitosamente.',
					 );
				}
		}else{
			$comentario_result = array('error' => true, 'mensaje'=> 'Por favor ingrese al sitio o registrese');
		}
		return $comentario_result;
	}

	public function busqueda_servicio(){
		 $data = $this->servix_model->getBusquedaServicio();
		 $arrayDatos = array();
		 foreach ($data as $d) {
		 	$arrayDatos[] = ucfirst($d['titulo']);
		 }
		 echo  json_encode($arrayDatos);
	}
	public function busqueda_categoria(){
		 $data = $this->servix_model->getBusquedaCategoria();
		 $arrayDatos = array();
		 foreach ($data as $d) {
		 	$arrayDatos[] = ucfirst($d['categoria']);
		 }
		 echo  json_encode($arrayDatos);
	}

	public function busqueda_localidades_buscador(){
		$data = $this->servix_model->geBusquedaLocalProvBuscador();
		 $arrayDatos = array();
		 foreach ($data as $d) {
		 	if($d['localidad']==$d['provincia']){
		 		$d['provincia'] = '';
		 	}
		 	$loc = $d['localidad'].", ".$d['provincia'];
		 	$arrayDatos[] = trim($loc,", ") ;
		 }
		 echo  json_encode($arrayDatos);
	}

	public function busqueda_localidades(){
	
		$data = $this->servix_model->geBusquedaLocalProv($this->input->post('q'));
		 foreach ($data as $d) {
		 	$provLoc 	  = $d['localidad'].", ".$d['provincia'];
		  	$arrayDatos []= array('localidad'=>$provLoc , 'idLoc'=> $d['id']);
		}
			echo  json_encode($arrayDatos);
	}

	


	public function condiciones_de_uso(){
		echo "condiciones_de_uso";  		
	}

	public function preguntas_frecuentes(){
		echo "preguntas_frecuentes";  	
	}

	public function solicitar_servicio(){
		// $this->load->view('home_view');
		$data['buscador_off'] = true;
		if($this->UsuarioSession){
			$data['usuario'] = $this->UsuarioSession['nombre'];
			$data['usuarioSession'] = $this->UsuarioSession;
		}
		$data['vista'] = 'solicitar_servicio';



		$this->load->view('home_view',$data);
	}

	public function validar_solicitud_servicio(){
		$POST = $this->input->post();
		if( isset($POST) ){
			$catPOST = strtolower($this->input->post('categoria'));

			$post['categoria'] = $catPOST;
			$categoria = $this->servix_model->getCategoria($catPOST);
			$fecha_ini = date('Y-m-d H:i:s');
			$fecha_fin = strtotime(str_replace('/', '-', $this->input->post('fecha_fin') ));
			$fecha_fin = date('Y-m-d H:i:s' , $fecha_fin);
			$POST['fecha_ini']  = $fecha_ini;
			$POST['fecha_fin']  = $fecha_fin;
			$POST['id_usuario']   = $this->UsuarioSession['id'];

			if(!empty($categoria)){
				$POST['id_categoria'] = $categoria[0]['id'];
				$POST['cat_en_db'] = 'null';
				$rs = $this->_set_servicio_solicitado($POST);
			}else{

				$POST['id_categoria'] = 40;

				$POST['cat_en_db'] = $this->_set_cat_nodb($POST);
				$rs = $this->_set_servicio_solicitado($POST);
			}
			
	
			$displayErros = array();

			if($rs){
				$displayErros = array('mensaje_e'=> 'Gracias por publicar tu solicitud en Servix' , 'error' => 0);

				$this->session->set_flashdata('mensaje_e', $displayErros);

			}else{

				$displayErros = array('mensaje_e'=> 'Ups.. tenemos un problema por favor intenta más tarde' , 'error' => 1);

				$this->session->set_flashdata('mensaje_e', $displayErros);
			}
			return redirect($_SERVER['HTTP_REFERER']);

		}else{
			return redirect('');
		}
	}

	private function _set_servicio_solicitado($post){

		$insert = $this->servix_model->setSolicitarServicio($post['id_categoria'],$post['id_usuario'],$post['localidad'],$post['cat_en_db'],$post['fecha_ini'],$post['fecha_fin'],$post['comentario']);
		return $insert;
	}

	private function _set_cat_nodb($post){
		$insert = $this->servix_model->setCatNobd($post['id_usuario'],$post['categoria'],$post['comentario'],$post['fecha_fin']);
		return $insert;
	}
	
	public function ofrecer_servicio(){
		echo "ofrecer_servicio";	 
	}

	public function categorias(){
		echo "categorias";	 
	}

	public function busqueda(){
		 $post = $this->input->post();
		 $busqueda = array();
		 foreach ($post as $k => $v) {
			$busqueda['post'][$k] = ($v);
			$busqueda['url'][$k]  = normaliza(trim($v));
		 }
		 $this->session->set_userdata("busqueda",$busqueda);
		 return redirect("resultado-de-busqueda/".$busqueda['url']['servicio']."-en-".$busqueda['url']['localidad']);

	}


	public function resultado_busqueda(){
			
		$busca = $this->session->userdata("busqueda");
		if($this->UsuarioSession){
			$data['usuario'] = $this->UsuarioSession['nombre'];
			$data['usuarioSession'] = $this->UsuarioSession;
		}
		$data['servicio']  = $busca['post']['servicio'];
		$data['localidad'] = $busca['post']['localidad'];
		$urlLoc 		   = $busca['url']['localidad'];
		$urlServ 		   = $busca['url']['servicio'];
		$result	   		   = $this->_setPaginacion($data['servicio'],$data['localidad'],$urlServ,$urlLoc);
		$data['result']    = $result['result'];
		if(!empty($data['result'])){
		 $data['map'] 	   =	$this->_gmap($data['result'],$busca['post']['localidad']);
		}
		$data['title'] 	   = 'Resultado de búsqueda';
		$data['vista'] 	   = 'resultado_busqueda_view';
		$this->load->view('home_view',$data);

	}

	private function _setPaginacion($servicio, $localidad, $urlServ, $urlLoc){


 	    $this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('resultado-de-busqueda/'.$urlServ.'/'.$urlLoc);
        $config["total_rows"]   = $this->servix_model->getTotalFilasResultBusqueda($servicio,$localidad);
        $config["per_page"] 	= 4;
        $config["uri_segment"]  = 4;
        $config['last_link'] 	= 'Último';
        $config['first_link'] 	= 'Primero';
        $this->pagination->initialize($config);
        $page 					= (is_numeric($this->uri->segment(4))) ? $this->uri->segment(4) : 0;
        $data["result"] 		= $this->servix_model->getResultadoBusqueda($servicio,$localidad,  $page, $config["per_page"]); 
        $data["links"] 			= $this->pagination->create_links();
		return $data;
       
	}

	


	private function _gmap($rs, $loc=null, $zoom='auto'){
		$this->load->library('googlemaps');	
		$config 			= array();
	    $config['region']   = 'Argentina';
		$config['center']	= "$loc";
   		$config['zoom']		= "$zoom";
		$config['cluster'] 	= TRUE;
		$config['places'] 	= TRUE; 
		$config['minifyJS'] = TRUE;

		$this->googlemaps->initialize($config);

		foreach ($rs as $v) {
			$marker = array();
			$marker['position']			  = ''.$v['latitud'].' '.$v['longitud'].'';
			$marker['infowindow_content'] = ('<div style="width: 250px;color: #000;font-size:14px;font-family:Arial, Helvetica, sans-serif;">'.ucwords($v['titulo']).'<br>'.ucfirst($v['direccion']).'			</div>');
			$marker['infowindowMaxWidth'] = "500";
			$marker['animation']		  = 'DROP';
			$this->googlemaps->add_marker($marker);
		}

		$data['map'] = $this->googlemaps->create_map();
		return $data['map'];
	}



	private function _setPaginacionOpinion($servicio,$id)
	{

	    $this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('ficha/'.$servicio.'/opniones/page');
        $config["total_rows"]   = $this->servicios_model->getTotalOpiniones($id);
        $config["per_page"] 	= 4;
        $config["uri_segment"]  = 5;
        $config["is_ajax_paging"]    = TRUE; 
        $config['paging_function'] = 'ajax_paging';
        $this->pagination->initialize($config);
        $page 					= (is_numeric($this->uri->segment(5))) ? $this->uri->segment(5) : 0;
        $data["result"] 		= $this->servicios_model->getOpinionServicio($id, $page, $config["per_page"]); 
        $data["links"] 			= $this->pagination->create_links();
		return $data;
	}

	public function get_opiniones($servicio=null,$num=0){
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 
		$id = $this->_parsearIdServicio($servicio);
		if(is_numeric($id)){
			$opiniones = $this->_setPaginacionOpinion($servicio,$id);
		}
		$data['opiniones'] = $opiniones['result'];
		if($this->input->is_ajax_request()){
			$this->load->view('listar_opiniones',$data);
		}else{
			$this->ficha_servicio($servicio);
		}
	}

	private function _setPagSolicitados($seccion,$segment=2){

  		$semanaActual  			= strtotime("-7 day");
		$semanaSolicitado		= date('Y-m-d h:i:s',$semanaActual); 
 	    $this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url($seccion);
        $config["total_rows"]   = $this->servicios_model->getTotalFilasSolicitados($semanaSolicitado);
        $config["per_page"] 	= 4;
        $config["uri_segment"]  = $segment;
        $config['last_link'] 	= 'Último';
        $config['first_link'] 	= 'Primero';
        $this->pagination->initialize($config);
      
        $page 					= (is_numeric($this->uri->segment($segment))) ? $this->uri->segment($segment) : 0;
        $data["result"] 		= $this->servicios_model->getServiciosSolicitados($semanaSolicitado , $page, $config["per_page"]); 
        $data['current_page']   = $page;
        $data["links"] 			= $this->pagination->create_links();
		return $data;

       
	}

	public function servicio_solicitado($servicio=null){

		$id 	 = $this->_parsearIdServicio($servicio);
		$seccion = "servicio-solicitado/".$servicio."/";
		$segment = 3;

		if(is_numeric($id)){

			$data['title']   = 'Ficha del servicio';
			$solicitado 	 = $this->servicios_model->getServicioSolicitado($id);
			$solicitados 	 = $this->_setPagSolicitados($seccion,$segment);

			$userPostulados	 = $this->servicios_model->userPostulados($id);

			if(!empty($solicitados)){
				$data['solicitados'] = $solicitados['result'];
			}else{
				$data['solicitados'] = null;
			}

			$data['paginacion']   = $solicitados['links'];
			$data['current_page'] = ( $solicitados['current_page'] > 0) ?  $solicitados['current_page'] : "";
			$data['vista']        = 'servicio_solicitado';
			$data['userPostu']    = $userPostulados;
			$data['solicitado']   = $solicitado[0];
			$data['id_usuario']   = $this->UsuarioSession['id'];
			
			
			if($this->UsuarioSession){
				$data['usuario'] 		= $this->UsuarioSession['nombre'];
				$data['usuarioSession'] = $this->UsuarioSession;
				$user_postulado 		= $this->servicios_model->userPostulado($data['id_usuario'],$id);
				if(!empty($user_postulado)){
					foreach ($user_postulado as $value) {
						$user_postulado = $value['postulado'];
					}
					$data['user_postulado'] = $user_postulado;
				}
			}

			if ($this->input->is_ajax_request()) {
				$this->load->view('servicios_solicitados',$data);
			}else{
				$this->load->view('home_view',$data);
			}


		}else{

			return redirect('');	
		}
		
	}

	public function set_postulacion(){
		
		if($this->UsuarioSession){

			$id_busqueda_temp = $this->input->post('id_busqueda_temp');
			$id_usuario 	  = $this->UsuarioSession['id'];
			$user_postulado   = $this->servicios_model->userPostulado($id_usuario ,$id_busqueda_temp);

			if(!empty($user_postulado)){
				
					foreach ($user_postulado as $value) {

						if(($value['postulado'] == 0) &&  ( $value['envio_mail'] == 1 ) ){
							$this->servicios_model->updatePostulacion($id_busqueda_temp ,$id_usuario,1);

						}
					
					}

			}else{
				 $id_user_publicacion  = $this->input->post('id_user_publicacion');
				 $userSolicitudData    = $this->usuarios_model->getUsuario($id_user_publicacion);
				 $usuario 			   = $this->UsuarioSession;
				 $servicioSolicitado   = $this->servicios_model->getServicioSolicitado($id_busqueda_temp);
				 $mail = $this->_crearEmailTemplacePostulacion($userSolicitudData,$servicioSolicitado,$usuario);
				 if($mail){
				 	$this->servicios_model->setPostulacion($id_busqueda_temp,$id_usuario,1,1);
				 }
			}

	        return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function unset_postulacion(){
		
		$id_busqueda_temp = $this->input->post('id_busqueda_temp');
		$id_usuario 	  = $this->UsuarioSession['id'];
		$this->servicios_model->updatePostulacion($id_busqueda_temp ,$id_usuario,0);

		return redirect($_SERVER['HTTP_REFERER']);

	}



	public function ficha_servicio($servicio=null){
		
		$id 			 = $this->_parsearIdServicio($servicio);
		$data['seccion'] = 'ficha';
		$data['favorito']=  null;

		if(is_numeric($id)){

			$opiniones 	 = $this->_setPaginacionOpinion($servicio,$id);
			$servicioRS  = $this->servicios_model->getServicioFicha($id);
			$promedio 	 = $this->servicios_model->getPromedioPuntos($id);

			if(!empty($promedio)){
				foreach ($promedio[0] as $key => $value) {
					$data[$key] = $value;
				}
			}

			foreach ($servicioRS[0] as $key => $value) {
				$data[$key] = $value;
			}

			if($this->UsuarioSession){
				$fav = $this->usuarios_model->getFavorito($this->UsuarioSession['id'],$id);
				if(!empty($fav)){
					$data['favorito'] = true;
				}
			}

			$data['servicio']  = $data['titulo'];
			$lat 			   = $servicioRS[0]['latitud'];
			$long 			   = $servicioRS[0]['longitud'];
			$position	       = "$lat,$long";
			$data['map'] 	   = $this->_gmap($servicioRS,$position,14);
		
			if($this->UsuarioSession){
				$data['usuario']	    = $this->UsuarioSession['nombre'];
				$data['usuarioSession'] = $this->UsuarioSession;
			}

			$data['opiniones'] = $opiniones['result'];
			$data['title']     = 'Ficha del servicio';
			$data['servUrl']   =  site_url('ficha/'.$servicio);
			$data['vista']     = 'ficha_servicio_view';

			return $this->load->view('home_view',$data);
		
		}else
		{
			return redirect('');
		}
	}


	private function _parsearIdServicio($servicio){
		$serv = explode('-', $servicio);
		return $serv[0];
	}

	private function _crearEmailTemplacePostulacion($dataUserSolicitud,$dataServicioSoliciutd,$dataUserPostulante){
		
		foreach ($dataUserSolicitud as  $value) {
			$data['nombreUs'] 	= $value['nombre'];
			$data['emailUS'] 	= $value['email'];
			
		}
		
		foreach ($dataServicioSoliciutd as $value) {
			$data['nombreSS'] = ucfirst($value['categoria'])." en ".ucfirst($value['localidad'])." ".ucfirst($value['provincia']);
			$data['linkSS']	  = site_url(generarLinkServicio($value['id'],$value['categoria']."-en-".$value['localidad']."-".$value['provincia'],'servicio-solicitado'));
		}

	
		$data['nombreUP']   = $dataUserPostulante['nombre'];
		$data['apellidoUP'] = $dataUserPostulante['apellido'];
		$data['emailUP'] 	= $dataUserPostulante['email'];
		$data['telefonoUP']	= $dataUserPostulante['telefono'];
		
		$vista = $this->load->view('email/servicioPostulacion',$data,true);
		
		return $this->sendPostulacion($data['emailUS'],$vista);

		

	}

	public function sendPostulacion($para,$vista){
		
		 	$this->load->library('email');
		 	$config['charset']  = 'utf-8';
	        $config['wordwrap'] = TRUE;
	        $config['mailtype'] = 'html';
	        $fromemail          = 'no-responder@servix.com'; // desde
	        $toemail            = $para; //para 
	        $mail               = null;
	        $subject            = "Tienes una nueva postulaci&oacute;n en tu solicitud de servicio";

	        
	        $this->email->initialize($config);
        	$this->email->to($toemail);
	        $this->email->from($fromemail, 'Servix');
	        
	        $this->email->subject($subject);
	        $mesg = $vista;
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	        // echo $this->email->print_debugger();
	      	return $mail;
		 
	}



	public function sendContacto($post){

		 if(isset($post)){

		 	$this->load->library('email');
		 	$config['charset']  = 'utf-8';
	        $config['wordwrap'] = TRUE;
	        $config['mailtype'] = 'html';
	        $fromemail          = 'no-responder@servix.com'; // desde
	        $toemail            = $post['email']; //para 
	        $mail               = null;
	        $subject            = "Servix datos de contacto";

	        
	        $this->email->initialize($config);
        	$this->email->to($toemail);
	        $this->email->from($fromemail, $post['nombre']);
	        
	        $this->email->subject($subject);
	        $mesg = $this->load->view('email/contacto',$post,true);
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	      
	      	return $mail;
		 }
	}


	public function sendRecomendacion($post){

			 if(isset($post)){

			 	$this->load->library('email');
			 	$config['charset']  = 'utf-8';
		        $config['wordwrap'] = TRUE;
		        $config['mailtype'] = 'html';
		        $toemail            = $post['emailAmigo']; //para 
		        $fromemail          = 'no-responder@servix.com'; // desde
		        $mail               = null;
		        $subject            = "Hola ".$post['nombreAmigo']." este servicio puede ser de tu int&eacuteres";

		        $this->email->initialize($config);
		        $this->email->from($fromemail);
	        	$this->email->to($toemail);
		        
		        $this->email->subject($subject);
		        $mesg = $this->load->view('email/recomendacion',$post,true);
		        $this->email->message($mesg);
		        $mail = $this->email->send();
		      
		      	return $mail;
			 }
		}

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */