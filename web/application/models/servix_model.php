<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Servix_model extends CI_Model{


	public function __construct(){
		parent::__construct();

	}

	public function getBusquedaServicio(){
		$query ="(SELECT servicios.titulo FROM servicios)
					UNION
				(SELECT categorias.categoria FROM categorias)";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function geBusquedaLocalProv(){
		$query = "(SELECT localidades.localidad,provincias.provincia
				FROM
				provincias
				INNER JOIN localidades ON localidades.id_provincia = provincias.id)
				UNION
				( SELECT provincias.provincia ,provincias.provincia
				FROM provincias)
				";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function getResultadoBusqueda($servicio,$localidad){
		$query = "SELECT
				*
				FROM
				servicios
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				WHERE
				(servicios.titulo LIKE '%$servicio%' OR categorias.categoria LIKE '%$servicio%')
				AND
				(localidades.localidad LIKE '%$localidad%' OR provincias.provincia LIKE '%$localidad%')";
				
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}
}