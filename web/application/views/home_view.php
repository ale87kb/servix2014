<?php 
	/*
	viene del controlador de sitio
	$data['vista'] 
	que en la vista solo se llama a al index del array como variable
	osea de 	 $data['vista']  = $vista
	si vos tenes $data['pepito'] = $pepito
	*/

	$this->load->view('includes/head');
	$this->load->view('includes/header');
	if(!isset($buscador_off)){
		$this->load->view('buscador_view');
	}
	$this->load->view($vista);
	$this->load->view('includes/footer');
 ?>