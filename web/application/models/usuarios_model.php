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


	public function getUser($usuario){
		//Verifica que el usuario y el email sean 
		//correspondientes entre si, para corroborar el login
	   $query 	= "SELECT * FROM usuarios
	   			WHERE usuarios.email = '$usuario'
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
		$query ="SELECT * FROM puntuacion 
				WHERE puntuacion.id_usuarios = $idU 
				AND puntuacion.id_servicios = $idS 
				AND puntuacion.fecha_votacion >= '$fecha' 
				LIMIT 1";
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
		$query = "INSERT INTO puntuacion (id_usuarios, id_servicios, puntos, comentario, fecha_votacion, fecha_uso_servicio) 
				VALUES ($idU, $idS, $puntos,'$comentario', '$fechaVotacion', '$fechaUso');";
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

	public function getUsuario($id){
		//Devuelve toda la informacion del usuario, determinado por el id
		 $query = 	"SELECT * FROM usuarios
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

		$query	= 	"INSERT INTO usuarios (email, clave, nombre, apellido, telefono, direccion, foto, codigo, estado, fecha_creacion, fecha_mod_estado, ultima_edicion)
					 VALUES (
						'".$nuevoUsuario['usuario']."',
						'".$nuevoUsuario['clave']."',
						'".$nuevoUsuario['nombre']."',
						'".$nuevoUsuario['apellido']."',
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


	//Edita el usuario
	public function editar_email($usuario){
		$query = "UPDATE usuarios
			SET email = '".$usuario['usuario']."', 
				codigo = '".$usuario['codigo']."', 
				estado = ".$usuario['estado'].", 
				ultima_edicion = '".$usuario['ultima_edicion']."' 
			WHERE id = ".$usuario['id']."";
		$rs = $this->db->query($query);
		return $rs;
	}
	

	//Edita una nueva clave dependiendo el id de usuario
	public function editar_clave($usuario){
		$query="UPDATE usuarios
				SET clave = MD5('".$usuario['clave']."'), 
					ultima_edicion = '".$usuario['ultima_edicion']."' 
				WHERE id = ".$usuario['id']."";
		$rs = $this->db->query($query);
		return $rs;
	}

	//Edita el usuario dependiendo el id de usuario
	public function editar_usuario($usuario){
		$query="UPDATE usuarios
				SET nombre = '".$usuario['nombre']."', 
					apellido ='".$usuario['apellido']."', 
				 	telefono = '".$usuario['telefono']."', 
				 	direccion = '".$usuario['direccion']."', 
				 	ultima_edicion = '".$usuario['ultima_edicion']."'
				WHERE id = ".$usuario['id']."";
		$rs = $this->db->query($query);
		return $rs;
	}


	//Actualiza la clave dependiendo el email del usuarios: Recibe un array
	public function actualizar_clave($usuario){
		$query 	= 	"UPDATE usuarios 
					SET clave = MD5('".$usuario['clave']."'), 
						ultima_edicion = '".$usuario['ultima_edicion']."' 
					WHERE email = '".$usuario['usuario']."'";

		$rs 	= $this->db->query($query);
		
		return $rs;
	}


	public function actulaizar_foto_usuario($foto){
		$query = 	"UPDATE usuarios
					SET foto = '".$foto['foto']."',
					ultima_edicion = '".$foto['ultima_edicion']."' 
					WHERE id = ".$foto['id']."";
		$rs = $this->db->query($query);
		return $rs;
	}


	public function verificarCodigo($codigo){
		$query 	= "SELECT * FROM usuarios WHERE codigo = '$codigo';";

		$rs 	= $this->db->query($query);

		return $rs->result_array();
	}



	//Actualiza el estado del usuario
	public function actualizarEstadoVerficado($estado, $codigo, $fecha){
		$query 	= 	"UPDATE usuarios 
					SET estado = $estado, 
						fecha_mod_estado = '$fecha', 
						ultima_edicion = '$fecha' 
					WHERE codigo = '$codigo';";

		$rs 	= $this->db->query($query);

		return $rs;
	}

	public function setFavorito($id_usuario,$id_servicio){
		$fechaUso = date('Y-m-d h:i:s');
		$query = "INSERT INTO favoritos (id_usuarios, id_servicios, fecha) VALUES ($id_usuario, $id_servicio, '$fechaUso');";
		$rs = $this->db->query($query);
		return $rs;
	}
	public function getFavorito($id_usuario,$id_servicio){
		$fechaUso = date('Y-m-d h:i:s');
		$query = "SELECT * FROM favoritos WHERE id_usuarios = $id_usuario  AND id_servicios = $id_servicio";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}

	public function deleteFavorito($id_servicios, $id_usuario){
		$query ="DELETE FROM favoritos WHERE  id_servicios=$id_servicios AND id_usuarios = $id_usuario";
		$rs = $this->db->query($query);
		return $rs;
	}

	/*-------------------------------*/

	//Servicios propios del Usuario
	public function getServiciosProrpios($idUsuario, $desdeLimit, $cantidadLimit){
		$query = "SELECT
					servicios.id,
					servicios.titulo,
					servicios.descripcion,
					servicios.foto,
					servicios.url_web,
					servicios.direccion,
					servicios.telefono,
					servicios.latitud,
					servicios.longitud,
					localidades.localidad,
					provincias.provincia,
					categorias.categoria
				FROM
					relacion_u_s
				INNER JOIN servicios ON relacion_u_s.id_servicios = servicios.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				WHERE
					relacion_u_s.id_usurios = $idUsuario
				LIMIT $desdeLimit, $cantidadLimit";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}

	//Cantidad de servicios propios del usuario
	public function getCantidadServicioPropios($idUsuario){
		$query = "SELECT
					COUNT(servicios.id) AS cantidad
				FROM
					relacion_u_s
				INNER JOIN servicios ON relacion_u_s.id_servicios = servicios.id
				WHERE
				relacion_u_s.id_usurios = $idUsuario";
		$rs = $this->db->query($query);
		return $rs->row()->cantidad;
	}
	/*-------------------------------*/

	//Favoritos del usuario
	public function getFavoritos($idUsuario, $desdeLimit, $cantidadLimit){
		$query 	= "SELECT
					favoritos.fecha,
					servicios.id,
					servicios.titulo,
					servicios.descripcion,
					servicios.foto,
					categorias.categoria,
					localidades.localidad,
					provincias.provincia
				FROM
					favoritos
				INNER JOIN servicios ON favoritos.id_servicios = servicios.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				WHERE
					favoritos.id_usuarios = $idUsuario
				ORDER BY
					favoritos.fecha DESC
				LIMIT $desdeLimit, $cantidadLimit";

		$rs 	= $this->db->query($query);

		return $rs->result_array();
	}

	//Cantidad de favoritos
	public function getCantidadFavoritos($idUsuario){
		$query = "SELECT
					COUNT(servicios.id) AS cantidad
				FROM
					favoritos
				INNER JOIN servicios ON favoritos.id_servicios = servicios.id
				WHERE
					favoritos.id_usuarios = $idUsuario";
		$rs = $this->db->query($query);
		return $rs->row()->cantidad;
	}

	/*-------------------------------*/

	//Servicios comentados por el usuario. Los comentarios aparecen en ela ficha
	public function getComentariosRealizados($idUsuario, $desdeLimit ,$cantidadLimit){
		$query 	=	"SELECT
						servicios.id,
						servicios.titulo,
						servicios.descripcion,
						servicios.foto,
						puntuacion.comentario,
						puntuacion.puntos,
						puntuacion.fecha_votacion,
						puntuacion.fecha_uso_servicio,
						categorias.categoria,
						localidades.localidad,
						provincias.provincia
					FROM
						puntuacion
					INNER JOIN servicios ON puntuacion.id_servicios = servicios.id
					INNER JOIN localidades ON servicios.id_localidades = localidades.id
					INNER JOIN provincias ON localidades.id_provincia = provincias.id
					INNER JOIN categorias ON servicios.id_categorias = categorias.id
					WHERE
						puntuacion.id_usuarios = $idUsuario
					LIMIT $desdeLimit, $cantidadLimit";

		$rs = $this->db->query($query);

		return $rs->result_array();

	}

	//Cantidad de servicios comentados
	public function getCantidadComentariosRealizados($idUsuario){
		$query 	=	"SELECT
						COUNT(servicios.id) AS cantidad
					FROM
						puntuacion
					INNER JOIN servicios ON puntuacion.id_servicios = servicios.id
					WHERE
						puntuacion.id_usuarios = $idUsuario";
		$rs = $this->db->query($query);
		return $rs->row()->cantidad;
	}
	/*-------------------------------*/

	//Servicios contactados/consultados por el usuario. Se les envia un e-mail
	public function getServiciosContactados($idUsuario, $desdeLimit ,$cantidadLimit){
		$query 	=	"SELECT
						servicios.id,
						servicios.titulo,
						servicios.descripcion,
						servicios.foto,
						consultas_servicios.consulta,
						consultas_servicios.fecha,
						provincias.provincia,
						categorias.categoria,
						localidades.localidad
					FROM
						consultas_servicios
					INNER JOIN servicios ON consultas_servicios.id_servicio = servicios.id
					INNER JOIN localidades ON servicios.id_localidades = localidades.id
					INNER JOIN provincias ON localidades.id_provincia = provincias.id
					INNER JOIN categorias ON servicios.id_categorias = categorias.id

					WHERE
						consultas_servicios.id_usuario = $idUsuario
					ORDER BY
						consultas_servicios.fecha DESC
					LIMIT $desdeLimit, $cantidadLimit";

		$rs = $this->db->query($query);
		return $rs->result_array();
	}

	public function getCantidadServiciosContactados($idUsuario){
		$query 	=	"SELECT
						COUNT(servicios.id) AS cantidad
					FROM
						consultas_servicios
					INNER JOIN servicios ON consultas_servicios.id_servicio = servicios.id
					WHERE
						consultas_servicios.id_usuario = $idUsuario";
		$rs = $this->db->query($query);
		return $rs->row()->cantidad;
	}


	/*-------------------------------*/

	//Servicios solicitados temporales por el usuario
	public function getUServiciosSolicitados($idUsuario, $desdeLimit, $cantidadLimit){
		$query =	"SELECT
						busquedas_temp.id,
						categorias.categoria,
						provincias.provincia,
						localidades.localidad,
						busquedas_temp.fecha_ini,
						busquedas_temp.fecha_fin,
						busquedas_temp.busqueda,
						busquedas_temp.vencido
					FROM
						busquedas_temp
					INNER JOIN categorias ON busquedas_temp.id_categorias = categorias.id
					INNER JOIN localidades ON busquedas_temp.id_localidad = localidades.id
					INNER JOIN provincias ON localidades.id_provincia = provincias.id
					WHERE busquedas_temp.id_usuario = $idUsuario
					ORDER BY busquedas_temp.fecha_ini DESC
					LIMIT $desdeLimit, $cantidadLimit";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}

	//Cantidad de servicios solicitados por el usuario
	public function getCantidadSolicitados($id, $vencido){
		$query = "SELECT
					count(busquedas_temp.id) AS cantidad
				FROM
					busquedas_temp
				WHERE
					busquedas_temp.id_usuario = $id
				AND
					busquedas_temp.vencido = $vencido";
		$rs = $this->db->query($query);

		return $rs->row()->cantidad;
	}
	/*-------------------------------*/

	//Postulaciones a servicios solicitados
	public function getUPostulaciones($idUsuario, $desdeLimit, $cantidadLimit){
		$query =	"SELECT
						busquedas_temp.id,
						busquedas_temp.fecha_ini,
						busquedas_temp.fecha_fin,
						busquedas_temp.busqueda,
						busquedas_temp.vencido,
						postulaciones_temp.postulado,
						usuarios.id as id_usuario,
						categorias.categoria,
						cat_nodb.categoria as otra_cat,
						localidades.localidad,
						provincias.provincia
					FROM
						busquedas_temp
					INNER JOIN categorias ON busquedas_temp.id_categorias = categorias.id
					INNER JOIN localidades ON busquedas_temp.id_localidad = localidades.id
					INNER JOIN postulaciones_temp ON postulaciones_temp.id_busquedas_temp = busquedas_temp.id
					INNER JOIN provincias ON localidades.id_provincia = provincias.id
					INNER JOIN usuarios ON busquedas_temp.id_usuario = usuarios.id
					LEFT OUTER JOIN cat_nodb ON busquedas_temp.id_cat_nodb = cat_nodb.id
					WHERE postulaciones_temp.id_usuarios = $idUsuario
					ORDER BY busquedas_temp.fecha_ini ASC
					LIMIT $desdeLimit, $cantidadLimit";
		$rs = $this->db->query($query);
		return $rs->result_array();
	}


	//Cantidad de servicios solicitados a cuales el usuario se postulo
	public function getCantidadPostulados($id, $vencido, $postulado){
		$query = "SELECT
					COUNT(postulaciones_temp.id) AS cantidad
				FROM
					postulaciones_temp
				INNER JOIN busquedas_temp ON postulaciones_temp.id_busquedas_temp = busquedas_temp.id
				WHERE
					postulaciones_temp.id_usuarios = $id
				AND
					busquedas_temp.vencido = $vencido
				AND 
					postulaciones_temp.postulado = $postulado";
		$rs = $this->db->query($query);

		return $rs->row()->cantidad;
	}



}