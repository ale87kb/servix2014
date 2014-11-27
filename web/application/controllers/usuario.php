<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_controller{

	public function __construct(){
		parent::__construct();
		$data['title'] = 'Servix';
		$this->UsuarioSession = $this->usuarios_model->isLogin();
	}
	/*
	
	*/
	public function index(){
		if($this->UsuarioSession)
		{
			//Muesta los datos del usuario de la variable de sesion
			$data['usuarioSession'] = $this->UsuarioSession;

			$Usfavoritos 					= $this->_linkFavoritos($this->UsuarioSession['id'], 0, 5);
			$UsComentarios 					= $this->_comentariosRealizados($this->UsuarioSession['id'], 0, 5);
			$UsServiciosContactados			= $this->_serviciosContactados($this->UsuarioSession['id'], 0, 5);
			$UsServiciosSolicitados			= $this->_serviciosSolicitados($this->UsuarioSession['id'], 0, 5);

			$data['favoritos'] 		= $Usfavoritos;
			$data['comentarios'] 	= $UsComentarios;
			$data['sContactados'] 	= $UsServiciosContactados;
			$data['sSolicitados'] 	= $UsServiciosSolicitados;
			
			$data['title'] 			= 'Mi Perfil';
			$data['vista'] 			= 'usuario/mi_perfil';
			$this->load->view('usuarios_view', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	private function _linkFavoritos($idUsuario, $desdeLimit ,$cantidadLimit){
		$favoritos = $this->usuarios_model->getFavoritos($idUsuario, $desdeLimit ,$cantidadLimit);
		if($favoritos){
			foreach ($favoritos as $f => $clave) {
				$favoritos[$f]['link'] = generarLinkServicio($favoritos[$f]['id'], $favoritos[$f]['titulo']);
			}
			return $favoritos;
		}
		return false;
	}

	private function _comentariosRealizados($idUsuario, $desdeLimit ,$cantidadLimit){
		$comentarios = $this->usuarios_model->getComentariosRealizados($idUsuario, $desdeLimit ,$cantidadLimit);

		if($comentarios){
			foreach ($comentarios as $c => $clave) {
				$comentarios[$c]['link'] = generarLinkServicio($comentarios[$c]['id'], $comentarios[$c]['titulo']);
				$comentarios[$c]['fecha'] = fechaBarras(strtotime($comentarios[$c]['fecha_votacion']));
			}
			return $comentarios;
		}
		return false;
	}

	private function _serviciosContactados($idUsuario, $desdeLimit ,$cantidadLimit){
		$sContactados = $this->usuarios_model->getServiciosContactados($idUsuario, $desdeLimit ,$cantidadLimit);

		if($sContactados){
			foreach ($sContactados as $c => $clave) {
				$sContactados[$c]['link'] = generarLinkServicio($sContactados[$c]['id'], $sContactados[$c]['titulo']);
				$sContactados[$c]['fecha'] = fechaBarras(strtotime($sContactados[$c]['fecha']));
			}
			return $sContactados;
		}
		return false;
	}
	private function _serviciosSolicitados($idUsuario, $desdeLimit ,$cantidadLimit){
		$sSolicitados = $this->usuarios_model->getUServiciosSolicitados($idUsuario, $desdeLimit ,$cantidadLimit);
		if($sSolicitados){
			foreach ($sSolicitados as $c => $clave) {
				$sSolicitados[$c]['link'] = generarLinkServicio($sSolicitados[$c]['id'],$sSolicitados[$c]['categoria']."-en-".$sSolicitados[$c]['localidad']."-".$sSolicitados[$c]['provincia'],'servicio-solicitado');
				$sSolicitados[$c]['fecha'] = fechaBarras(strtotime($sSolicitados[$c]['fecha_ini']));
			}
			return $sSolicitados;
		}
		return false;
	}


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
				$data['title'] 		= 'Verificar usuario registrado en Servix';
				$data['mensaje'] 	=  $verificacionCodigo['mensaje'];
				$data['estado'] 	=  $verificacionCodigo['estado'];
			}
			else
			{
				$data['title'] 		= 'Error al verificar usuario registrado en Servix';
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

	public function editar_servicios(){
		echo "editar_servicios";
	}

	public function favoritos(){
		echo "favoritos";
	}

	public function servicios_solicitados(){
		echo "servicios_solicitados";
	}
	
	public function mis_comentarios(){
		echo "mis_comentarios";
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
	        $config['allowed_types'] 	= 'jpg|png';
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
	            $data 	= $this->upload->data();
	            $width 	= 125;
	            $height = 125;

	            $this->_generarThumbnail($data, $width, $height);
	            
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

	            $this->UsuarioSession['foto'] = $data['file_name'];
	            $this->UsuarioSession['foto_thumb'] = agregar_nombre_archivo($data['file_name'], '_thumb');
	            $this->UsuarioSession['foto_path'] = path_archivos('assets/images/usuarios/', $data['file_name']);
	            $this->UsuarioSession['foto_thumb_path'] = path_archivos('assets/images/usuarios/', agregar_nombre_archivo($data['file_name'], '_thumb'));

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

	private function _generarThumbnail($file, $width, $height){

		$config['image_library'] 	= 'GD';
		$config['source_image'] 	= $file['full_path'];
		$config['create_thumb'] 	= TRUE;
		$config['thumb_marker'] 	= '_thumb';
		$config['maintain_ratio'] 	= TRUE;
		$config['width'] 			= $width;
		$config['height'] 			= $height;
		$config['quality'] 			= '100%';

		$this->load->library('image_lib', $config);

		$result = $this->image_lib->resize();
		if(!$result){
			log_message('error', $this->image_lib->display_errors());
		}
	}

	private function _borarArchivoFotoAnterior($archivoPath){
		$dalete = unlink($archivoPath);
		if(!$dalete){
			log_message('error', 'No se pudo eliminar la imagen'.$archivoPath);
		}
	}


}


?>