<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}


	public function index(){

		/*cargar la vista del login*/
   		$this->load->helper(array('form'));
   		$this->load->view('login/login_view');
	}


	public function recuperar_clave(){
		echo "recuperar_clave";
	}


	public function registrar_usuario(){
		echo "registrar_usuario";
	}


	public function validacion_login(){

		// valida form  como en el ejemplo

		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('clave', 'clave', 'trim|required|xss_clean|callback_check_database');
           

		if($this->form_validation->run() == FALSE)
		{
		 //Field validation failed.  User redirected to login page
		 $this->load->view('login/login_view');
		}
		else
		{
		 //Go to private area
		 redirect('homelogueado', 'refresh');
		}
	}


	public function check_database($clave){
		//consulta datos en base de datos
		//llama al modelo del usuario a la funcion login

		//Field validation succeeded.  Validate against database
		$usuario = $this->input->post('usuario');

		//query the database
		$result = $this->usuarios_model->login($usuario, $clave);

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
	   redirect('login', 'refresh');
	}

}
?>