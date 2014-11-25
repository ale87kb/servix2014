<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sitio extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		//inicio sesion de usuario preguntandole al modelo
		$this->UsuarioSession = $this->usuarios_model->isLogin();

		//$this->usuario = $this->check_login();
	}


	public function index(){
		
		// print_d($data['usuario']);
		if($this->UsuarioSession){
			$data['usuario'] = $this->UsuarioSession['nombre'];
			$data['usuarioSession'] = $this->UsuarioSession;
		}
		//$data['usuario'] = $this->usuario;
		

		$destacados  	 = $this->servicios_model->getServiciosDestacados();
		$solicitados 	 = $this->_setPagSolicitados();
		
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
		$this->load->view('home_view',$data);
	}


	private function _setPagSolicitados(){

  		$semanaActual  			= strtotime("-7 day");
		$semanaSolicitado		= date('Y-m-d h:i:s',$semanaActual); 
 	    $this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('servicios-solicitados');
        $config["total_rows"]   = $this->servicios_model->getTotalFilasSolicitados($semanaSolicitado);
        $config["per_page"] 	= 4;
        $config["uri_segment"]  = 2;
        $config['last_link'] 	= 'Último';
        $config['first_link'] 	= 'Primero';
        $this->pagination->initialize($config);
      
        $page 					= (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : 0;
        $data["result"] 		= $this->servicios_model->getServiciosSolicitados($semanaSolicitado , $page, $config["per_page"]); 
       
        $data["links"] 			= $this->pagination->create_links();
		return $data;
       
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
			//Si se envia el comentario por e-mail, se graba en la base de datos
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
			$json['error'] = true;
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

	public function busqueda_localidades(){
		$data = $this->servix_model->geBusquedaLocalProv();
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

	


	public function condiciones_de_uso(){
		echo "condiciones_de_uso";  		
	}
	public function preguntas_frecuentes(){
		echo "preguntas_frecuentes";  	
	}
	public function solicitar_servicio(){
		echo "solicitar_servicio";	 
	}
	public function consultar_servicio(){
		echo "consultar_servicio";	 
	}
	public function ofrecer_servicio(){
		echo "ofrecer_servicio";	 
	}
	public function categorias(){
		echo "categorias";	 
	}

	public function busqueda(){
		 $post = $this->input->post();
		 //$post tiene el input value de servicio, localidad 
		 //los tiene tal como te lo envia el usuario con tildes y acentos y ñ

		 $busqueda = array();
		 foreach ($post as $k => $v) {
			$busqueda['post'][$k] = ($v);
			//la funcion normaliza sale del helper
			// todas las funciones que no tengan $this->algo->funcion() 
			//provienen de un helper

			$busqueda['url'][$k]  = normaliza(trim($v));
		 }
		 //seteo una nueva variable de session que me guarde los datos de las busqueda con su post y url a mostrar

		 $this->session->set_userdata("busqueda",$busqueda);
		 //esto es lo que te envio el usuario por post parseado para la url para tener una url friendly
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
		//aca llamo al model de servix y le paso como parametro el post sin parsear para que busque en la db
		$result	   = $this->_setPaginacion($data['servicio'],$data['localidad'],$urlServ,$urlLoc);
		$data['result'] = $result['result'];
		if(!empty($data['result'])){
		 $data['map'] =	$this->_gmap($data['result'],$busca['post']['localidad']);
		}
		
		
		$data['title'] = 'Resultado de búsqueda';
		$data['vista'] = 'resultado_busqueda_view';
		$this->load->view('home_view',$data);

	}

	private function _setPaginacion($servicio, $localidad, $urlServ, $urlLoc){


 	    $this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('resultado-de-busqueda/'.$urlServ.'/'.$urlLoc);
        $config["total_rows"]   = $this->servix_model->getTotalFilasResultBusqueda($servicio,$localidad);
        $config["per_page"] 	= 4;
        $config["uri_segment"]  = 4;
        $config['last_link'] = 'Último';
        $config['first_link'] = 'Primero';
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
        $config["is_ajax_paging"]    = TRUE; //default FALSE
        $config['paging_function'] = 'ajax_paging';// Your jQuery paging
        $this->pagination->initialize($config);
        $page 					= (is_numeric($this->uri->segment(5))) ? $this->uri->segment(5) : 0;
        $data["result"] 		= $this->servicios_model->getOpinionServicio($id, $page, $config["per_page"]); 
     
    
        $data["links"] 			= $this->pagination->create_links();
		return $data;
       

	}

	public function get_opiniones($servicio=null,$num=0){
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache"); 

		
		$id 			 = $this->_parsearIdServicio($servicio);

		if(is_numeric($id)){

		$opiniones 		 = $this->_setPaginacionOpinion($servicio,$id);
		}
		
		$data['opiniones']     = $opiniones['result'];

		//si es ajax navego por ajax
		if($this->input->is_ajax_request()){


		$this->load->view('listar_opiniones',$data);

		}else{

		//si refrescan la pagina no pierdo na lavegacion ni la pagina en la que estaba el usuario
			$this->ficha_servicio($servicio);
		

		}
	}

	public function ficha_servicio($servicio=null){
		$id 			 = $this->_parsearIdServicio($servicio);

		if(is_numeric($id)){

		$opiniones 		 = $this->_setPaginacionOpinion($servicio,$id);
		// $opiniones 		 = $this->test($servicio,$id);
		$servicioRS 	 = $this->servicios_model->getServicioFicha($id);
		$promedio 		 = $this->servicios_model->getPromedioPuntos($id);

		if(!empty($promedio)){
			foreach ($promedio[0] as $key => $value) {
				$data[$key] = $value;
			}
		}
		foreach ($servicioRS[0] as $key => $value) {
			$data[$key] = $value;
		}

		$data['favorito'] =  null;
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
			$data['usuario'] = $this->UsuarioSession['nombre'];
			$data['usuarioSession'] = $this->UsuarioSession;
		}
		$data['opiniones'] = $opiniones['result'];

		$data['title']     = 'Ficha del servicio';
		$data['servUrl']   =  site_url('ficha/'.$servicio);
		$data['vista']     = 'ficha_servicio_view';

		$this->load->view('home_view',$data);
		
		}else
		{
			redirect('');
		}
	}


	private function _parsearIdServicio($servicio){
		$serv = explode('-', $servicio);
		return $serv[0];
	}

	public function sendContacto($post){
		 if(isset($post)){

		 	// print_d($post);
		 	$this->load->library('email');
		 	$config['charset'] = 'utf-8';
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
	        $mesg  = $this->load->view('email/contacto',$post,true);
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	      
	      	return $mail;
		 }
	}
	public function sendRecomendacion($post){
			 if(isset($post)){

			 	// print_d($post);
			 	$this->load->library('email');
			 	$config['charset'] = 'utf-8';
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
		        $mesg  = $this->load->view('email/recomendacion',$post,true);
		        $this->email->message($mesg);
		        $mail = $this->email->send();
		      
		      	return $mail;
			 }
		}

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */