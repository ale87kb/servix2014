<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$data['title'] = 'Servix';
		$this->UsuarioSession = $this->usuarios_model->isLogin();
	}


	public function index(){
		//Cargar la vista del formulario de login
		if(!$this->UsuarioSession){
	   		$this->load->helper(array('form'));
			$data['title'] = 'Iniciar sesión';
			$data['vista'] = 'login/login_form';
			$data['js'] = array('assets/js/login_page.js');
			$this->load->view('login_view',$data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}


	public function recuperar_clave(){
		if(!$this->UsuarioSession)
		{
			$this->load->helper(array('form'));
			$data['title'] = 'Recuperar Clave';
			$data['vista'] = 'login/recuperar_clave';
			$data['js'] = array('assets/js/login_page.js');
			$this->load->view('login_view',$data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	public function validar_recuperar_clave(){
		if(isset($_POST['grabar']) and $_POST['grabar'] == 'si'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('usuario', 'e-mail', 'trim|required|valid_email|xss_clean|callback_check_user_database');
			
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email', 'Ingrese un %s válido');
			if($this->form_validation->run() == FALSE)
			{
				$this->recuperar_clave();
			}
			else
			{
				
				//Si el email es valido, 
				//actualizo la fehca de la ultima edicion
				//y genero una nueva contraseña para enviarla por email
				$fecha = date('Y-m-d H:m:i');
				$usuariorecupero['ultima_edicion'] 	= $fecha;
				$usuariorecupero['usuario'] 		= $this->input->post('usuario', TRUE);
				$usuariorecupero['clave'] 			= $this->_generaPass();

				$resultadoRecuClav = $this->usuarios_model->actualizar_clave($usuariorecupero);

					
				//this->sendEmailNuevaClave($usuariorecupero);

				if($resultadoRecuClav){

					$mailenviado = $this->sendEmailNuevaClave($usuariorecupero);

					if($mailenviado){

						$data['mailenviado'] = 'Mensaje enviado';
					}
					else
					{
						$data['mailnoenviado'] = $this->email->print_debugger();
					}

					$data['correcto'] 	= "La clave a sido actualizada";
					$data['title'] 		= "Recuperar Clave";
					$data['vista'] 		= "login/recuperar_clave_respuesta";
					$this->load->view("login_view", $data);

				}
				else
				{
					$data['mensaje'] 	= "La actualizacion de la clave de usuario ha fallado, por favor intente mas tarde.";
					$data['title'] 		= "Recuperar Clave - Error";
					$data['vista'] 		= "login/recuperar_clave_respuesta";
					$this->load->view("login_view", $data);

				}
			}
		}

	}


	public function registrar_usuario(){
		if(!$this->UsuarioSession){
			//Carga vista del formulario de registro
			$data['title'] = 'Registrar usuario';
			$data['vista'] = 'registro_view';
			$data['js'] = array('assets/js/registro_page.js');
			$this->load->view('login_view',$data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}


	public function validar_nuevo_usuario(){
		//Valida el formulario de registro de nuevo usuario

		if(isset($_POST['grabar']) and $_POST['grabar'] == 'si'){

			$this->load->library('form_validation');

			$this->form_validation->set_rules('usuario', 'e-mail', 'trim|required|valid_email|xss_clean|callback_check_user_duplicate');
			$this->form_validation->set_rules('clave', 'contraseña', 'trim|required|xss_clean|md5');
			$this->form_validation->set_rules('rclave', 'repetir contraseña', 'trim|required|matches[clave]|xss_clean|md5');

			$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apellido', 'apellido', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dni', 'DNI', 'trim|required|numeric|xss_clean|callback_check_dni_duplicate');
			$this->form_validation->set_rules('direccion', 'direccion', 'trim|xss_clean');
			$this->form_validation->set_rules('telefono', 'teléfono', 'trim|xss_clean');

			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email', 'Ingrese un %s válido');

			if($this->form_validation->run() == FALSE)
			{
				$this->registrar_usuario();
			}
			else
			{
				$fecha = date('Y-m-d H:m:i');

				$nuevoUsuario['fecha_creacion'] 	= $fecha;
				$nuevoUsuario['fecha_mod_estado'] 	= $fecha;
				$nuevoUsuario['ultima_edicion'] 	= $fecha;
				$nuevoUsuario['usuario'] 			= $this->input->post('usuario', TRUE);
				$nuevoUsuario['clave'] 				= $this->input->post('clave', TRUE);
				$nuevoUsuario['nombre'] 			= $this->input->post('nombre', TRUE);
				$nuevoUsuario['apellido'] 			= $this->input->post('apellido');
				$nuevoUsuario['dni'] 				= $this->input->post('dni', TRUE);
				$nuevoUsuario['telefono'] 			= $this->input->post('telefono', TRUE);
				$nuevoUsuario['direccion'] 			= $this->input->post('direccion', TRUE);
				$nuevoUsuario['codigo'] 			= $this->_generarCodigo();
				$nuevoUsuario['foto'] 				= '';

				
				$nuevoUsuario['estado'] 			= 0;
				//El estado del usuario puede ser 
				// 0 : Registrado, email NO verificado 
				// 1 : Registrado, email verificado
				// 2 : Usuario dado de baja
				
				//$this->sendEmailConfirm($nuevoUsuario);

				$resultAdd = $this->usuarios_model->add_usuario($nuevoUsuario);


				if($resultAdd)
				{
					//Envio un mail para confirmar usuario

					$mailenviado = $this->sendEmailConfirm($nuevoUsuario);
					if($mailenviado){
						$data['mailenviado'] = "Mensaje enviado";
					}
					else
					{
						$data['mailnoenviado'] = $this->email->print_debugger();
					}


					$data['correcto'] 	= "Registro correcto";

					$data['title'] 		= "Registro de Usuario en Servix";
					$data['vista'] 		= "login/registro_respuesta";
					$this->load->view("login_view", $data);
				}
				else
				{
					$data['mensaje'] 	= "El registro de usuario ha fallado, por favor intente mas tarde.";
					$data['title'] 		= "Registro de Usuario en Servix - Error";
					$data['vista'] 		= "login/registro_respuesta";
					$this->load->view("login_view", $data);
				}
			}
		}
	}
	public function validar_nuevo_usuario_ajax(){
		//Valida el formulario de registro de nuevo usuario

		if(isset($_POST['grabar']) and $_POST['grabar'] == 'si'){

			$this->load->library('form_validation');

			$this->form_validation->set_rules('usuario', 'e-mail', 'trim|required|valid_email|xss_clean|callback_check_user_duplicate');
			$this->form_validation->set_rules('clave', 'contraseña', 'trim|required|xss_clean|md5');
			$this->form_validation->set_rules('rclave', 'repetir contraseña', 'trim|required|matches[clave]|xss_clean|md5');

			$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apellido', 'apellido', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dni', 'DNI', 'trim|required|numeric|xss_clean|callback_check_dni_duplicate');
			$this->form_validation->set_rules('direccion', 'direccion', 'trim|xss_clean');
			$this->form_validation->set_rules('telefono', 'teléfono', 'trim|xss_clean');

			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email', 'Ingrese un %s válido');

			$data = array();

			if($this->form_validation->run() == FALSE)
			{
				//$this->registrar_usuario();
/*				if(form_error('usuario') != "")*/
				if(form_error('usuario'))
	            {
		            $data['username'] = form_error('usuario');
	            }
	           	if(form_error('dni'))
	           	{
		            $data['dni'] = form_error('dni');
	           	}
	           	
	           	$data['res'] = "error";
	            echo json_encode($data);
			}
			else
			{
				$fecha = date('Y-m-d H:m:i');

				$nuevoUsuario['fecha_creacion'] 	= $fecha;
				$nuevoUsuario['fecha_mod_estado'] 	= $fecha;
				$nuevoUsuario['ultima_edicion'] 	= $fecha;
				$nuevoUsuario['usuario'] 			= $this->input->post('usuario', TRUE);
				$nuevoUsuario['clave'] 				= $this->input->post('clave', TRUE);
				$nuevoUsuario['nombre'] 			= $this->input->post('nombre', TRUE);
				$nuevoUsuario['apellido'] 			= $this->input->post('apellido');
				$nuevoUsuario['dni'] 				= $this->input->post('dni', TRUE);
				$nuevoUsuario['telefono'] 			= $this->input->post('telefono', TRUE);
				$nuevoUsuario['direccion'] 			= $this->input->post('direccion', TRUE);
				$nuevoUsuario['codigo'] 			= $this->_generarCodigo();
				$nuevoUsuario['foto'] 				= '';

				$nuevoUsuario['estado'] 			= 0;
				//El estado del usuario puede ser 
				// 0 : Registrado, email NO verificado 
				// 1 : Registrado, email verificado
				// 2 : Usuario dado de baja
				
				//$this->sendEmailConfirm($nuevoUsuario);

				$resultAdd = $this->usuarios_model->add_usuario($nuevoUsuario);

				if($resultAdd)
				{

					$data['adduser'] 	= true;
					$data['mensaje'] 	= "Registro correcto";
					$data['title'] 		= "Registro de Usuario en Servix";
					$data['vista'] 		= "login/registro_respuesta";

					//Envio un mail para confirmar usuario
					$mailenviado = $this->sendEmailConfirm($nuevoUsuario);
					
					if($mailenviado){
						$data['mailenviado'] 	= true;
						$data['mailmssg'] 		= "Mensaje enviado";
					}
					else
					{
						//$data['mailnoenviado'] = $this->email->print_debugger();
						$data['mailenviado'] 	= false;
						$data['mailmssg'] 		= "No se pudo enviar el mensaje.";
						
						log_message('error', $this->email->print_debugger());

					}
				}
				else
				{
					$data['adduser'] 	= false;
					$data['mensaje'] 	= "El registro de usuario ha fallado, por favor intente mas tarde.";
					$data['title'] 		= "Registro de Usuario en Servix - Error";
					$data['vista'] 		= "login/registro_respuesta";
				}

				$data['res'] = "success";
				echo json_encode($data);
			}
		}
	}

	public function check_newPassword($clave){
		$user = (int)$this->input->post('user');
		$UsuarioRegistrado	= $this->usuarios_model->getUsuario($user);

		$result = $this->usuarios_model->login($UsuarioRegistrado[0]['email'], $clave);
		//print_d($result);
		//print_d($this->db->last_query());
		if($result)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_newPassword', 'Clave incorrecta.');
			return false;
		}
	}

	public function validar_editar_datos(){
		//Valida el formulario de edicion de usuario

		if(isset($_POST['grabar']) and $_POST['grabar'] == 'si'){

			$id_usuario 		= (int)$this->input->post('user');
			$UsuarioRegistrado	= $this->usuarios_model->getUsuario($id_usuario);
			$usuario 			= $this->input->post('usuario');
			$clave 				= $this->input->post('clave');
			$newEmail = false;
			$newClave = false;

			$this->load->library('form_validation');


			if($usuario != $UsuarioRegistrado[0]['email']){
				$this->form_validation->set_rules('usuario', 'e-mail', 'trim|required|valid_email|xss_clean|callback_check_user_duplicate');
				$newEmail = true;
			}

			if($clave != ""){
				$this->form_validation->set_rules('clave', 'contraseña', 'trim|required|xss_clean|callback_check_newPassword');
				$this->form_validation->set_rules('nclave', 'nueva contraseña', 'trim|required|xss_clean');
				$this->form_validation->set_rules('rclave', 'repetir nueva contraseña', 'trim|required|matches[nclave]|xss_clean');
				$newClave = true;
			}

			$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apellido', 'apellido', 'trim|required|xss_clean');
			$this->form_validation->set_rules('direccion', 'direccion', 'trim|xss_clean');
			$this->form_validation->set_rules('telefono', 'teléfono', 'trim|xss_clean');

			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email', 'Ingrese un %s válido');

			$data = array();

			if($this->form_validation->run() == FALSE)
			{
				if(form_error('usuario'))
	            {
		            $data['username'] 	= form_error('usuario');
	            }
	            if(form_error('clave'))
	            {
	            	$data['clave'] 		= form_error('clave');
	            }
	           	
	           	$data['res'] = "error";
	            echo json_encode($data);
			}
			else
			{
				//Si cambia email, modifico el estado a 0 con nuevo codigo para que verifique nuevamente el usuario mandando un email.
				//Si cambia la contraseña, mando un emial notificando.
				//Si cambia datos, modifica db
				$fecha = date('Y-m-d H:m:i');

				$usuarioEditado['id'] 				= (int)$id_usuario;
				$usuarioEditado['nombre'] 			= $this->input->post('nombre', TRUE);
				$usuarioEditado['apellido'] 		= $this->input->post('apellido');
				$usuarioEditado['telefono'] 		= $this->input->post('telefono', TRUE);
				$usuarioEditado['direccion'] 		= $this->input->post('direccion', TRUE);
				$usuarioEditado['ultima_edicion'] 	= $fecha;

				if($newEmail)
				{
					$usuarioEditado['usuario'] 		= $this->input->post('usuario', TRUE);
					$usuarioEditado['codigo'] 		= $this->_generarCodigo();
					$usuarioEditado['estado'] 		= 0;
					//El estado del usuario puede ser 
					// 0 : Registrado, email NO verificado 
					// 1 : Registrado, email verificado
					// 2 : Usuario dado de baja
					
					$resultadoE = $this->usuarios_model->editar_email($usuarioEditado);
					if($resultadoE)
					{
						$data['newEmail'] = $newEmail;
						$envioNuevoMail = $this->sendEmailNewConfirm($usuarioEditado);

						if($envioNuevoMail)
						{
							$data['envioNuevoMail'] = true;
							$data['mailnuevomail'] = "Mensaje enviado. Confirme su usuario.";
						}
						else
						{
							$data['envioNuevoMail'] 	= false;
							$data['mailnuevomail'] 		= "No se pudo enviar el mensaje.";
							log_message('error', $this->email->print_debugger());
						}
					} 
				}

				if($newClave)
				{
					$usuarioEditado['clave'] 		= $this->input->post('nclave', TRUE);

					$resultadoC = $this->usuarios_model->editar_clave($usuarioEditado);

					if($resultadoC)
					{
						$data['newClave'] = $newClave;
						$UsuarioNuevo	= $this->usuarios_model->getUsuario($id_usuario);
						$usuarioEditado['usuario'] 		= $UsuarioNuevo[0]['email'];


						$envioEditClave = $this->sendEmailCambioClave($usuarioEditado);
						if($envioEditClave)
						{
							$data['envioEditClave']		= true;
							$data['maileditclave']		= "Mensaje enviado";
						}
						else
						{
							$data['envioEditClave']		= false;
							$data['maileditclave']		= "No se pudo enviar el mensaje.";

						}
					}
				}


				$resultadoU = $this->usuarios_model->editar_usuario($usuarioEditado);

				if($resultadoU)
				{
					$data['edditUser'] 	= true;
					$data['mensaje'] 	= "Datos modificados correctamente";
					$data['title'] 		= "Edicion de perfil correcta";
					$data['vista'] 		= "usuario";
				}
				else
				{
					$data['edditUser'] 	= false;
					$data['mensaje'] 	= "Los datos del perfil de usuario no se pudieron modificar, por favor intente mas tarde.";
					$data['title'] 		= "Edicion de perfil - Error";
					$data['vista'] 		= "usuario";
				}
				
				$data['res'] = "success";
				
				//Vuelvo a traer el usuario con nuevos datos
				//y actualizo la session
				$NuevosDatos 		= $this->usuarios_model->getUsuario($id_usuario);
				$NuevosDatosSession = $this->_setDataSession($NuevosDatos);

				echo json_encode($data);
			}
		}
	}

	public function editar_usuario_respuesta(){
		$data = $this->input->post(json_decode('datos', true));
		$vista = $this->load->view('usuario/editar_usuario_respuesta', $data['datos'], true);
		echo $vista;
	}



	public function registro_respuesta(){
		$data = $this->input->post(json_decode('datos',true));
		//print_d($data);
		$vista = $this->load->view('login/registro_respuesta',$data['datos'],true);
		echo $vista;
	}


	public function check_user_duplicate(){
		//Consulta si el usuario/email ya existe en la base de datos
		//llama al modelo del usuario a la funcion getEmail verifica usuario registrado

		//Validacion del campo con exito, se comprueba contra la base de datos
		$user = $this->input->post('usuario');

		//Query a la base de datos
		$resultEmail = $this->usuarios_model->getEmail($user);

		if($resultEmail)
		{
			$this->form_validation->set_message('check_user_duplicate', 'El e-mail ingresado ya esta registrado.');
			return false;
		}
		else
		{
			return true;
		}

	}


	public function check_dni_duplicate(){
		//Consulta si el dni ingresado esta dubplicado en la base de datos

		$dni = $this->input->post('dni');

		$resultadoDni = $this->usuarios_model->getDNI($dni);

		if($resultadoDni){
			$this->form_validation->set_message('check_dni_duplicate', 'El DNI ingresado ya esta registrado.');
			return false;
		}
		else
		{
			return true;
		}
	}


	public function sendEmailConfirm($post){
		
		//$this->load->view('email/confirmEmail', $post);

		if(isset($post)){

		 	// print_d($post);
		 	$this->load->library('email');
		 	$config['charset'] 	= 'utf-8';
	        $config['wordwrap'] = TRUE;
	        $config['mailtype'] = 'html';
	        $fromemail          = 'no-responder@servix.com'; // desde
	        $toemail            = $post['usuario']; //para
	        $mail               = null;
	        $subject            = "Confirmación de e-mail de registro en Servix";

	        
	        $this->email->initialize($config);
	        $this->email->from($fromemail, 'Servix');
        	$this->email->to($toemail);
	        
	        $this->email->subject($subject);
	        $mesg  = $this->load->view('email/confirmEmail', $post, true);
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	      
	      return $mail;
		}
	}

	public function sendEmailNuevaClave($post){
		
		//$this->load->view('email/recuperarClave', $post);

		if(isset($post)){

		 	// print_d($post);
		 	$this->load->library('email');
		 	$config['charset'] 	= 'utf-8';
	        $config['wordwrap'] = TRUE;
	        $config['mailtype'] = 'html';
	        $fromemail          = 'no-responder@servix.com'; // desde
	        $toemail            = $post['usuario']; //para
	        $mail               = null;
	        $subject            = "Nueva Clave en Servix";

	        
	        $this->email->initialize($config);
	        $this->email->from($fromemail, 'Servix');
        	$this->email->to($toemail);
	        
	        $this->email->subject($subject);
	        $mesg  = $this->load->view('email/recuperarClave', $post, true);
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	      
	      return $mail;
		}
	}

	public function sendEmailNewConfirm($post){
		
		//$this->load->view('email/confirmNewEmail', $post);

		if(isset($post)){

		 	// print_d($post);
		 	$this->load->library('email');
		 	$config['charset'] 	= 'utf-8';
	        $config['wordwrap'] = TRUE;
	        $config['mailtype'] = 'html';
	        $fromemail          = 'no-responder@servix.com'; // desde
	        $toemail            = $post['usuario']; //para
	        $mail               = null;
	        $subject            = "Confirmación de nuevo e-mail de usuario en Servix";

	        
	        $this->email->initialize($config);
	        $this->email->from($fromemail, 'Servix');
        	$this->email->to($toemail);
	        
	        $this->email->subject($subject);
	        $mesg  = $this->load->view('email/confirmNewEmail', $post, true);
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	      
	      return $mail;
		}
	}

	public function sendEmailCambioClave($post){
		
		//$this->load->view('email/confirmNewEmail', $post);

		if(isset($post)){

		 	// print_d($post);
		 	$this->load->library('email');
		 	$config['charset'] 	= 'utf-8';
	        $config['wordwrap'] = TRUE;
	        $config['mailtype'] = 'html';
	        $fromemail          = 'no-responder@servix.com'; // desde
	        $toemail            = $post['usuario']; //para
	        $mail               = null;
	        $subject            = "Modificación de Clave en Servix";

	        
	        $this->email->initialize($config);
	        $this->email->from($fromemail, 'Servix');
        	$this->email->to($toemail);
	        
	        $this->email->subject($subject);
	        $mesg  = $this->load->view('email/cambioClave', $post, true);
	        $this->email->message($mesg);
	        $mail = $this->email->send();
	      
	      return $mail;
		}
	}



	public function validacion_login(){
		//Valida el formulario de login
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('clave', 'clave', 'trim|required|xss_clean|callback_check_database');
           
		if($this->form_validation->run() == FALSE)
		{
			//Si falla la validacion se redirige a pantalla de login
			$this->load->view('login_view');
		}
		else
		{
			//Usuario logueado -> se redirige a Home
			redirect('', 'refresh');
		}
	}


	public function validacion_login_ajax(){

		//Valida el formulario de login por ajax

		$this->load->library('form_validation');


		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean|valid_email|callback_check_user_database');
		$this->form_validation->set_rules('clave', 'clave', 'trim|required|xss_clean|callback_check_password_database');
		$data = array();
		
		/* CON BOOSTRAPVALIDATOR */
		if($this->form_validation->run() == FALSE)
        {
            if(form_error('usuario'))
            {
	            $data = array(
	                'username' => form_error('usuario'),
	                'res'      => "error"
	            );
            }
           	else if(form_error('clave')){
	            $data = array(
	                'password' => form_error('clave'),
	                'res'      => "error"
				);
           	}
            echo json_encode($data);
        }
        else
        {
            $data = array(
                'res'      	=> "success"
            );
            echo json_encode($data);
        }
	}


	public function menu_usuario(){
		$data['usuarioSession'] = $this->UsuarioSession;
		$vista = $this->load->view('includes/user_log',$data,true);
		echo $vista;
	}


	public function check_user_database(){
		//Consulta el usuario en base de datos
		//llama al modelo del usuario a la funcion getEmail verifica usuario registrado

		//Validacion del campo con exito, se comprueba contra la base de datos
		$user = $this->input->post('usuario');

		//Query a la base de datos
		$resultemail = $this->usuarios_model->getEmail($user);

		if($resultemail)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_user_database', 'Usuario incorrecto o no registrado');
			return false;
		}
	}


	public function check_password_database($clave){
		//Consulta la clave en base de datos
		//llama al modelo del usuario a la funcion login verifica usuario con contraseña

		//Validacion del campo con exito, se comprueba contra la base de datos
		$user = $this->input->post('usuario');

		//Query a la base de datos
		$result = $this->usuarios_model->login($user, $clave);

		if($result)
		{
			$this->_setDataSession($result);
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_password_database', 'Clave incorrecta');
			return false;
		}
	}

	private function _setDataSession($result){
		$sess_array = array();
		foreach($result as $row)
		{
			$sess_array = array(
			 'id' 				=> $row['id'],
			 'email' 			=> $row['email'],
			 'nombre' 			=> $row['nombre'],
			 'apellido' 		=> $row['apellido'],
			 'dni' 				=> $row['dni'],
			 'direccion'		=> $row['direccion'],
			 'telefono' 		=> $row['telefono'],
			 'foto'				=> $row['foto'],		//default -> assets/images/profile_640.png
			 'estado'			=> $row['estado'],
			 'ultima_edicion'	=> $row['ultima_edicion']
			);
			$this->session->set_userdata('logged_in', $sess_array);
		}
	}
	

	public function logout(){
		//Destruye la sesion del usuario y vuelve a login.
   		$this->session->unset_userdata('logged_in');
	   	$this->session->sess_destroy();
	   	redirect('', 'refresh');
	}


	private function _generarCodigo() {
		$key = md5(microtime().rand());
		return $key;
	}

	private function _generaPass(){
	    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	    $longitudCadena = strlen($cadena);
	     
	    //Se define la variable que va a contener la contraseña
	    $pass = "";
	    //Se define la longitud de la contraseña
	    $longitudPass = 10;
	     
	    //Creamos la contraseña
	    for($i=1 ; $i<=$longitudPass ; $i++){
	        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
	        $pos = rand(0,$longitudCadena-1);
	     
	        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
	        $pass .= substr($cadena,$pos,1);
	    }
	    return $pass;
	}

	//Chequea que la foto no este vacia, y si lo esta devuelve la foto por default: assets/images/profile_640.png
	/*private function _chekFotoDB($user){
			if($user['foto'] == ""){
				$user[]
			}
	}*/




	/*
	.....................................................................................
	COMENTADA PARA FUTURO USO.. EN ESTOS MOMENTOS ESTA EN DESUSO
	.....................................................................................
	public function generarCodigo($longitud) {
		$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	}

	*/
}
?>