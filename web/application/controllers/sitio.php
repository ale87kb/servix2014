<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sitio extends CI_Controller {

	function __construct(){

		parent::__construct();
	
	}


	public function index()
	{
		

		$data['vista'] = 'index_view';
		$this->load->view('home_view',$data);
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
		$data['servicio']  = $busca['post']['servicio'];
		$data['localidad'] = $busca['post']['localidad'];
		//aca llamo al model de servix y le paso como parametro el post sin parsear para que busque en la db
		$data['result']	   = $this->servix_model->getResultadoBusqueda($data['servicio'],$data['localidad']);
		print_d($this->db->last_query());
		if(!empty($data['result'])){
		 $data['map'] =	$this->_gmap($data['result']);
		}
		$data['vista'] = 'resultado_busqueda_view';
		$this->load->view('home_view',$data);

	}



	private function _gmap($rs){
		$this->load->library('googlemaps');	

		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$config['cluster'] = TRUE;
		$this->googlemaps->initialize($config);


		foreach ($rs as $v) {

		$marker = array();
		$marker['position'] = ''.$v['latitud'].' '.$v['longitud'].'';
		$marker['infowindow_content'] = ('<div style="width: 250px;color: #000;font-size:14px;font-family:Arial, Helvetica, sans-serif;">'.ucwords($v['titulo']).'			</div>');
		$marker['infowindowMaxWidth'] = "500";

		$this->googlemaps->add_marker($marker);
	

		}

		$data['map'] = $this->googlemaps->create_map();
		return $data['map'];
	
	}
	public function ficha_servicio(){
		echo "ficha_servicio";	 
	}


}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */