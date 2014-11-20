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
			$data['usuario'] 		= $this->UsuarioSession['nombre'];
			//Muesta los datos del usuario de la variable de sesion
			$data['usuarioSession'] = $this->UsuarioSession;

			$Usfavoritos 			= $this->_linkFavoritos($this->UsuarioSession['id'], 0, 5);
			$UsCOmentarios 			= $this->_comentariosRealizados($this->UsuarioSession['id'], 0, 5);

			$data['favoritos'] 		= $Usfavoritos;
			$data['comentarios'] 	= $UsCOmentarios;
			
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
				$comentarios[$c]['link'] = generarLinkServicio($comentarios[$c]['idServicios'], $comentarios[$c]['titulo']);
			}
			return $comentarios;
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
		echo "editar_datos";
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

}


?>