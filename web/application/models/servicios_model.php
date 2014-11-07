<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Servicios_model extends CI_Model{


	public function __construct(){
		parent::__construct();

	}

	public function setConsultaServicio($id_servicio,$id_usuario,$comentario){
		$fecha = date('Y-m-d H:m:i');
		$query ="INSERT INTO `consultas_servicios` (`id_servicio`, `id_usuario`, `fecha`, `consulta`) VALUES ($id_servicio, $id_usuario, '$fecha', '$comentario');";
		$rs    = $this->db->query($query);
		return $rs;
	}
	public function sendContacto($post){
		 return true;
	}

	public function getOpinionServicio($id){
		$query = "SELECT
				usuarios.apellido,
				usuarios.nombre,
				comentarios.comentario,
				comentarios.fecha,
				puntuacion.puntos,
				puntuacion.votado
				FROM
				comentarios
				LEFT OUTER JOIN usuarios ON comentarios.id_usuarios = usuarios.id
				LEFT OUTER JOIN puntuacion ON puntuacion.id_usuarios = usuarios.id
				WHERE comentarios.id_servicios = $id OR puntuacion.id_servicios = $id";
				$rs    = $this->db->query($query);
				return $rs->result_array();
	}
	public function getServicioFicha($id){
		$query =    "SELECT
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
					categorias.categoria,
					usuarios.nombre
					FROM
					servicios
					LEFT OUTER JOIN localidades ON servicios.id_localidades = localidades.id
					LEFT OUTER JOIN categorias ON servicios.id_categorias = categorias.id
					LEFT OUTER JOIN relacion_u_s ON relacion_u_s.id_servicios = servicios.id
					INNER JOIN usuarios ON relacion_u_s.id_usurios = usuarios.id
					WHERE
					servicios.id = $id LIMIT 1";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

}