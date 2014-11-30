<?php 
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	setlocale(LC_ALL,"es_ES");
	function print_d($dato){
		echo "<pre>";
		print_r($dato);
		echo "</pre>";
	};

	function fechaEs($date){

		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
		return $dias[date('w',$date)]." ".date('d',$date)." de ".$meses[date('n',$date)-1]. " del ".date('Y',$date) ;
	}

	function fechaBarras($date){
		return date('d', $date)."/".date('m', $date)."/".date('Y', $date);
	}


	function normaliza($cadena) 
	{ 
		$login = strtolower($cadena); 
		$b     = array("á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ"," ",",",".",";",":","¡","!","¿","?",'"'); 
		$c     = array("a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","-","","","","","","","","",''); 
		$login = str_replace($b,$c,$login); 
		return $login; 
	}  
	
	function recortar_texto($texto, $limite=100){
    	$texto = trim($texto);
    	$texto = strip_tags($texto);
    	$tamano = strlen($texto);
    	$resultado = '';
	    if($tamano <= $limite)
	    {
	        return $texto;
	    }
	    else
	    {
	        $texto = substr($texto, 0, $limite);
	        $palabras = explode(' ', $texto);
	        $resultado = implode(' ', $palabras);
	        $resultado .= '...';
	    }   
    	return $resultado;
	}



	function generarLinkServicio($id, $titulo,$sec='ficha'){

		if (is_numeric($id))
		{
			$tituloServicio = normaliza($titulo);
			$ulrServicio = $sec."/". $id . "-" . $tituloServicio;
			return $ulrServicio;
		}

	}

	function date_siH_mYd(){
		$fecha = date('siH_mYd');
		return $fecha;
	}

	
	//Ejemplo $path = 'assets/js/', $archivo = 'archivo.jpg'
	function path_archivos($path, $archivo){
		$path_archivo = $path . $archivo;
		return $path_archivo;
	}

	function agregar_nombre_archivo($archivo, $agregado){
		$nuevo_nombre = "";
		if(!$archivo == ''){
			$ext = explode('.',$archivo);
			$extension = $ext[1];
			$nuevo_nombre = $ext[0] . $agregado . '.' . $extension;
		}
		return $nuevo_nombre;
	}

	function existe_archivo($fileUrl){
		$AgetHeaders = @get_headers($fileUrl);
		if (preg_match("|200|", $AgetHeaders[0])) {
			return TRUE;
		} else {
		return FALSE;
		}
	}
?>