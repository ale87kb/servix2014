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



	function generarLinkServicio($id, $titulo, $sec='ficha'){

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

	function gmapScript(){
		$scripts = 'for (var i = 0; i < markers_map.length; i++ ) {
			markers_map[i].setMap(null);
			}
			markers_map.length = 0;
			
			iw_map.close();
            var markerOptions = {
              map: map,
              anchorPoint: new google.maps.Point(0, -29)
            };
            var marker = createMarker_map(markerOptions);
            marker.setVisible(false);

            var place = placesAutocomplete.getPlace();
            if (!place.geometry) {
              return;
            }

             // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setIcon(/** @type {google.maps.Icon} */({
              url:"'.site_url('assets/images/servix_marker.png').'",
              size: new google.maps.Size(25, 66),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(20, 35)
            }));
           

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
             var address = "";
            if (place.address_components) {
              address = [
                (place.address_components[0] && place.address_components[0].short_name || ""),
                (place.address_components[1] && place.address_components[1].short_name || ""),
                (place.address_components[2] && place.address_components[2].short_name || "")
              ].join(" ");
            }
            console.log(place.address_components);
            

            

            document.getElementById("id")
            var $latitud =  place.geometry.location.k; 
            document.getElementById("lati").value = $latitud;

           
            //$longitud = $logitud.slice(0,10);

            var $longitud = place.geometry.location.B;
			$longitud = $longitud.toString().slice(0, 12);
            document.getElementById("long").value = $longitud;

            iw_map.setContent("<div><strong>" + place.name + "</strong><br>" + address);
            iw_map.open(map, marker);';
            return $scripts;

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