<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sitio extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		//inicio sesion de usuario preguntandole al modelo
		$this->usuario = $this->check_login();
	}

	public function check_login(){
		$this->usuario = null;
		$user = $this->usuarios_model->isLogin();
		if($user){
			$this->usuario = $user['usuario'];
		}
		return $this->usuario;
	}

	public function index(){
		
		// print_d($data['usuario']);
		$data['usuario'] = $this->usuario;
		$data['vista'] = 'index_view';
		$this->load->view('home_view',$data);
	}

	public function mail(){
		$this->load->view('email/contacto');
	}

	public function comentar_servicio(){
	
		$usuario = $this->usuarios_model->isLogin();
		$post = $this->input->post();
		if(!empty($usuario)){

				$this->form_validation->set_rules('comentario', 'comentario', 'trim|required|xss_clean');
			
		           
				if($this->form_validation->run() == FALSE){
					$comentario_result = array(
					'error' => true,
					'mensaje'=>'Por favor ingrese un comentario.',
					 );		
				}else{
					$this->servicios_model->setConsultaServicio( $this->input->post('id_servicio'), $usuario['id'], $this->input->post('comentario'));
					$this->servicios_model->sendContacto($post);
					$comentario_result = array(
					'error' => false,
					'mensaje'=>'Su consulta ha sido enviado exitosamente.',
					 );
				}
			
		}else{

			

			$comentario_result = array('error' => true, 'mensaje'=> 'Por favor ingrese al sitio o registrese');
		}
		
		echo json_encode($comentario_result);
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
		$data['usuario']   = $this->usuario;
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
		// print_d($this->db->last_query());
		
		$data['vista'] = 'resultado_busqueda_view';
		$this->load->view('home_view',$data);

	}

	private function _setPaginacion($servicio,$localidad,$urlServ,$urlLoc){
		$pages = 4; //Número de registros mostrados por páginas
		$paginas_segmento = $this->uri->segment(4);
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $config['base_url'] 	= site_url('resultado-de-busqueda/'.$urlServ.'/'.$urlLoc);
        $config['total_rows'] 	= $this->servix_model->getTotalFilasResultBusqueda($servicio,$localidad);//calcula el número de filas  
        $config['per_page'] 	= $pages; //Número de registros mostrados por páginas
        $config['num_links'] 	= 2; //Número de links mostrados en la paginación
        $config["uri_segment"] 	= (empty($paginas_segmento)) ? 0 : $paginas_segmento;//el segmento de la paginación

        $this->pagination->initialize($config); //inicializamos la paginación  
        $data["result"] 	= $this->servix_model->getResultadoBusqueda($servicio,$localidad,$config["uri_segment"],$config['per_page']);
        return $data;        
	}


	private function _gmap($rs,$loc=null,$zoom='auto'){
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



	public function ficha_servicio($servicio=null){

		$id 			 = $this->_parsearIdServicio($servicio);
		$servicio 		 = $this->servicios_model->getServicioFicha($id);
		$opiniones 		 = $this->servicios_model->getOpinionServicio($id);

		

		if(!empty($opiniones)){
			foreach ($opiniones[0] as $key => $value) {
				$data[$key] = $value;
			}
		}
		foreach ($servicio[0] as $key => $value) {
			$data[$key] = $value;
		}
		$data['servicio']= $data['titulo'];
		$lat 			 = $servicio[0]['latitud'];
		$long 			 = $servicio[0]['longitud'];
		$position	     = "$lat,$long";
		$data['map'] 	 = $this->_gmap($servicio,$position,14);
		$data['usuario'] = $this->usuario;
		$data['vista']   = 'ficha_servicio_view';

		$this->load->view('home_view',$data);
	}


	private function _parsearIdServicio($servicio){
		$serv = explode('-', $servicio);
		return $serv[0];
	}


}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */