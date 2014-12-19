<?php date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL,"es_ES");

function print_d($dato)
{
	echo "<pre>";
	print_r($dato);
	echo "</pre>";
}

function fechaEs($date)
{
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	return $dias[date('w',$date)]." ".date('d',$date)." de ".$meses[date('n',$date)-1]. " del ".date('Y',$date) ;
}

function fechaBarras($date)
{
	return date('d', $date)."/".date('m', $date)."/".date('Y', $date);
}

function normaliza($cadena) 
{ 
	//strtolower no anda bien
	//http://php.net/manual/es/function.mb-strtolower.php
	$login = mb_strtolower($cadena); 
	$b     = array("","","","","","ä","ë","ï","ö","ü","à","è","ì","ò","ù",""," ",",",".",";",":","¡","!","¿","?",'"'); 
	$c     = array("","","","","","a","e","i","o","u","a","e","i","o","u","","-","","","","","","","","",''); 
	$login = str_replace($b,$c,$login); 
	return $login; 
}  

function recortar_texto($texto, $limite=100)
{
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

function generarLinkServicio($id, $titulo, $sec='ficha')
{
	if (is_numeric($id))
	{
		$tituloServicio = normaliza($titulo);
		$ulrServicio = $sec."/". $id . "-" . $tituloServicio;
		return $ulrServicio;
	}
}

function date_siH_mYd()
{
	$fecha = date('siH_mYd');
	return $fecha;
}


//Ejemplo $path = 'assets/js/', $archivo = 'archivo.jpg'
function path_archivos($path, $archivo)
{
	$path_archivo = $path . $archivo;
	return $path_archivo;
}

function agregar_nombre_archivo($archivo, $agregado)
{
	$nuevo_nombre = "imposibleencontrararchivo.jpg";
	if(!$archivo == ''){
		$ext = explode('.',$archivo);
        if(count($ext)>1)
        {
		  $extension = $ext[1];
		  @$nuevo_nombre = $ext[0] . $agregado . '.' . $extension;
        }
	}
	return $nuevo_nombre;
}

function gmapScript()
{
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
        
        document.getElementById("id");
        var $latitud =  place.geometry.location.lat();
        $latitud = $latitud.toString().slice(0,12);
        document.getElementById("lati").value = $latitud;

        var $longitud = place.geometry.location.lng();
        $longitud = $longitud.toString().slice(0, 12);
        document.getElementById("long").value = $longitud;

        iw_map.setContent("<div><strong>" + place.name + "</strong><br>" + address);
        iw_map.open(map, marker);';
        return $scripts;
}

function existe_archivo($fileUrl)
{
	$AgetHeaders = @get_headers($fileUrl);
	if (preg_match("|200|", $AgetHeaders[0]))
	{
		return TRUE;
	}
	else
	{
	return FALSE;
	}
}

function generarThumbnail($file, $size, $thumbNombre)
{
    $config['image_library']    = 'gd2';
    $config['source_image']     = $file['full_path'];
    $config['create_thumb']     = TRUE;
    $config['maintain_ratio']   = FALSE;
    $config['thumb_marker']     = $thumbNombre;
   
    $_width = $file['image_width'];
    $_height = $file['image_height'];

    $img_type = '';
    $thumb_size = $size;

    if ($_width > $_height)
    {
        // wide image
        $config['width'] = intval(($_width / $_height) * $thumb_size);
        if ($config['width'] % 2 != 0)
        {
            $config['width']++;
        }
        $config['height'] = $thumb_size;
        $img_type = 'wide';
    }
    else if ($_width < $_height)
    {
        // landscape image
        $config['width'] = $thumb_size;
        $config['height'] = intval(($_height / $_width) * $thumb_size);
        if ($config['height'] % 2 != 0)
        {
            $config['height']++;
        }
        $img_type = 'landscape';
    }
    else
    {
        // square image
        $config['width'] = $thumb_size;
        $config['height'] = $thumb_size;
        $img_type = 'square';
    }
    return $config;
}

function generarThumbnailCuadrado($file, $size, $img_path, $thumbNombre)
{
    $img_thumb = $img_path;

    $_width = $file['image_width'];
    $_height = $file['image_height'];

    $img_type = '';
    $thumb_size = $size;

    if ($_width > $_height)
    {
        // wide image
        $config['width'] = intval(($_width / $_height) * $thumb_size);
        if ($config['width'] % 2 != 0)
        {
            $config['width']++;
        }
        $config['height'] = $thumb_size;
        $img_type = 'wide';
    }
    else if ($_width < $_height)
    {
        // landscape image
        $config['width'] = $thumb_size;
        $config['height'] = intval(($_height / $_width) * $thumb_size);
        if ($config['height'] % 2 != 0)
        {
            $config['height']++;
        }
        $img_type = 'landscape';
    }
    else
    {
        // square image
        $config['width'] = $thumb_size;
        $config['height'] = $thumb_size;
        $img_type = 'square';
    }

    // reconfiguramos para cortar el thumbnail
    $conf_new = array(
        'image_library' => 'gd2',
        'source_image' => $img_thumb,
        'create_thumb' => FALSE,
        'maintain_ratio' => FALSE,
        'width' => $thumb_size,
        'height' => $thumb_size
    );

    if ($img_type == 'wide')
    {
        $conf_new['x_axis'] = ($config['width'] - $thumb_size) / 2 ;
        $conf_new['y_axis'] = 0;
    }
    else if($img_type == 'landscape')
    {
        $conf_new['x_axis'] = 0;
        $conf_new['y_axis'] = ($config['height'] - $thumb_size) / 2;
    }
    else
    {
        $conf_new['x_axis'] = 0;
        $conf_new['y_axis'] = 0;
    }

    return $conf_new;
}
?>