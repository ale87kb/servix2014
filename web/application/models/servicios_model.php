<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Servicios_model extends CI_Model{


	public function __construct(){
		parent::__construct();

	}


	public function setConsultaServicio($id_servicio,$id_usuario,$comentario){
		$fecha = date('Y-m-d H:m:i');
		$query ="INSERT INTO 
					consultas_servicios (id_servicio, id_usuario, fecha, consulta) 
				VALUES 
					($id_servicio, $id_usuario, '$fecha', '$comentario');";
		$rs    = $this->db->query($query);
		return $rs;
	}

	public function getServiciosDestacados(){
		$query = "SELECT
					servicios.titulo,
					servicios.descripcion,
					servicios.foto,
					categorias.categoria,
					AVG(puntuacion.puntos) as promedio,
					COUNT(puntuacion.puntos) as cantPuntos,
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
				LIMIT 6";


		$rs = $this->db->query($query)->result_array();
		return $rs;
	}


	public function getPromedioPuntos($id){
		$query ="SELECT
				COUNT(puntuacion.puntos) AS puntos,
				AVG(puntuacion.puntos) AS promedio
			FROM
				puntuacion
			WHERE
				puntuacion.id_servicios = $id";
						
		$rs    = $this->db->query($query);
		
		return $rs->result_array();
	}

	public function getTotalOpiniones($id){
		$query = "SELECT 
					COUNT(id) as total 
				FROM 
					puntuacion 
				WHERE 
					id_servicios= $id;";
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
				usuarios.id,
				usuarios.nombre,
				usuarios.apellido
			FROM
				puntuacion
			INNER JOIN usuarios ON puntuacion.id_usuarios = usuarios.id
			WHERE
				puntuacion.id_servicios = $id 
			ORDER BY 
				puntuacion.fecha_votacion DESC LIMIT $ini,$fin ";
						
		$rs    = $this->db->query($query);
		
		return $rs->result_array();
	}

	public function setRecomendacion($idU,$post){
		$fechaUso = date('Y-m-d h:i:s');
		$query  ="INSERT INTO 
					recomendaciones (id_usuario, nombre, email, urlRec, fecha) 
				VALUES 
					($idU,'".$post['nombreAmigo']."', '".$post['emailAmigo']."', '".$post['urlServ']."','$fechaUso');";
		$rs     = $this->db->query($query);
		return $rs;
	}


	public function getTotalFilasSolicitados($fecha){
		$query="SELECT
				  COUNT(id) as total 
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

	public function userPostulados($id){
		$query = "SELECT
					usuarios.id,
					usuarios.nombre,
					usuarios.apellido,
					usuarios.foto,
					postulaciones_temp.postulado
				FROM
					postulaciones_temp
				INNER JOIN usuarios ON postulaciones_temp.id_usuarios = usuarios.id
				WHERE postulaciones_temp.id_busquedas_temp = $id";
		$rs    = $this->db->query($query);
		return $rs->result_array();
	}

	public function updatePostulacion($id_busquedas_temp ,$id_usuario,$postulado){
		$query = "UPDATE 
					postulaciones_temp 
				SET 
					postulado = $postulado 
				WHERE 
					id_busquedas_temp = $id_busquedas_temp 
				AND id_usuarios = $id_usuario 
				LIMIT 1;";
		$rs    = $this->db->query($query);
		return $rs;
	}

	public function setPostulacion($id_busquedas_temp,$id_usurio,$postu,$emailEnvio){
		$query = "INSERT INTO 
					postulaciones_temp (id_busquedas_temp, id_usuarios, postulado, envio_mail) 
				VALUES ($id_busquedas_temp,$id_usurio,$postu,$emailEnvio);";
		$rs    = $this->db->query($query);
		return $rs;
	}


	public function unsetPostulacion($id_busquedas_temp,$id_usurio){
		$query = "DELETE FROM postulaciones_temp 
				WHERE id_busquedas_temp = $id_busquedas_temp 
				AND id_usuarios = $id_usurio LIMIT 1;";
		$rs    = $this->db->query($query);
		return $rs;
	}



	public function unsetServicio($id_servicio){
		$query = "DELETE FROM `servicios` WHERE  `id`=$id_servicio LIMIT 1;";
		$rs    = $this->db->query($query);
		return $rs;
	}

	public function userPostulado($id_usuario,$id_busqueda){
		$query = "SELECT * FROM 
					postulaciones_temp 
				WHERE 
					id_busquedas_temp = $id_busqueda 
				AND id_usuarios = $id_usuario 
				ORDER BY postulado DESC";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function getServicioSolicitado($id){ 
		$query ="SELECT
					busquedas_temp.id,
					provincias.provincia,
					localidades.localidad,
					localidades.id as id_localidad,
					categorias.categoria,
					busquedas_temp.busqueda,
					busquedas_temp.vencido,
					busquedas_temp.fecha_fin,
					busquedas_temp.fecha_ini,
					usuarios.id as userID,
					usuarios.nombre,
					usuarios.apellido,
					usuarios.foto,
					cat_nodb.categoria as otra_cat
				FROM
					busquedas_temp
				INNER JOIN usuarios ON busquedas_temp.id_usuario = usuarios.id
				INNER JOIN categorias ON categorias.id = busquedas_temp.id_categorias
				INNER JOIN localidades ON busquedas_temp.id_localidad = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				LEFT OUTER JOIN cat_nodb ON busquedas_temp.id_cat_nodb = cat_nodb.id
				WHERE
					busquedas_temp.id = $id";
		$rs    = $this->db->query($query);
		return $rs->result_array();
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
					busquedas_temp.fecha_fin,
					cat_nodb.categoria as otra_cat
				FROM
					busquedas_temp
				INNER JOIN categorias ON busquedas_temp.id_categorias = categorias.id
				INNER JOIN localidades ON busquedas_temp.id_localidad = localidades.id
				INNER JOIN provincias ON localidades.id_provincia = provincias.id
				INNER JOIN usuarios ON busquedas_temp.id_usuario = usuarios.id
				LEFT OUTER JOIN cat_nodb ON busquedas_temp.id_cat_nodb = cat_nodb.id
				WHERE
					busquedas_temp.vencido = 0
				AND
					busquedas_temp.fecha_ini >=  '$fecha'
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
						localidades.id as id_localidad,
						localidades.localidad,
						provincias.provincia,
						categorias.categoria,
						usuarios.id AS userID,
						usuarios.nombre,
						usuarios.apellido,
						usuarios.email
					FROM
						servicios
					LEFT OUTER JOIN localidades ON servicios.id_localidades = localidades.id
					LEFT OUTER JOIN provincias ON localidades.id_provincia = provincias.id
					LEFT OUTER JOIN categorias ON servicios.id_categorias = categorias.id
					LEFT OUTER JOIN relacion_u_s ON relacion_u_s.id_servicios = servicios.id
					LEFT OUTER JOIN usuarios ON relacion_u_s.id_usurios = usuarios.id
			
					WHERE
						servicios.id = $id LIMIT 1";

		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

	public function updateServicio($post){
		/*
		Array
		(
		    $post['titulo'] => Reparador de pc2
		    $post['categoria'] => 41
		    $post['telefono'] => 11340907331
		    $post['sitioweb'] => www.google1.com
		    $post['descripcion'] => Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.1
		    $post['localidad'] => 167
		    $post['direccion'] => El Cisne, Ciudad Evita, Buenos Aires, Argentina1
		    $post['lati'] => -34.73237611
		    $post['long'] => -58.523746501
		    $post['seccion'] => editar-servicio
		    $post['foto'] => 76ced2891a8050ca5c7bdcbc12c9fb5ca_srx.jpeg
		    $post['id_servicio'] => 529
		    $post['imagen'] => 76ced2891a8050ca5c7bdcbc12c9fb5ca_srx.jpeg
		)
		*/
		$query = "	UPDATE `servicios` SET
		    `id_categorias`=".$post['categoria'].",
			`id_localidades`=".$post['localidad'].",
			`titulo`='".$post['titulo']."',
			`foto`='".$post['imagen']."',
			`url_web`='".$post['sitioweb']."',
			`direccion`='".$post['direccion']."',
			`telefono`='".$post['telefono']."',
			`latitud`='".$post['lati']."',
			`longitud`='".$post['long']."' 
			WHERE  
			`id`=".$post['id_servicio']." 
			LIMIT 1;";

			$rs    = $this->db->query($query);
			return $rs;
	}

	public function setServicio($post=null){

		if(isset($post)){

			$query = "INSERT INTO servicios (id_categorias, id_localidades, titulo, descripcion, foto, url_web, direccion, telefono, latitud, longitud) 
						VALUES (".$post['categoria'].", ".$post['localidad'].", '".$post['titulo']."', '".$post['descripcion']."', '".$post['imagen']."','".$post['sitioweb']."','".$post['direccion']."', '".$post['telefono']."', '".$post['lati']."', '".$post['long']."');";
			$rs    = $this->db->query($query);

			return $this->db->insert_id();

		}else{

			return false;		
		}

	}
	

	public function getServiciosEnPerfil($id_usuario, $desdeLimit, $cantidadLimit){
		$query =    "SELECT
						servicios.id,
						servicios.titulo,
						servicios.descripcion,
						servicios.foto,
						categorias.categoria,
						localidades.localidad,
						provincias.provincia,
						AVG(puntuacion.puntos) as promedio,
						COUNT(puntuacion.puntos) as cantVotado
					FROM
						relacion_u_s
					INNER JOIN servicios ON relacion_u_s.id_servicios = servicios.id
					INNER JOIN usuarios ON relacion_u_s.id_usurios = usuarios.id
					INNER JOIN categorias ON servicios.id_categorias = categorias.id
					INNER JOIN localidades ON servicios.id_localidades = localidades.id
					INNER JOIN provincias ON localidades.id_provincia = provincias.id
					LEFT JOIN puntuacion ON puntuacion.id_servicios = servicios.id
					WHERE relacion_u_s.id_usurios = $id_usuario
					GROUP BY servicios.id
					ORDER BY promedio DESC
					LIMIT $desdeLimit, $cantidadLimit";

		$rs    = $this->db->query($query);
		return $rs->result_array();

	}
}