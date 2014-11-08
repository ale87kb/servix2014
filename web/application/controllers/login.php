<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		/*cargar la vista del login*/
   		$this->load->helper(array('form'));
   		$this->load->view('login_view');
	}


	public function recuperar_clave(){
		echo "recuperar_clave";
	}


	public function registrar_usuario(){
		echo "registrar_usuario";
	}



	public function validacion_login(){

		//valida form
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('clave', 'clave', 'trim|required|xss_clean|callback_check_database');
           
		if($this->form_validation->run() == FALSE)
		{
		 //Si falla la validacion se redirige a home nuevamente
		 $this->load->view('login_view');
		}
		else
		{
		 //usuario logueado - redirige a Home
		 redirect('', 'refresh');
		}
	}


	public function validacion_login_ajax(){

		//valida form como en el ejemplo

		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('clave', 'clave', 'trim|required|xss_clean|callback_check_database');

		
		/* CON BOOSTRAPVALIDATOR */
		if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'username' => form_error('usuario'),
                'password' => form_error('clave'),
                'res'      => "error"
            );

            echo json_encode($data);
        }
        else
        {
            $data = array(
				'message' => "CONECTADO",
            /*sprintf('Welcome %s', $userName),*/
                'res'      => "success"
            );
            echo json_encode($data);
            
            //aquí ya puedes procesar los datos de tu formulario
        }
	}

	// public function validacion_login_ajax(){

	// 	//valida form como en el ejemplo

	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean');
	// 	$this->form_validation->set_rules('clave', 'clave', 'trim|required|xss_clean|callback_check_database');

		
	// 	// SIN BOOSTRAPVALIDATOR 

	// 	if($this->form_validation->run() == FALSE)
 //        {
 //            $data = array(
 //                'username' => form_error('usuario'),
 //                'password' => form_error('clave'),
 //                'res'      => "error"
 //            );
 //            echo json_encode($data);
 //        }
 //        else
 //        {
 //            $data = array(
 //                'res'      => "success"
 //            );
 //            echo json_encode($data);
 //            //aquí ya puedes procesar los datos de tu formulario
 //        }


	// }


	public function check_database($clave){
		//consulta datos en base de datos
		//llama al modelo del usuario a la funcion login verifica usuario con contraseña

		//Field validation succeeded.  Validate against database
		$user = $this->input->post('usuario');

		//query the database
		$result = $this->usuarios_model->login($user, $clave);

		if($result)
		{
		 $sess_array = array();	
		 foreach($result as $row)
		 {
		   $sess_array = array(
		     'id' => $row['id'],
		     'usuario' => $row['nombre']
		   );
		   $this->session->set_userdata('logged_in', $sess_array);
		 }
		 return TRUE;
		}
		else
		{
		 $this->form_validation->set_message('check_database', 'Usuario o Clave incorrectos');
		 return false;
		}
	}
	

	public function logout(){

		//Destruye la sesion del usuario y vuelve a login.
	   $this->session->unset_userdata('logged_in');
	   $this->session->sess_destroy();
	   redirect('', 'refresh');
	}

}
?>