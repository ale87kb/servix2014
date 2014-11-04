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

	private function _parsearLocalidad($localidad){

		$loc = explode(',', $localidad );

		if(!empty($loc[1])){

			$loc['localidad'] = trim($loc[0]);
			$loc['provincia'] = trim($loc[1]);

		}else{
			$loc['localidad'] = trim($loc[0]);
			$loc['provincia'] = trim($loc[0]);
		}
		return $loc;
	}

	public function getResultadoBusqueda($servicio,$localidad){

		$loc = $this->_parsearLocalidad($localidad);

		$query = "SELECT
				servicios.*
				
				FROM
				servicios
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				WHERE
				(servicios.titulo LIKE '%$servicio%' OR categorias.categoria LIKE '%$servicio%')
				AND
				(localidades.localidad LIKE '%".$loc['localidad']."%' OR provincias.provincia LIKE '%".$loc['provincia']."%')";
				
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}
}