<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 					= "sitio";
//url                        // Controlador/metodo 

$route['condiciones-de-uso']   					= "sitio/condiciones_de_uso";
$route['preguntas_frecuentes'] 					= "sitio/preguntas_frecuentes";
$route['solicitud-de-servicio']					= "sitio/solicitar_servicio";
$route['consultar-servicio']   					= "sitio/consultar_servicio";
$route['ofrecer-servicio']     					= "sitio/ofrecer_servicio";
$route['categorias']           					= "sitio/categorias";
$route['checkLogin']           					= "sitio/check_login";
$route['mail']           						= "sitio/mail";

$route['busqueda_servicio']						= "sitio/busqueda_servicio";
$route['enviar/comentario-servicio']			= "sitio/comentar_servicio";
$route['busqueda_localidades']   				= "sitio/busqueda_localidades";
$route['busqueda'] 								= "sitio/busqueda";
$route['resultado-de-busqueda/(:any)']			= "sitio/resultado_busqueda";
$route['ficha/(:any)']		    				= "sitio/ficha_servicio/$1";

$route['logout']		   						= "login/logout";
$route['login']     	       					= "login/index";
$route['validar_login']        					= "login/validacion_login";
$route['validar_login_ajax']        			= "login/validacion_login_ajax";

$route['recuperar-clave']      					= "login/recuperar_clave";
$route['validar_recuperar_clave']      			= "login/validar_recuperar_clave";

$route['registrarse']          					= "login/registrar_usuario";
$route['validar_nuevo_usuario']          		= "login/validar_nuevo_usuario";
$route['usuario/verificar/(:any)']           	= "usuario/verificar";

$route['mi-perfil']   		   					= "usuario/index";
$route['validar-voto']   		   				= "usuario/validar_voto";
$route['mi-perfil/editar-datos']   				= "usuario/editar_datos";
$route['mi-perfil/editar-servicios']  			= "usuario/editar_servicios";
$route['mi-perfil/favoritos']  					= "usuario/favoritos";
$route['mi-perfil/servicios-solicitados']  		= "usuario/servicios_solicitados";
$route['mis-comentarios']           			= "usuario/mis_comentarios";



$route['404_override'] 	= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */