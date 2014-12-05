<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_controller{

	public $UsuarioSession = null;
	
	public function __construct(){
		parent::__construct();
		$data['title'] = 'Servix';
		$this->UsuarioSession = $this->usuarios_model->isLogin();
		$this->loginFb = $this->usuarios_model->_loginFB();
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
			foreach ($servicios as $key => $value)
			{
				$servicios[$key]['link'] = generarLinkServicio($servicios[$key]['id'],$servicios[$key]['titulo']);
				if($servicios[$key]['foto'] == "" || $servicios[$key]['foto'] == null)
				{
					$servicios[$key]['foto_path'] = 'assets/images/servicio_125.jpg';
				}
				else if(file_exists('./assets/images/servicios/' . $servicios[$key]['foto']))
				{
					$servicios[$key]['foto_path'] = path_archivos('assets/images/servicios/', agregar_nombre_archivo($servicios[$key]['foto'], '_thumb'));
				}
				else 
				{
					$servicios[$key]['foto_path'] = 'assets/images/servicio_125.jpg';
				}
			}
			$data['servicios'] = $servicios;
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
			foreach ($favoritos as $key => $vlaue)
			{
				$favoritos[$key]['link'] = generarLinkServicio($favoritos[$key]['id'], $favoritos[$key]['titulo']);
				if($favoritos[$key]['foto'] == "" || $favoritos[$key]['foto'] == null)
				{
					$favoritos[$key]['foto_path'] = 'assets/images/servicio_125.jpg';
				}
				else if(file_exists('./assets/images/servicios/' . $favoritos[$key]['foto']))
				{
					$favoritos[$key]['foto_path'] = path_archivos('assets/images/servicios/', agregar_nombre_archivo($favoritos[$key]['foto'], '_thumb'));
				}
				else 
				{
					$favoritos[$key]['foto_path'] = 'assets/images/servicio_125.jpg';
				}
			}
			$data['favoritos'] = $favoritos;
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

	public function actulaizar_foto_perfil(){

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
	            $status = "error";
	            $msg = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $data 			= $this->upload->data();
	            $size_thumb		= 125;
	            $thumbNombre	= '_thumb';
	            $img_thumb_path = path_archivos('assets/images/usuarios/', agregar_nombre_archivo($data['file_name'], $thumbNombre));
    
	            //$this->_generarThumbnail($data, $width, $height);
	            //GENERO EL THUMBNAIL DE 125
	            $this->_generarThumbnail($data, $size_thumb, $img_thumb_path, $thumbNombre);

	            //GENERO EL THUMBNAIL DE 200
	           /* $size_thumb		= 200;
	            $thumbNombre	= '_thumbx200';
	            $img_thumb_path = path_archivos('assets/images/usuarios/', agregar_nombre_archivo($data['file_name'], $thumbNombre));
	            $this->_generarThumbnail($data, $size_thumb, $img_thumb_path, $thumbNombre);*/


	            $user 						= $this->UsuarioSession;
            	$foto_anterior 				= $user['foto'];
	            $path_foto_anterior			= $config['upload_path'].$foto_anterior;
	            $path_foto_thumb_anterior	= $config['upload_path'].$user['foto_thumb'];
	            $user['ultima_edicion'] 	= date('Y-m-d H:m:i');
	            $user['foto']				= $data['file_name'];

	            if($foto_anterior != "")
	            {
	            	$this->_borarArchivoFotoAnterior($path_foto_anterior);
	            	$this->_borarArchivoFotoAnterior($path_foto_thumb_anterior);
	            }

	            $file_id = $this->usuarios_model->actulaizar_foto_usuario($user);

	            $this->UsuarioSession['foto'] 			= $data['file_name'];
	            $this->UsuarioSession['foto_thumb'] 	= agregar_nombre_archivo($data['file_name'], '_thumb');
	            $this->UsuarioSession['foto_path'] 		= path_archivos('assets/images/usuarios/', $data['file_name']);
	            $this->UsuarioSession['foto_thumb_path']= $img_thumb_path;

	            $this->session->set_userdata('logged_in', $this->UsuarioSession);
	            
	            if($file_id)
	            {
	                $status = "success";
	                $msg 	= "Foto actulaizada correctamente";
	                //$file 	= site_url('assets/images/usuarios/'.$data['file_name']);
	                $file 	= site_url($this->UsuarioSession['foto_thumb_path']);
	                

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

	/*private function _generarThumbnail($file, $width, $height){

		//Tipos de 'image_library': 'GD', 'GD2', 'ImageMagick', 'NetPBM'

		$config['image_library'] 	= 'GD2'; //o usar libreria 'ImageMagic'
		$config['source_image'] 	= $file['full_path'];
		$config['create_thumb'] 	= TRUE;
		$config['thumb_marker'] 	= '_thumb';
		$config['maintain_ratio'] 	= TRUE;
		$config['width'] 			= $width;
		$config['height'] 			= $height;
		$config['quality'] 			= '100';

		$this->load->library('image_lib', $config);

		$result = $this->image_lib->resize();
		if(!$result){
			log_message('error', $this->image_lib->display_errors());
		}
	}*/



	private function _generarThumbnail($file, $size, $img_path, $thumbNombre)
	{
	 	$img_thumb = $img_path;

	    $config['image_library'] 	= 'gd2';
	    $config['source_image'] 	= $file['full_path'];
	    $config['create_thumb'] 	= TRUE;
	    $config['maintain_ratio'] 	= FALSE;
		$config['thumb_marker'] 	= $thumbNombre;
	   
	    $_width = $file['image_width'];
	    $_height = $file['image_height'];

	    $img_type = '';
	    $thumb_size = $size;

	    if ($_width > $_height)
	    {
	        // wide image
	        $config['width'] = intval(($_width / $_height) * $thumb_size);
	        if ($config['width'] % 2 != 0)
	        {
	            $config['width']++;
	        }
	        $config['height'] = $thumb_size;
	        $img_type = 'wide';
	    }
	    else if ($_width < $_height)
	    {
	        // landscape image
	        $config['width'] = $thumb_size;
	        $config['height'] = intval(($_height / $_width) * $thumb_size);
	        if ($config['height'] % 2 != 0)
	        {
	            $config['height']++;
	        }
	        $img_type = 'landscape';
	    }
	    else
	    {
	        // square image
	        $config['width'] = $thumb_size;
	        $config['height'] = $thumb_size;
	        $img_type = 'square';
	    }

	    $this->load->library('image_lib');
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();


	    // reconfiguramos para cortar el thumbnail
	    $conf_new = array(
	        'image_library' => 'gd2',
	        'source_image' => $img_thumb,
	        'create_thumb' => FALSE,
	        'maintain_ratio' => FALSE,
	        'width' => $thumb_size,
	        'height' => $thumb_size
	    );

	    if ($img_type == 'wide')
	    {
	        $conf_new['x_axis'] = ($config['width'] - $thumb_size) / 2 ;
	        $conf_new['y_axis'] = 0;
	    }
	    else if($img_type == 'landscape')
	    {
	        $conf_new['x_axis'] = 0;
	        $conf_new['y_axis'] = ($config['height'] - $thumb_size) / 2;
	    }
	    else
	    {
	        $conf_new['x_axis'] = 0;
	        $conf_new['y_axis'] = 0;
	    }

	    $this->image_lib->initialize($conf_new);

	    $this->image_lib->crop();
	}


	private function _borarArchivoFotoAnterior($archivoPath){
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
				$data['perfil'] = null;
				$data['servicios'] = null;
				$data['canServicios'] = null;
				$data['canSolicitados'] = null;
				$perfil = $this->usuarios_model->getUsuario($id);
				if($perfil)
				{
					if($perfil[0]['foto'] == "" || $perfil[0]['foto'] == null)
					{
						$perfil[0]['foto_path'] = 'assets/images/perfil_200.png';
					}
					else if(file_exists('./assets/images/usuarios/' . $perfil[0]['foto']))
					{
						$perfil[0]['foto_path'] = path_archivos('assets/images/usuarios/', agregar_nombre_archivo($perfil[0]['foto'], '_thumb'));
					}
					else 
					{
						$perfil[0]['foto_path'] = 'assets/images/perfil_200.png';
					}
					
					$data['perfil'] = $perfil[0];
					$cantidadServicios 			= $this->usuarios_model->getCantidadServicioPropios($id);
					$data['cantidadServicios'] = $cantidadServicios;

					$servicioEnPerfil = $this->_paginatioServiciosPerfil($id, $cantidadServicios, 5);
					
					$data['servicios'] 	= $servicioEnPerfil['servicios'];
					$data['paginacion']	 	= $servicioEnPerfil['vinculos'];
					$data['title']     = 'Perfil de Usuario';
					$data['vista']     = 'perfil_usuario';
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

	private function _paginatioServiciosPerfil($idUsuario, $totalRows, $cantidadLimit){
		$this->load->library('pagination');
	    $config = array();
        $config["base_url"] 	= site_url('usuario/perfil/1-Pedro-DonCorlione');
        $config["total_rows"]   = $totalRows;       
        $config["per_page"] 	= $cantidadLimit;
        $config["uri_segment"]  = 4;
        $this->pagination->initialize($config);

        $page 		= (is_numeric($this->uri->segment(4))) ? $this->uri->segment(4) : 0;
		$data 		= null;
		$servicios = $this->servicios_model->getServiciosEnPerfil($idUsuario, $page, $cantidadLimit);
		if($servicios)
		{
			foreach ($servicios as $servicio => $value)
			{
				$servicios[$servicio]['link_servicio'] = site_url(generarLinkServicio($servicios[$servicio]['id'], $servicios[$servicio]['titulo'] ));
				
				if($servicios[$servicio]['foto'] == "" || $servicios[$servicio]['foto'] == null)
				{
					$servicios[$servicio]['foto_path'] = 'assets/images/servicio_200.jpg';
				}
				else if(file_exists('./assets/images/usuarios/' . $servicios[$servicio]['foto']))
				{
					$servicios[$servicio]['foto_path'] = path_archivos('assets/images/servicios/', $servicios[$servicio]['foto']);
				}
				else
				{
					$servicios[$servicio]['foto_path'] = 'assets/images/servicio_200.jpg';
				}
			}
			$data['servicios'] = $servicios;
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