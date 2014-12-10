<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarioClass {
	/* DECLARADAS COMO EN DB */
	public $id 					= null;
	public $email 				= null;
	public $clave 				= null;
	public $nombre 				= null;
	public $apellido 			= null;
	public $telefono 			= null;
	public $direccion 			= null;
	public $foto 				= null;
	public $codigo 				= null;
	public $estado 				= null;
	public $fecha_creacion 		= null;
	public $fecha_mod_estado 	= null;
	public $ultima_edicion 		= null;
	
	/* AGREGADOS - NO ESTAN EN DB */
	public $foto_path 			= null;
	public $link_user 			= null;

	private $_fotoPath		= './assets/images/usuarios/';
	private $_carpetafotos 	= 'assets/images/usuarios/';
	private $_fotoPerfil 	= 'assets/images/perfil'; //EJEMPLO: assets/images/perfil_125.jpg
	private $_ext125 		= '_125';
	private $_ext60 		= '_60';


    public function __construct() {
    }
   
    public function setUsuarios($params){
        foreach ($params as $param)
		{
			$usuario = new usuarioclass();
			foreach ($param as $key => $value)
			{
                if (property_exists('usuarioclass', $key))
                {
                	$usuario->$key 	= $param[$key];
				}
				else
				{
					$usuario->$key 	= $param[$key];
				}
       		}
			
			$lista[] = $usuario;
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
    		$param->link_user = site_url('usuario/perfil/'.$param->id.'-'.$param->nombre.'-'.$param->apellido);
    	}
    }

}

?> 