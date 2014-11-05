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
		$data = array();
		if(!empty($loc[1])){

			$data['localidad'] = trim($loc[0]);
			$data['provincia'] = trim($loc[1]);
			$data['cond']	   = 'AND';

		}else{
			$data['localidad'] = trim($loc[0]);
			$data['provincia'] = trim($loc[0]);
			$data['cond']	   = 'OR';
		}
		return $data;
	}

	public function getTotalFilasResultBusqueda($servicio,$localidad){
		$loc = $this->_parsearLocalidad($localidad);
		$query = "SELECT
				servicios.id		
				FROM
				servicios
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				WHERE
				(servicios.titulo LIKE '%$servicio%' OR categorias.categoria LIKE '%$servicio%')
				AND
				(localidades.localidad LIKE '%".$loc['localidad']."%' ".$loc['cond']." provincias.provincia LIKE '%".$loc['provincia']."%')";
				
		$rs    = $this->db->query($query);
		return $rs->num_rows();
	}
	public function getResultadoBusqueda($servicio,$localidad,$ini=0,$fin=10){

		$loc = $this->_parsearLocalidad($localidad);

		$query = "SELECT
				servicios.id,
				servicios.titulo,
				servicios.descripcion,
				servicios.latitud,
				servicios.longitud,
				servicios.direccion,
				localidades.localidad,
				provincias.provincia,
				categorias.categoria				
				FROM
				servicios
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				WHERE
				(servicios.titulo LIKE '%$servicio%' OR categorias.categoria LIKE '%$servicio%')
				AND
				(localidades.localidad LIKE '%".$loc['localidad']."%' ".$loc['cond']." provincias.provincia LIKE '%".$loc['provincia']."%')
				LIMIT $ini,$fin
				";
				
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}
}