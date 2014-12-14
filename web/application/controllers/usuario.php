<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_controller{

	public $UsuarioSession = null;
	
	public function __construct(){
		parent::__construct();
		$data['title'] = 'Servix';
		$this->UsuarioSession = $this->usuarios_model->isLogin();
		$this->loginFb = $this->usuarios_model->_loginFB();
		$this->load->library('usuarioClass');
		$this->load->library('servicioClass');
	}


	public function index(){
		if($this->UsuarioSession)
		{
			//Muesta los datos del usuario de la variable de sesion
			$data['usuarioSession'] = $this->UsuarioSession;
			$data['title'] 			= 'Mi Perfil';
			$data['vista'] 			= 'usuario/mi_perfil';
			$data['vistaPerfil']	= 'usuario/datos';
			$data['page_active']	= 1;


			//LA VISTA DEL DATOS LA CARGA CON $this->UsuarioSession
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}
	/*------------------------------------------------------------*/

	public function servicios_usuario(){
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] 	= $this->UsuarioSession;
			$cantidadServicios 			= $this->usuarios_model->getCantidadServicioPropios($this->UsuarioSession['id']);
			$UsServicios 				= $this->_serviciosUsuario($this->UsuarioSession['id'], $cantidadServicios, 5);
			$data['cantidad'] 			= $cantidadServicios;
			$data['serviciosPropios']	= $UsServicios['servicios'];
			$data['title'] 				= 'Mis Servicios';
			$data['vista'] 				= 'usuario/mi_perfil';
			$data['vistaPerfil']		= 'usuario/servicios_usuario';
			$data['page_active']		= 2;
			$data['paginacion'] 		= $UsServicios['vinculos'];
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _serviciosUsuario($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('mi-perfil/servicios');
        $config["total_rows"]   = $totalRows;       
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 3;
        $this->pagination->initialize($config);

        $page 		= (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3) : 0;
		$data 		= null;
		$servicios 	= $this->usuarios_model->getServiciosProrpios($idUsuario, $page, $cantidadLimit);

		if($servicios)
		{
			$serviciosObj = $this->servicioclass->setServicios($servicios);
			$serviciosObj = $this->servicioclass->setFotos($serviciosObj, '_125');

			$data['servicios'] = $serviciosObj;
			$data['vinculos'] = $this->pagination->create_links();
			return $data;
		}
		return false;
	}

	/*------------------------------------------------------------*/

	public function favoritos_usuario(){
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] = $this->UsuarioSession;
			$cantidadFavoritos 		= $this->usuarios_model->getCantidadFavoritos($this->UsuarioSession['id']);
			$Usfavoritos 			= $this->_linkFavoritos($this->UsuarioSession['id'], $cantidadFavoritos, 5);
			$data['cantidad']		= $cantidadFavoritos;
			$data['favoritos'] 		= $Usfavoritos['favoritos'];
			$data['title'] 			= 'Mis Favoritos';
			$data['vista'] 			= 'usuario/mi_perfil';
			$data['vistaPerfil']	= 'usuario/favoritos';
			$data['page_active']	= 3;
			$data['paginacion'] 	= $Usfavoritos['vinculos'];
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _linkFavoritos($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('mi-perfil/favoritos');
        $config["total_rows"]   = $totalRows;       
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 3;
        $this->pagination->initialize($config);

        $page 		= (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3) : 0;
        $data 		= null;
		$favoritos 	= $this->usuarios_model->getFavoritos($idUsuario, $page, $cantidadLimit);

		if($favoritos)
		{
			$serviciosObj = $this->servicioclass->setServicios($favoritos);
			$serviciosObj = $this->servicioclass->setFotos($serviciosObj, '_125');

			$data['favoritos'] = $serviciosObj;
			$data['vinculos'] = $this->pagination->create_links();
			return $data;
		}
		return false;
	}

	/*------------------------------------------------------------*/

	public function mis_opiniones(){
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] = $this->UsuarioSession;
			$cantidadOpiniones		= $this->usuarios_model->getCantidadComentariosRealizados($this->UsuarioSession['id']);
			$UsComentarios 			= $this->_comentariosRealizados($this->UsuarioSession['id'], $cantidadOpiniones, 5);
			$data['cantidad'] 		= $cantidadOpiniones;
			$data['comentarios'] 	= $UsComentarios['comentarios'];
			$data['title'] 			= 'Mis Opiniones';
			$data['vista'] 			= 'usuario/mi_perfil';
			$data['vistaPerfil']	= 'usuario/comentarios';
			$data['page_active']	= 4;
			$data['paginacion']	 	= $UsComentarios['vinculos'];
			$this->_js = array(
				'assets/js/jquery.raty.js',
				'assets/js/script-raty.js',
			);

			$this->_css = array(
				'assets/css/raty/jquery.raty.css',
			);


			$data['css'] = $this->_css;
			$data['js'] = $this->_js;

			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _comentariosRealizados($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('mi-perfil/mis-opiniones');
        $config["total_rows"]   = $totalRows;
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 3;
        $this->pagination->initialize($config);

        $page 			= (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3) : 0;
        $data 			= null;
		$comentarios 	= $this->usuarios_model->getComentariosRealizados($idUsuario, $page, $cantidadLimit);

		if($comentarios)
		{
			foreach ($comentarios as $key => $value)
			{
				$comentarios[$key]['link'] 	= generarLinkServicio($comentarios[$key]['id'], $comentarios[$key]['titulo']);
				$comentarios[$key]['fecha'] = fechaBarras(strtotime($comentarios[$key]['fecha_votacion']));
			}
			$data['comentarios'] = $comentarios;
			$data['vinculos'] = $this->pagination->create_links();
			return $data;
		}
		return false;
	}

	/*------------------------------------------------------------*/
	public function servicios_contactados_usuario(){
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] = $this->UsuarioSession;
			$cantidadContactados 	= $this->usuarios_model->getCantidadServiciosContactados($this->UsuarioSession['id']); 
			$UsServiciosContactados	= $this->_serviciosContactados($this->UsuarioSession['id'], $cantidadContactados, 5);
			$data['cantidad'] 		= $cantidadContactados;
			$data['sContactados'] 	= $UsServiciosContactados['sContactados'];
			$data['title'] 			= 'Servicios Contactados';
			$data['vista'] 			= 'usuario/mi_perfil';
			$data['vistaPerfil']	= 'usuario/servicios_contactados';
			$data['page_active']	= 5;
			$data['paginacion'] 	= $UsServiciosContactados['vinculos'];
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _serviciosContactados($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('mi-perfil/servicios-contactados');
        $config["total_rows"]   = $totalRows;       
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 3;
        $this->pagination->initialize($config);

        $page 			= (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3) : 0;
		$data 			= null;
		$sContactados 	= $this->usuarios_model->getServiciosContactados($idUsuario, $page, $cantidadLimit);

		if($sContactados){
			foreach ($sContactados as $key => $value) {
				$sContactados[$key]['link'] = generarLinkServicio($sContactados[$key]['id'], $sContactados[$key]['titulo']);
				$sContactados[$key]['fecha'] = fechaBarras(strtotime($sContactados[$key]['fecha']));
			}
			$data['sContactados'] = $sContactados;
			$data['vinculos'] = $this->pagination->create_links();
			return $data;
		}
		return false;
	}

	/*------------------------------------------------------------*/
	public function servicios_solicitados_usuario(){
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] 		= $this->UsuarioSession;
			$cantidadSolicitadosActivos		= $this->usuarios_model->getCantidadSolicitados($this->UsuarioSession['id'], 0);
			$cantidadSolicitadosVencidos	= $this->usuarios_model->getCantidadSolicitados($this->UsuarioSession['id'], 1);
			$cantidadTotal					= $cantidadSolicitadosActivos + $cantidadSolicitadosVencidos;
			$UsServiciosSolicitados			= $this->_serviciosSolicitados($this->UsuarioSession['id'], $cantidadTotal, 5);
			$data['cantidad'] 				= $cantidadTotal;
			$data['sSolicitados'] 			= $UsServiciosSolicitados['sSolicitados'];
			
			$data['title'] 					= 'Mis Servicios Solicitados';
			$data['vista'] 					= 'usuario/mi_perfil';
			$data['vistaPerfil']			= 'usuario/servicios_solicitados';
			$data['page_active']			= 6;
			$data['paginacion'] 			= $UsServiciosSolicitados['vinculos'];
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _serviciosSolicitados($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('mi-perfil/servicios-solicitados');
        $config["total_rows"]   = $totalRows;
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 3;
        $this->pagination->initialize($config);

		$page 			= (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3) : 0;
		$data 			= null;
		$sSolicitados 	= $this->usuarios_model->getUServiciosSolicitados($idUsuario, $page, $cantidadLimit);
		if($sSolicitados){
			foreach ($sSolicitados as $key => $value) {
				$sSolicitados[$key]['link'] = generarLinkServicio($sSolicitados[$key]['id'],$sSolicitados[$key]['categoria']."-en-".$sSolicitados[$key]['localidad']."-".$sSolicitados[$key]['provincia'],'servicio-solicitado');
				$sSolicitados[$key]['fecha'] = fechaBarras(strtotime($sSolicitados[$key]['fecha_ini']));
				$sSolicitados[$key]['link_servicio'] = site_url('mi-perfil/servicios-solicitados/editar/' . $sSolicitados[$key]['id']);
						
				$fecha_ini  = $sSolicitados[$key]['fecha_ini'];
				$vence_el = strtotime ( '+7 day' , strtotime ( $fecha_ini ) ) ;
				$vence_el = date ( 'd-m-Y' , $vence_el );
				if($sSolicitados[$key]['vencido'] == 1){
					$sSolicitados[$key]['vencido_text'] = 'Solicitud vencida';
					$sSolicitados[$key]['vencido_css'] = 'warning';
				}else{
					$sSolicitados[$key]['vencido_text']= 'Solicitud activa';
					$sSolicitados[$key]['vencido_css'] = 'success';
				}
				$sSolicitados[$key]['vence_el'] = $vence_el;
			}
			$data['sSolicitados'] = $sSolicitados;
			$data['vinculos'] = $this->pagination->create_links();
			return $data;
		}
		return false;
	}

		

	/*------------------------------------------------------------*/
	public function postulaciones_usuario(){
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] = $this->UsuarioSession;
			$cantidadPostulacionesA	= $this->usuarios_model->getCantidadPostulados($this->UsuarioSession['id'], 0, 1);
			$cantidadPostulacionesV	= $this->usuarios_model->getCantidadPostulados($this->UsuarioSession['id'], 0, 0);
			$cantidadTotal			= $cantidadPostulacionesA + $cantidadPostulacionesV;
			$UsPostulaciones 		= $this->_postulacionesRealizadas($this->UsuarioSession['id'], $cantidadTotal, 5);
			$data['cantidad']		= $cantidadTotal;
			$data['postulaciones'] 	= $UsPostulaciones['postulaciones'];
			$data['title'] 			= 'Mis Postulaciones';
			$data['vista'] 			= 'usuario/mi_perfil';
			$data['vistaPerfil']	= 'usuario/postulaciones';
			$data['paginacion']		= $UsPostulaciones['vinculos'];
			$data['page_active']	= 7;
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _postulacionesRealizadas($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('mi-perfil/postulaciones');
        $config["total_rows"]   = $totalRows;       
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 3;
        $this->pagination->initialize($config);

		$page 			= (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3) : 0;
		$data 			= null;
		$postulaciones 	= $this->usuarios_model->getUPostulaciones($idUsuario, $page, $cantidadLimit);

		if($postulaciones){
			foreach ($postulaciones as $key => $value) {
				$postulaciones[$key]['link'] = generarLinkServicio($postulaciones[$key]['id'],$postulaciones[$key]['categoria']."-en-".$postulaciones[$key]['localidad']."-".$postulaciones[$key]['provincia'],'servicio-solicitado');
				$postulaciones[$key]['fecha'] = fechaBarras(strtotime($postulaciones[$key]['fecha_ini']));
				$postulaciones[$key]['fecha_fin'] = fechaBarras(strtotime($postulaciones[$key]['fecha_fin']));
				$postulaciones[$key]['DuenioSolicitud'] = $this->usuarios_model->getUsuario($postulaciones[$key]['id_usuario']);
			}
			$data['postulaciones'] 	= $postulaciones;
			$data['vinculos'] 		= $this->pagination->create_links();
			return $data;
		}
		return false;
	}

	/*------------------------------------------------------------*/


	public function verificar(){
		//Verifica el codigo del usuario mandado por mail cuando se registra
		if(isset($_GET['codigo']))
		{
			//Si existe un codigo para verificar
			$codigoVerificar = $this->input->get('codigo', TRUE);
			$data['codigoVerificar'] = $codigoVerificar;

			$verificacionCodigo = $this->_verificarCodigoEstado($codigoVerificar);
			$data['error'] = $verificacionCodigo['error'];

			if($verificacionCodigo['error'] == false){
				$data['title'] 		= 'Verificar usuario registrado';
				$data['mensaje'] 	=  $verificacionCodigo['mensaje'];
				$data['estado'] 	=  $verificacionCodigo['estado'];
			}
			else
			{
				$data['title'] 		= 'Error al verificar usuario registrado';
				$data['mensaje'] 	=  $verificacionCodigo['mensaje'];
				$data['estado']		=  $verificacionCodigo['estado'];
			}

			//print_d($this->db->last_query());
			$data['vista'] = 'login/verificar_usuario';
			$this->load->view('login_view', $data);
		}
		else
		{
			$data['vista'] = 'index_view';
			$this->load->view('home_view',$data);
		}
	}

	public function set_favorito(){
		$id_servicio = $this->input->post('id_servicio');
		$id_usuario  = $this->UsuarioSession['id'];


		if($this->input->post('favorito') == 'on'){
			$this->usuarios_model->setFavorito($id_usuario,$id_servicio);
			echo json_encode("insert");
		}else{
			$this->usuarios_model->deleteFavorito($id_servicio, $id_usuario);
			echo json_encode("delete");
			
		}
	}

	private function _verificarCodigoEstado($codigo = null){
		//compruebo que el codigo sea valido
		$codigo = $codigo;
		$comprueboCodigo = $this->_comprobarCodigo($codigo);

		if($comprueboCodigo)
		{
			//Compruebo que en la db exista este código
			$respCodigo = $this->usuarios_model->verificarCodigo($codigo);


			//$data['respuesta'] = $respCodigo;
			//print_d($respCodigo);
			if($respCodigo)
			{
				//Si existe el código, actualizo el estado si es 0.
				switch ($respCodigo[0]['estado']) {
					case 0:
						$estado 			= 1;
						$fecha 				= date('Y-m-d H:m:i');
						$respActualizado 	= $this->usuarios_model->actualizarEstadoVerficado($estado, $codigo, $fecha);

						$verificado_result 	= array(
							'error' 	=>	false,
							'mensaje'	=>	'El usuario ha sido verificado correctamente.',
							'estado'	=>	0
					 	);
						break;

					case 1:
						$verificado_result = array(
							'error' 	=>	true,
							'mensaje'	=>	'El usuario ya ha sido verificado.',
							'estado'	=>	1
					 	);		
						break;

					case 2:
						$verificado_result = array(
							'error' 	=>	true,
							'mensaje'	=>	'El usuario no puede ser verificado.',
							'estado'	=>	2
					 	);
						break;
					
					default:
						$verificado_result = array(
							'error' 	=>	true,
							'mensaje'	=>	'El usuario no puede ser verificado.',
							'estado'	=>	3
					 	);
						break;
				}
			}
			else
			{
				$verificado_result = array(
					'error' 	=>	true,
					'mensaje'	=>	'El código de verificación no existe.',
					'estado'	=>	8
			 	);
			}
		}
		else
		{
			$verificado_result = array(
				'error' 	=>	true,
				'mensaje'	=>	'El código de verificación es inválido.',
				'estado'	=>	7
		 	);
		}

		return $verificado_result;
	}


	public function validar_voto(){
		$fechaHoy    =  date('Y-m-d');
		$userID 	 = $this->UsuarioSession['id'];
		$servID 	 = $this->input->post('id_servicio');
		$puntos  	 = $this->input->post('star');
		$fechaUso  	 = $this->input->post('fecha');
		$fechaUso    = strtotime($fechaUso);
		$fechaUso    = date('Y-m-d H:i:s' , $fechaUso);
		$comentario	 = $this->input->post('comentario');
		$votoUsuario = $this->usuarios_model->checkVoto($userID,$servID,$fechaHoy);
		$verificado_result = null;
		if(!$votoUsuario){
			$this->usuarios_model-> set_voto($userID,$servID,$puntos,$comentario,$fechaUso);
			$verificado_result['error']   = false;
			$verificado_result['mensaje'] =  "Gracias por votar este servicio";
		}else{
			$verificado_result['mensaje'] =  "No puede votar 2 veces en un día";
			$verificado_result['error']   = true;
						
		}
		echo json_encode($verificado_result);
	}
	
	public function editar_datos(){
		if($this->UsuarioSession)
		{
			//Muesta los datos del usuario de la variable de sesion
			$data['usuarioSession'] = $this->UsuarioSession;
			
			$data['js'] 			= array('assets/js/edit_user.js', 'assets/js/bootstrap.file-input.js');
			$data['editar_perfil'] 	= true;
			$data['title'] 			= 'Editar perfil';
			$data['vista'] 			= 'usuario/editar_datos';
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _comprobarCodigo($codigo){ 
	 	$permitidos = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$codigo 	= trim($codigo);
		if(strlen($codigo) < 1) {
			return false;
  		}
		for ($i = 0; $i < strlen($codigo); $i++){
			if (strpos($permitidos, substr($codigo, $i, 1)) === false){
				return false;
			}
		}
		return true;
	}

	public function actualizar_foto_perfil(){

	    $status 			= "";
	    $msg 				= "";
	    $file 				= "";
	    $file_element_name 	= 'mifoto';
     
	    if ($status != "error")
	    {
	        /*$config['upload_path'] = site_url('/assets/images/usuarios/');*/
	        $config['upload_path'] 		= './assets/images/usuarios/';
	        $config['allowed_types'] 	= 'jpg|jpeg|png';
	        $config['max_size'] 		= 1024 * 8;
	        $config['encrypt_name'] 	= TRUE;
	 
	        $this->load->library('upload', $config);
	 
	        if (!$this->upload->do_upload($file_element_name))
	        {
	            log_message('error', $this->upload->display_errors('', '') );
	            $status = "error";
                $msg 	= "Archvivo inválido";
	        }
	        else
	        {
	            //GENERAMOS THUMBNAILS DE 125 Y DE 60

	            $data 			= $this->upload->data();
	            $this->load->library('image_lib');
	            
	            //GENERO EL THUMBNAIL DE 125
	            $size_thumb		= 125;
	            $thumbNombre	= '_125';
	            $img_125_path = path_archivos('assets/images/usuarios/', agregar_nombre_archivo($data['file_name'], $thumbNombre));
    			$this->image_lib->initialize(generarThumbnail($data, $size_thumb, $thumbNombre));
    			$this->image_lib->resize();
	            $this->image_lib->initialize(generarThumbnailCuadrado($data, $size_thumb, $img_125_path, $thumbNombre));
				$this->image_lib->crop();
				$this->image_lib->clear();



	            //GENERO EL THUMBNAIL DE 60
	            $size_thumb		= 60;
	            $thumbNombre	= '_60';
	            $img_60_path = path_archivos('assets/images/usuarios/', agregar_nombre_archivo($data['file_name'], $thumbNombre));
    			$this->image_lib->initialize(generarThumbnail($data, $size_thumb, $thumbNombre));
    			$this->image_lib->resize();
	            $this->image_lib->initialize(generarThumbnailCuadrado($data, $size_thumb, $img_60_path, $thumbNombre));
				$this->image_lib->crop();
				$this->image_lib->clear();


	            $user 						= $this->UsuarioSession;
            	$foto_anterior 				= $user['foto'];
	            $path_foto_anterior			= $config['upload_path'].$foto_anterior;
	            $path_foto_125_anterior		= $config['upload_path'].agregar_nombre_archivo($foto_anterior, '_125');
	            $path_foto_60_anterior		= $config['upload_path'].agregar_nombre_archivo($foto_anterior, '_60');
	            $user['ultima_edicion'] 	= date('Y-m-d H:m:i');
	            $user['foto']				= $data['file_name'];

	            if($foto_anterior != "")
	            {
	            	$this->_borrarArchivoFotoAnterior($path_foto_anterior);
	            	$this->_borrarArchivoFotoAnterior($path_foto_125_anterior);
	            	$this->_borrarArchivoFotoAnterior($path_foto_60_anterior);
	            }

	            $file_id = $this->usuarios_model->actulaizar_foto_usuario($user);

	            $this->UsuarioSession['foto'] 			= $data['file_name'];
	            $this->UsuarioSession['foto_path'] 		= path_archivos('assets/images/usuarios/', $data['file_name']);
	            $this->UsuarioSession['foto_125_path']	= $img_125_path;
	            $this->UsuarioSession['foto_60_path']	= $img_60_path;

	            $this->session->set_userdata('logged_in', $this->UsuarioSession);
	            
	            if($file_id)
	            {
	                $status = "success";
	                $msg 	= "Foto actulaizada correctamente";
	                //$file 	= site_url('assets/images/usuarios/'.$data['file_name']);
	                $file 	= site_url($this->UsuarioSession['foto_125_path']);
	            }
	            else
	            {
	                $dalete_file = unlink($data['full_path']);
	                
	                if(!$dalete_file)
	                {
						log_message('error', 'No se pudo eliminar la imagen'.$data['full_path'] );
	                }

	                $status = "error";
	                $msg 	= "Algo ocurrió mal cuando actualizabamos tu archivo, por favor volvé a intentarlo.";
	                $file 	= "";
	            }
	        }
	        @unlink($_FILES[$file_element_name]);
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg, 'file' => $file));

	}


	private function _borrarArchivoFotoAnterior($archivoPath){
		if(file_exists($archivoPath)){
			$dalete = unlink($archivoPath);
			if(!$dalete){
				log_message('error', 'No se pudo eliminar la imagen'.$archivoPath);
			}
		}
	}


	public function perfil_usuario($usuario = null){
		$data['loginFb'] = $this->loginFb;
		if($this->UsuarioSession)
		{
			$data['usuarioSession'] = $this->UsuarioSession;

			$id = $this->_parseIdUsuario($usuario);

			if(is_numeric($id))
			{
				$data['perfil'] 		= null;
				$data['servicios']		= null;
				$data['canServicios'] 	= null;
				$data['canSolicitados'] = null;
				
				$perfil = $this->usuarios_model->getUsuario($id);

				if($perfil)
				{
					$perfilObj 			= $this->usuarioclass->setUsuarios($perfil);
					$perfilObj 			= $this->usuarioclass->setFotos($perfilObj, '_125');

					$data['perfil'] 			= $perfilObj[0];

					$cantidadServicios 			= $this->usuarios_model->getCantidadServicioPropios($id);
					$data['cantidadServicios'] 	= $cantidadServicios;

					$servicioEnPerfil 			= $this->_paginatioServiciosPerfil($id, $perfil[0]['nombre'], $perfil[0]['apellido'], $cantidadServicios, 5);

					$data['servicios'] 			= $servicioEnPerfil['servicios'];
					$data['paginacion']	 		= $servicioEnPerfil['vinculos'];
					$data['title']     			= 'Perfil de Usuario';
					$data['vista']     			= 'perfil_usuario';
				}
				else
				{
					$data['title']     = 'Perfil no encontrado';
					$data['vista']     = 'perfil_no_encontrado';
				}
			}
			else
			{
				$data['title']     = 'Perfil no encontrado';
				$data['vista']     = 'perfil_no_encontrado';
			}
		}
		else
		{
			$data['title']     = 'Perfil no encontrado';
			$data['vista']     = 'perfil_no_encontrado';
			$data['nologueado'] = TRUE;
		}

		$this->_js = array(
			'assets/js/jquery.raty.js',
			'assets/js/script-raty.js',
		);

		$this->_css = array(
			'assets/css/raty/jquery.raty.css',
		);


		$data['css'] = $this->_css;
		$data['js'] = $this->_js;
		
		$this->load->view('home_view',$data);
	}

	private function _paginatioServiciosPerfil($idUsuario, $nombre, $apellido, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('usuario/perfil/' . $idUsuario . '-' . $nombre . '-' . $apellido);
        $config["total_rows"]   = $totalRows;       
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 4;
        $this->pagination->initialize($config);

        $page 		= (is_numeric($this->uri->segment(4))) ? $this->uri->segment(4) : 0;
		$data 		= null;
		$servicios = $this->servicios_model->getServiciosEnPerfil($idUsuario, $page, $cantidadLimit);
		if($servicios)
		{
			$serviciosObj = $this->servicioclass->setServicios($servicios);
			$serviciosObj = $this->servicioclass->setFotos($serviciosObj, '_125');

			$data['servicios'] = $serviciosObj;
			$data['vinculos'] = $this->pagination->create_links();
			return $data;
		}
		return false;
	}

	private function _parseIdUsuario($usuario){
		$user = explode('-', $usuario);
		return $user[0];
	}



}
?>