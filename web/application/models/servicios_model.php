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


	public function getPromedioPuntos($id){
		$query ="SELECT
			Count(puntuacion.puntos) AS puntos,
			Avg(puntuacion.puntos) AS promedio
			FROM
			puntuacion
			WHERE
			puntuacion.id_servicios = $id";
						
		$rs    = $this->db->query($query);
		
		return $rs->result_array();
	}

	public function getTotalOpiniones($id){
		$query = "SELECT count(id) as total FROM puntuacion WHERE id_servicios= $id;";
		$rs    = $this->db->query($query);
		return $rs->first_row()->total;
	}
	public function getOpinionServicio($id,$ini=0,$fin=4){
			$query ="SELECT
			puntuacion.id_usuarios,
			puntuacion.comentario,
			puntuacion.puntos,
			puntuacion.fecha_votacion,
			puntuacion.fecha_uso_servicio,
			usuarios.nombre
			FROM
			puntuacion
			INNER JOIN usuarios ON puntuacion.id_usuarios = usuarios.id
			WHERE
			puntuacion.id_servicios = $id ORDER BY puntuacion.fecha_votacion DESC LIMIT $ini,$fin ";
						
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