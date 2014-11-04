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
$route['busqueda_servicio']						= "sitio/busqueda_servicio";

$route['busqueda_localidades']   				= "sitio/busqueda_localidades";
$route['busqueda'] 								= "sitio/busqueda";
$route['resultado-de-busqueda/(:any)']			= "sitio/resultado_busqueda";
$route['ficha-del-servicio']   					= "sitio/ficha_servicio";

$route['login']     	       					= "login/index";
$route['recuperar-clave']      					= "login/recuperar_clave";
$route['validar-login']        					= "login/validacion_login";
$route['registrarse']          					= "login/registrar_usuario";


$route['mi-perfil']   		   					= "usuario/index";
$route['mi-perfil/editar-datos']   				= "usuario/editar_datos";
$route['mi-perfil/editar-servicios']  			= "usuario/editar_servicios";
$route['mi-perfil/favoritos']  					= "usuario/favoritos";
$route['mi-perfil/servicios-solicitados']  		= "usuario/servicios_solicitados";
$route['mis-comentarios']           			= "usuario/mis_comentarios";



$route['404_override'] 	= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */