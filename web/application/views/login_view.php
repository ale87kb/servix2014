<?php 
  /*
  viene del controlador de login - incluye los archivos de la carpeta login
  El login por ajax se encuentra en la vista includes/heder.php
  */

	$this->load->view('includes/head');
	$this->load->view('includes/header');
	$this->load->view($vista);
	$this->load->view('includes/footer');
 ?>