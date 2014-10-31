<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Servix_model extends CI_Model{


	public function __construct(){
		parent::__construct();

	}

	public function get_datos(){
		$query = "SELECT * FROM servicios";
		$rs    = $this->db->query($query);
		return $rs->result_array();

	}

}