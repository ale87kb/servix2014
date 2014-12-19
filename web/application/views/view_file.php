<?php 
	$t = mb_strtolower($busca['post']['servicio']);
	$q = array('á','é','í','ó','ú','ñ');
	$r = array('a','e','i','o','u','n');
	$s = str_replace($q, $r, $t);
	print_d($s);
 ?>