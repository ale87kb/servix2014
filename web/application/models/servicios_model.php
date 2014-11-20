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


	public function getOpinionServicio($id){
		$query = "SELECT
				puntuacion.puntos,
				puntuacion.votado,
				puntuacion.comentario,
				puntuacion.fecha_votacion,
				puntuacion.fecha_uso_servicio
				FROM
				puntuacion
				WHERE
				puntuacion.id_servicios = $id";
						
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
					usuarios.nombre,
					usuarios.email
					FROM
					servicios
					LEFT OUTER JOIN localidades ON servicios.id_localidades = localidades.id
					LEFT OUTER JOIN categorias ON servicios.id_categorias = categorias.id
					LEFT OUTER JOIN relacion_u_s ON relacion_u_s.id_servicios = servicios.id
					LEFT OUTER JOIN usuarios ON relacion_u_s.id_usurios = usuarios.id
					WHERE
					servicios.id = $id LIMIT 1";

		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

}