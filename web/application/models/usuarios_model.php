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
	
	public function checkVoto($idU,$idS,$fecha){
		$query ="SELECT * FROM puntuacion WHERE puntuacion.id_usuarios = $idU AND puntuacion.id_servicios = $idS AND puntuacion.fecha_votacion >= '$fecha' LIMIT 1";
		$rs = $this->db->query($query);
		if($rs->num_rows() == 1){
			return $rs->result_array();
		}
		else{

			return false;
		}
	}


	public function set_voto($idU,$idS,$puntos,$comentario,$fechaUso){
		$fechaVotacion = date('Y-m-d h:i:s');
		$query = "INSERT INTO `puntuacion` (`id_usuarios`, `id_servicios`, `puntos`,  `comentario`, `fecha_votacion`, `fecha_uso_servicio`) VALUES ($idU, $idS, $puntos,'$comentario', '$fechaVotacion', '$fechaUso');";
		$rs = $this->db->query($query);
		return $rs;
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

	public function getDNI($dni){
	//Verifica que el dni sel usuario sea unico
		$query = "SELECT usuarios.id, usuarios.dni FROM usuarios
					WHERE usuarios.dni = '$dni'
					LIMIT 1";

		$rs = $this->db->query($query);
		if($rs->num_rows() == 1){
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
	    	$session_data	= $this->session->userdata('logged_in');

			/*$data['id']	   = $session_data['id'];
			$data['usuario']  = $session_data['usuario'];
			$data['telefono'] = $session_data['telefono'];
			$data['email']    = $session_data['email'];*/

			return $session_data;
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
		//La calve esta encriptada en md5 desde el controlador login.php

		$query	= 	"INSERT INTO usuarios (email, clave, nombre, apellido, dni, telefono, direccion, foto, codigo, estado, fecha_creacion, fecha_mod_estado, ultima_edicion)
					 VALUES (
						'".$nuevoUsuario['usuario']."',
						'".$nuevoUsuario['clave']."',
						'".$nuevoUsuario['nombre']."',
						'".$nuevoUsuario['apellido']."',
						'".$nuevoUsuario['dni']."',
						'".$nuevoUsuario['telefono']."',
						'".$nuevoUsuario['direccion']."',
						'".$nuevoUsuario['foto']."',
						'".$nuevoUsuario['codigo']."',
						".$nuevoUsuario['estado'].",
						'".$nuevoUsuario['fecha_creacion']."',
						'".$nuevoUsuario['fecha_mod_estado']."',
						'".$nuevoUsuario['ultima_edicion']."'
					);";
		$rs    = $this->db->query($query);
		return $rs;

	}


	
	//Recibe un array
	public function actualizar_clave($usuario){
		$query 	= 	"UPDATE usuarios 
					SET clave = MD5('".$usuario['clave']."'), ultima_edicion = '".$usuario['ultima_edicion']."' 
					WHERE email = '".$usuario['usuario']."';";

		$rs 	= $this->db->query($query);
		
		return $rs;
	}



	public function verificarCodigo($codigo){
		$query 	= "SELECT * FROM usuarios WHERE codigo = '$codigo';";

		$rs 	= $this->db->query($query);

		return $rs->result_array();
	}



	//Actualiza el estado del usuario
	public function actualizarEstadoVerficado($estado, $codigo, $fecha){
		$query 	= "UPDATE usuarios SET estado = $estado, fecha_mod_estado = '$fecha', ultima_edicion = '$fecha' WHERE codigo = '$codigo';";

		$rs 	= $this->db->query($query);

		return $rs;
	}


	public function getFavoritos($idUsuario, $desdeLimit ,$cantidadLimit){
		$query 	= "SELECT
					favoritos.fecha,
					servicios.titulo,
					servicios.descripcion,
					servicios.id
				FROM
					favoritos
				INNER JOIN servicios ON favoritos.id_servicios = servicios.id
				WHERE
					favoritos.id_usuarios = $idUsuario
				ORDER BY
					favoritos.fecha DESC
				LIMIT $desdeLimit, $cantidadLimit";
		$rs 	= $this->db->query($query);

		return $rs->result_array();
	}

	public function getComentariosRealizados($idUsuario, $desdeLimit ,$cantidadLimit){
		$query 	=	"SELECT
						servicios.id,
						servicios.titulo,
						puntuacion.comentario,
						puntuacion.puntos,
						puntuacion.fecha_votacion
					FROM
						puntuacion
					INNER JOIN servicios ON puntuacion.id_servicios = servicios.id
					WHERE
						puntuacion.id_usuarios = $idUsuario
					LIMIT $desdeLimit, $cantidadLimit";

		$rs = $this->db->query($query);

		return $rs->result_array();

	}

}