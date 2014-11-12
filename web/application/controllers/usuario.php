<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_controller{

	public function __construct(){
		parent::__construct();
	}
	/*
	
	*/
	public function index(){
		echo "index";
		/*$data['title'] = 'Iniciar sesión';
		$data['vista'] = 'login/login_form';
		$this->load->view('login_view',$data);*/
	}

	public function verificar(){
		$data['title'] = 'Verificar usuario registrado en Servix';
		$data['vista'] = 'login/verificar_usuario';
		if(isset($_GET['codigo']))
		{
			$codigoVerificar = $this->input->get('codigo', TRUE);
			$data['codigoVerificar'] = $codigoVerificar;
			
		}
		echo print_d($data);
		$this->load->view('login_view',$data);

	}

	public function editar_datos(){
		echo "editar_datos";
	}

	public function editar_servicios(){
		echo "editar_servicios";
	}

	public function favoritos(){
		echo "favoritos";
	}

	public function servicios_solicitados(){
		echo "servicios_solicitados";
	}
	
	public function mis_comentarios(){
		echo "mis_comentarios";
	}

}


?>