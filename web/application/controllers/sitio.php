<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sitio extends CI_Controller {

	function __construct(){

		parent::__construct();
	}


	public function index()
	{
		$this->load->model('servix_model');
		
		$datosDB = $this->servix_model->get_datos();


		$data['vista'] = 'template';
		$data['datos'] = $datosDB;
		$this->load->view('home_view',$data);
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
	public function buscar_servicio(){
		echo "buscar_servicio";	 
	}
	public function ficha_servicio(){
		echo "ficha_servicio";	 
	}


}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */