<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Usuarios_model extends CI_Model{


	public function __construct(){
		parent::__construct();

	}


	public function login($usuario, $clave){
		//Verifica que el usuario y el email sean 
		//correspondientes entre si, para corroborar el login
	   $query 	= "SELECT * FROM usuarios
	   			WHERE usuarios.email = '$usuario'
	   			AND usuarios.clave = MD5('$clave')
	   			LIMIT 1";

		$rs    = $this->db->query($query);

 		if($rs -> num_rows() == 1)
	   	{
	    	return $rs->result_array();
	   	}
	   	else
	   	{
	   	 	return false;
	   	}
	}
	

	public function getEmail($usuario){
		//VERIFICA QUE EL email DEL usuario ESTE EN LA BASE DE DATOS
		$query	= "SELECT usuarios.id, usuarios.email FROM usuarios
					WHERE usuarios.email = '$usuario'
					LIMIT 1";

		$rs = $this->db->query($query);
		if($rs -> num_rows() == 1){
			return $rs->result_array();
		}
		else{

			return false;
		}
	}


	public function getUsuario($id){
		//Devuelve toda la informacion del usuario, determinado por el id
		 $query 	= "SELECT * FROM usuarios
			   			WHERE usuarios.id = $id
			   			LIMIT 1";

		$rs    = $this->db->query($query);

 		if($rs -> num_rows() == 1)
	   	{
	    	return $rs->result_array();
	   	}
	   	else
	   	{
	   	 	return false;
	   	}
	}

	public function isLogin(){
		//Verifica si en la sesion del usuario se encuentra la variable logged_in
		if($this->session->userdata('logged_in'))
	   {
	     $session_data 	   = $this->session->userdata('logged_in');
	     $data['id']	   = $session_data['id'];
	     $data['usuario']  = $session_data['usuario'];
	     $data['telefono'] = $session_data['telefono'];
	     $data['email']    = $session_data['email'];
	    return $data;
	   }
	   else
	   {
	     //Si no hay sesion
	    return false;
	   }
	}


	public function get_datos(){
		$query = "SELECT * FROM servicios";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function add_usuario($nuevoUsuario){
		//Agrega un nuevo usuario a la base de datos

		$query	= 	"INSERT INTO 'usuarios' ('email','clave', 'nombre', 'apellido', 'dni', 'telefono', 'direccion', 'codigo', 'estado', 'fecha_creacion', 'fecha_mod_estado', 'ultima_edicion')
					 VALUES (
						".$nuevoUsuario['usuario'].",
						".$nuevoUsuario['clave'].",
						".$nuevoUsuario['nombre'].",
						".$nuevoUsuario['apellido'].",
						".$nuevoUsuario['dni'].",
						".$nuevoUsuario['telefono'].",
						".$nuevoUsuario['direccion'].",
						".$nuevoUsuario['codigo'].",
						".$nuevoUsuario['estado'].",
						".$nuevoUsuario['fecha'].",
						".$nuevoUsuario['fecha'].",
						".$nuevoUsuario['fecha']."
					);";
		$rs    = $this->db->query($query);
		return $rs;

	}

}

