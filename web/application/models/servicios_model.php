<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Servicios_model extends CI_Model{


	public function __construct(){
		parent::__construct();

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
					comentarios.comentario,
					comentarios.fecha,
					puntuacion.votado,
					puntuacion.puntos
					FROM
					servicios
					LEFT OUTER JOIN localidades ON servicios.id_localidades = localidades.id
					LEFT OUTER JOIN categorias ON servicios.id_categorias = categorias.id
					LEFT OUTER JOIN comentarios ON comentarios.id_servicios = servicios.id
					LEFT OUTER JOIN puntuacion ON puntuacion.id_servicios = servicios.id
					WHERE
					servicios.id = $id";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

}