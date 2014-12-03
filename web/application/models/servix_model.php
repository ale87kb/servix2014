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

	public function getBusquedaCategoria(){
		$query ="SELECT categorias.categoria FROM categorias";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}
	public function getCategoria($string){
		$query ="SELECT categorias.id,categorias.categoria FROM categorias WHERE categoria = '$string'";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function getCategorias(){
		$query = "SELECT * FROM categorias ORDER BY categoria ASC LIMIT 100";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function setRelacionUS($idUser,$idServ){

		$query = "INSERT INTO relacion_u_s (id_usurios, id_servicios) VALUES ($idUser,$idServ);";
		$rs    = $this->db->query($query);
		
		return $rs;
	}


	public function setCatNobd($id_usuario,$cat_nodb,$comentario,$fecha_ini){
		$query = "INSERT INTO cat_nodb (id_usuario, categoria, comentario, fecha) VALUES ($id_usuario, '$cat_nodb', '$comentario', '$fecha_ini');";
		$rs    = $this->db->query($query);
		return $this->db->insert_id();
	}

	public function geBusquedaLocalProvBuscador(){
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
	public function geBusquedaLocalProv($loc){
		$query = "SELECT localidades.id,localidades.localidad,provincias.provincia
					FROM
					provincias
					INNER JOIN localidades ON localidades.id_provincia = provincias.id
					WHERE localidades.localidad LIKE '%$loc%' OR provincias.provincia LIKE '%$loc%' LIMIT 10";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function setSolicitarServicio($idCat,$idUser,$idLoc,$idCatNodb=null,$fecha_ini,$fecha_fin,$comentario){
		$query = "INSERT INTO busquedas_temp (id_categorias, id_usuario, id_localidad, id_cat_nodb, fecha_ini, fecha_fin, busqueda, vencido) VALUES ($idCat, $idUser, $idLoc, $idCatNodb, '$fecha_ini', '$fecha_fin', '$comentario', 0);";
		$rs    = $this->db->query($query);
		return $rs;
	}

	public function unsetSolicitudServicio($id){
		$query = "DELETE FROM `busquedas_temp` WHERE  `id`=$id LIMIT 1;";
		$rs    = $this->db->query($query);
		return $rs;
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
	public function getResultadoBusqueda($servicio,$localidad,$ini=10,$fin=0){

		$loc = $this->_parsearLocalidad($localidad);

		$query = "SELECT
				servicios.id,
				servicios.titulo,
				servicios.descripcion,
				servicios.foto, 
				servicios.latitud,
				servicios.longitud,
				servicios.direccion,
				localidades.localidad,
				provincias.provincia,
				categorias.categoria,
				AVG(puntuacion.puntos) AS promedio,
				COUNT(puntuacion.puntos) AS cantPuntos
				FROM
				servicios
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				LEFT OUTER JOIN puntuacion ON puntuacion.id_servicios = servicios.id
				WHERE
				(servicios.titulo LIKE '%$servicio%' OR categorias.categoria LIKE '%$servicio%')
				AND
				(localidades.localidad LIKE '%".$loc['localidad']."%' ".$loc['cond']." provincias.provincia LIKE '%".$loc['provincia']."%')
				GROUP BY servicios.id
				ORDER BY cantPuntos DESC , servicios.id_localidades ASC
				LIMIT $ini,$fin
				";
				
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}
}