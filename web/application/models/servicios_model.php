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

	public function getServiciosDestacagdos(){
		$query = "SELECT
				servicios.titulo,
				servicios.descripcion,
				servicios.foto,
				categorias.categoria,
				Avg(puntuacion.puntos) as promedio,
				count(puntuacion.puntos) as cantPuntos,
				servicios.id,
				provincias.provincia,
				localidades.localidad
				FROM
				servicios
				INNER JOIN puntuacion ON puntuacion.id_servicios = servicios.id
				INNER JOIN categorias ON servicios.id_categorias = categorias.id
				INNER JOIN localidades ON servicios.id_localidades = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				GROUP BY servicios.id
				ORDER BY cantPuntos DESC
				LIMIT 5";


		$rs = $this->db->query($query)->result_array();
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

	public function setRecomendacion($idU,$post){
		$fechaUso = date('Y-m-d h:i:s');
		$query  = "INSERT INTO `recomendaciones` (`id_usuario`,`nombre`, `email`, `urlRec`,`fecha`) VALUES ($idU,'".$post['nombreAmigo']."', '".$post['emailAmigo']."', '".$post['urlServ']."','$fechaUso');";
		$rs     = $this->db->query($query);
		return $rs;
	}


	public function getTotalFilasSolicitados($fecha){
		$query="SELECT
				  count(id) as total 
				  FROM
				  busquedas_temp
				  WHERE
				  busquedas_temp.vencido = 0
				  AND
				  busquedas_temp.fecha_ini >= '$fecha'
				  ORDER BY busquedas_temp.fecha_ini DESC LIMIT 100";
		$rs    = $this->db->query($query);
		return $rs->first_row()->total;
	}


	public function getServicioSolicitado($id){ 
		$query ="SELECT
				servix_db.busquedas_temp.id,
				servix_db.provincias.provincia,
				servix_db.localidades.localidad,
				servix_db.categorias.categoria,
				servix_db.busquedas_temp.busqueda,
				servix_db.busquedas_temp.vencido,
				servix_db.busquedas_temp.fecha_fin,
				servix_db.busquedas_temp.fecha_ini,
				servix_db.usuarios.nombre,
				servix_db.usuarios.apellido

				FROM
				servix_db.busquedas_temp
				INNER JOIN servix_db.usuarios ON servix_db.busquedas_temp.id_usuario = servix_db.usuarios.id
				INNER JOIN servix_db.categorias ON servix_db.categorias.id = servix_db.busquedas_temp.id_categorias
				INNER JOIN servix_db.localidades ON servix_db.localidades.localidad = servix_db.busquedas_temp.id_localidad
				INNER JOIN servix_db.provincias ON servix_db.provincias.id = servix_db.localidades.id_provincia
				WHERE
				servix_db.busquedas_temp.id = $id";

	 }


	public function getServiciosSolicitados($fecha,$ini,$fin){
		$query = "SELECT
			      busquedas_temp.id,
				  categorias.categoria,
				  localidades.localidad,
				  provincias.provincia,
				  usuarios.apellido,
				  usuarios.nombre,
				  busquedas_temp.busqueda,
				  busquedas_temp.fecha_ini,
				  busquedas_temp.fecha_fin
				  FROM
				  busquedas_temp
				  INNER JOIN categorias ON busquedas_temp.id_categorias = categorias.id
				  INNER JOIN localidades ON busquedas_temp.id_localidad = localidades.id
				  INNER JOIN provincias ON localidades.id_provincia = provincias.id
				  INNER JOIN usuarios ON busquedas_temp.id_usuario = usuarios.id
				  WHERE
				  busquedas_temp.vencido = 0
				  AND
				  busquedas_temp.fecha_ini >= '$fecha'
				  ORDER BY busquedas_temp.fecha_ini DESC
				  LIMIT $ini,$fin";
				
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