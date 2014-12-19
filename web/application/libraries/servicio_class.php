
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicio_class  {
	/* DECLARADAS COMO EN DB */
	public $id 					= null;
	public $id_categorias 		= null;
	public $id_loclaidades 		= null;
	public $titulo 				= null;
	public $descripcion 		= null;
	public $foto 				= null;
	public $url_web 			= null;
	public $direccion			= null;
	public $telefono 			= null;
	public $latitud				= null;
	public $longitud 			= null;

	/* AGREGADOS - NO ESTAN EN DB */
	public $link_servicio 	= null;
	public $link_user	 	= null;

	private $_fotoPath		= './assets/images/servicios/';
	private $_carpetafotos 	= 'assets/images/servicios/';
	private $_fotoPerfil 	= 'assets/images/servicio'; //EJEMPLO: assets/images/servicio_125.jpg

    public function __construct() {
    }

	public function setServicios($params){
        foreach ($params as $param)
		{
			$servicio = new servicio_class ();
			foreach ($param as $key => $value)
			{
				$servicio->$key 	= $param[$key];
       		}
			
			$lista[] = $servicio;
			$this->setLinK($lista);
		}
		return $lista;
    }

    public function setFotos($params, $ext){
    	foreach ($params as $param)
    	{
	    	if($param->foto == "" || $param->foto == null)
	    	{
	    		$param->foto_path = site_url($this->_fotoPerfil . $ext . '.jpg');
	    	}
	    	else if (file_exists($this->_fotoPath . agregar_nombre_archivo($param->foto, $ext)))
	    	{
	    		$param->foto_path = site_url(path_archivos($this->_carpetafotos, agregar_nombre_archivo($param->foto, $ext)));
	    	}
	    	else
	    	{
	    		$param->foto_path = site_url($this->_fotoPerfil . $ext . '.jpg');
	    	}
			$lista[] = $param;
    	}
    	return $lista;
    }

    public function setLinK($params){
    	foreach ($params as $param)
    	{
    		$param->link_servicio = site_url(generarLinkServicio($param->id, $param->titulo));
    	}
    }

    public function setEditLink($params){
    	foreach ($params as $param)
    	{
    		$param->link_servicio = site_url(generarLinkServicio($param->id, $param->titulo));
    	}
    }
    public function setLinkUser($params){
    	foreach ($params as $param)
    	{
    		$param->link_user = site_url('usuario/perfil/'. $param->userID . '-' . $param->nombre . '-' . $param->apellido);
			$lista[] = $param;
    	}
    	return $lista;
    }
}
?>