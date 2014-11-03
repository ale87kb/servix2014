<?php 

	function print_d($dato){

	echo "<pre>";
	print_r($dato);
	echo "</pre>";


	};

	
	function normaliza($cadena) 
	{ 
		$login = strtolower($cadena); 
		$b     = array("á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ"," ",",",".",";",":","¡","!","¿","?",'"'); 
		$c     = array("a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","-","","","","","","","","",''); 
		$login = str_replace($b,$c,$login); 
		return $login; 
	}  

?>