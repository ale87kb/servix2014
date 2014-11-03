<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Usuarios extends CI_controller(){

	function __construct(){
		parent::__construct();
	}
	/*
	
	*/
	public function index(){
		echo "index";
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