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
?>