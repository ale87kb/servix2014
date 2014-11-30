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

$route['condiciones-de-uso']   					= "sitio/condiciones_de_uso";					//Entra cualquiera
$route['preguntas_frecuentes'] 					= "sitio/preguntas_frecuentes";					//Entra cualquiera
$route['solicitud-de-servicio']					= "sitio/solicitar_servicio";					
$route['consultar-servicio']   					= "sitio/consultar_servicio";			
$route['ofrecer-servicio']     					= "sitio/ofrecer_servicio";
$route['categorias']           					= "sitio/categorias";
$route['checkLogin']           					= "sitio/check_login";
$route['mail']           						= "sitio/mail";
$route['servicios-solicitados/(:num)']         	= "sitio/index";
$route['servicios-solicitados']           		= "sitio/index";
$route['servicio-solicitado/(:any)']	        = "sitio/servicio_solicitado/$1";
$route['set_postulacion']	        			= "sitio/set_postulacion";
$route['unset_postulacion']	        			= "sitio/unset_postulacion";
$route['solicitar-servicio']	        		= "sitio/solicitar_servicio";
$route['validar-solicitud-servicio']	        = "sitio/validar_solicitud_servicio";

$route['busqueda_servicio']						= "sitio/busqueda_servicio";
$route['busqueda_categoria']					= "sitio/busqueda_categoria";
$route['enviar/comentario-servicio']			= "sitio/comentar_servicio";
$route['busqueda_localidades_buscador'] 		= "sitio/busqueda_localidades_buscador";
$route['busqueda_localidades']   				= "sitio/busqueda_localidades";
$route['busqueda'] 								= "sitio/busqueda";
$route['resultado-de-busqueda/(:any)']			= "sitio/resultado_busqueda";


$route['ficha/(:any)/opniones/page']			= "sitio/get_opiniones/$1/$2";
$route['ficha/(:any)/opniones/page/(:num)']		= "sitio/get_opiniones/$1/$2";

$route['ficha/(:any)']		    				= "sitio/ficha_servicio/$1";
$route['validar-recomendacion']   	        	= "sitio/recomendar_servicio";


/*--- LOGIN/LOGOUT/REGISTRO --------------------*/
$route['logout']		   						= "login/logout";								//Usuario logueado
$route['login']     	       					= "login/index";								//Usuario deslogueado
$route['validar_login']        					= "login/validacion_login";
$route['validar_login_ajax']        			= "login/validacion_login_ajax";

$route['recuperar-clave']      					= "login/recuperar_clave";						//Usuario deslogueado
$route['validar_recuperar_clave']      			= "login/validar_recuperar_clave";				//Usuario deslogueado

$route['registrarse']          					= "login/registrar_usuario";					//Usuario deslogueado
$route['validar_nuevo_usuario']          		= "login/validar_nuevo_usuario";
$route['validar_nuevo_usuario_ajax']          	= "login/validar_nuevo_usuario_ajax";
$route['registro_respuesta']		          	= "login/registro_respuesta";
$route['usuario/verificar/(:any)']           	= "usuario/verificar";							//Usuario deslogueado
/*----------------------------------------------*/

/*--- USUARIO ----------------------------------*/
$route['menu_usuario']							= "login/menu_usuario";

$route['mi-perfil']   		   					= "usuario/index";								//Usuario logueado
$route['validar-voto']   		   				= "usuario/validar_voto";
$route['mi-perfil/editar-datos']   				= "usuario/editar_datos";
$route['mi-perfil/validar_editar_datos']   		= "login/validar_editar_datos";
$route['editar_usuario_respuesta']				= "login/editar_usuario_respuesta";
$route['actulaizar_foto_perfil']				= "usuario/actulaizar_foto_perfil";

$route['mi-perfil/editar-servicios']  			= "usuario/editar_servicios";
$route['mi-perfil/favoritos']  					= "usuario/favoritos";
$route['set_favorito']  						= "usuario/set_favorito";
$route['mi-perfil/servicios-solicitados']  		= "usuario/servicios_solicitados";
$route['mis-comentarios']           			= "usuario/mis_comentarios";

$route['usuario/perfil/(:any)'] 				= "usuario/perfil_usuario/$1";


$route['404_override'] 	= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */