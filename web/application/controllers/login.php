<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent:__construct();
	}

	public function index(){
		echo "index";

		/**cargar la vista del login*/
	}

	public function recuperar_clave(){
		echo "recuperar_clave";
	}

	public function validacion_login(){
		echo "validacion_login";
		// valida form  como en el ejemplo

	}

	private function _check_database($password){
		//consulta datos en base de datos
		//llama al modelo del usuario a la funcion _getUsuario
	}
	
	public function registrar_usuario(){
		echo "registrar_usuario";
	}





}

?>