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

$route['default_controller'] 								= "sitio";
//url                        // Controlador/metodo 

$route['login/verificacion-login-fb'] 						= "login/verificar_login_fb";					//Entra cualquiera
$route['condiciones-de-uso']   								= "sitio/condiciones_de_uso";					//Entra cualquiera
$route['politica-de-uso-de-datos']   						= "sitio/politica_de_datos";					//Entra cualquiera
$route['politica-de-cookies']		   						= "sitio/politica_de_cookies";					//Entra cualquiera
$route['preguntas-frecuentes'] 								= "sitio/preguntas_frecuentes";					//Entra cualquiera
$route['solicitud-de-servicio']								= "sitio/solicitar_servicio";					
$route['consultar-servicio']   								= "sitio/consultar_servicio";			
$route['ofrecer-servicio']     								= "sitio/ofrecer_servicio";
$route['categorias']           								= "sitio/categorias";
$route['checkLogin']           								= "sitio/check_login";
$route['mail']           									= "sitio/mail";
$route['servicios-solicitados/(:num)']         				= "sitio/index";
$route['servicios-solicitados']           					= "sitio/index";
$route['servicio-solicitado/(:any)']	        			= "sitio/servicio_solicitado/$1";
$route['set_postulacion']	        						= "sitio/set_postulacion";
$route['unset_postulacion']	        						= "sitio/unset_postulacion";
$route['solicitar-servicio']	        					= "sitio/solicitar_servicio";
$route['validar-solicitud-servicio']	        			= "sitio/validar_solicitud_servicio";
$route['validar-ofrecer-servicio']	        				= "sitio/validar_ofrecer_servicio";
$route['validar-editar-servicio']	        				= "sitio/validar_ofrecer_servicio";
$route['ofrecer-servicio/msj/(registro_ok|registro_e)']  	= "sitio/off_serv_mensaje/$1";
$route['file_upload_image']	        						= "sitio/file_upload_image";

$route['busqueda_servicio']									= "sitio/busqueda_servicio";
$route['busqueda_categoria']								= "sitio/busqueda_categoria";
$route['enviar/comentario-servicio']						= "sitio/comentar_servicio";
$route['busqueda_localidades_buscador'] 					= "sitio/busqueda_localidades_buscador";
$route['busqueda_localidades']   							= "sitio/busqueda_localidades";
$route['busqueda'] 											= "sitio/busqueda";
$route['resultado-de-busqueda/(:any)-en-(:any)']  	 	  	= "sitio/resultado_busqueda/$1/$2";
$route['resultado-de-busqueda/(:any)-en-(:any)/(:num)']   	= "sitio/resultado_busqueda/$1/$2/$3";


$route['ficha/(:any)/opniones/page']						= "sitio/get_opiniones/$1/$2";
$route['ficha/(:any)/opniones/page/(:num)']					= "sitio/get_opiniones/$1/$2";


$route['ficha/(:num)-(:any)']   	    		   			= "sitio/ficha_servicio/$1/$2";					//Entra cualquiera
$route['ficha/(:num)-(:any)/opniones/page/(:num)']			= "sitio/ficha_servicio/$1/$2/$3";					//Entra cualquiera

$route['validar-recomendacion']   	       		 			= "sitio/recomendar_servicio";


/*--- LOGIN/LOGOUT/REGISTRO --------------------*/
$route['logout']		   									= "login/logout";								//Usuario logueado
$route['login']     	       								= "login/index";								//Usuario deslogueado
$route['validar_login']        								= "login/validacion_login";
$route['validar_login_ajax']        						= "login/validacion_login_ajax";

$route['recuperar-clave']      								= "login/recuperar_clave";						//Usuario deslogueado
$route['validar_recuperar_clave']      						= "login/validar_recuperar_clave";				//Usuario deslogueado

$route['registrarse']          								= "login/registrar_usuario";					//Usuario deslogueado
$route['validar_nuevo_usuario']          					= "login/validar_nuevo_usuario";
$route['validar_nuevo_usuario_ajax']          				= "login/validar_nuevo_usuario_ajax";
$route['registro_respuesta']		          				= "login/registro_respuesta";
$route['usuario/verificar/(:any)']           				= "usuario/verificar";							//Usuario deslogueado
/*----------------------------------------------*/

/*--- USUARIO ----------------------------------*/
$route['menu_usuario']								= "login/menu_usuario";

$route['mi-perfil']   		   						= "usuario/index";								//Mi-Perfil Usuario logueado
$route['mi-perfil/servicios']   		   			= "usuario/servicios_usuario";
$route['mi-perfil/servicios/(:num)']	   			= "usuario/servicios_usuario";
$route['mi-perfil/favoritos']  						= "usuario/favoritos_usuario";
$route['mi-perfil/favoritos/(:num)']  				= "usuario/favoritos_usuario";
$route['mi-perfil/mis-opiniones']    				= "usuario/mis_opiniones";
$route['mi-perfil/mis-opiniones/(:num)']    		= "usuario/mis_opiniones";
$route['mi-perfil/servicios-contactados']  			= "usuario/servicios_contactados_usuario";
$route['mi-perfil/servicios-contactados/(:num)']  	= "usuario/servicios_contactados_usuario";
$route['mi-perfil/servicios-solicitados']  			= "usuario/servicios_solicitados_usuario";
$route['mi-perfil/servicios-solicitados/(:num)']	= "usuario/servicios_solicitados_usuario";
$route['mi-perfil/postulaciones']		  			= "usuario/postulaciones_usuario";
$route['mi-perfil/postulaciones/(:num)']  			= "usuario/postulaciones_usuario";

$route['mi-perfil/servicios/editar/(:num)-(:any)']  = "sitio/editar_servicio/$1";

$route['mi-perfil/servicios-solicitados/editar/(:num)']	= "sitio/editar_servicio_solicitado/$1";
$route['validar-editar-solicitud-servicio']  			= "sitio/validar_editar_servicio_solicitado";

$route['validar-voto']   		   					= "usuario/validar_voto";
$route['mi-perfil/editar-datos']   					= "usuario/editar_datos";
$route['mi-perfil/validar_editar_datos']   			= "login/validar_editar_datos";
$route['editar_usuario_respuesta']					= "login/editar_usuario_respuesta";
$route['actulaizar_foto_perfil']					= "usuario/actulaizar_foto_perfil";
$route['set_favorito']  							= "usuario/set_favorito";
$route['elimiar-servicio']  						= "sitio/unset_servicio";
$route['eliminar-servicio-solicitado']  			= "sitio/unset_servicio_solicitado";
$route['reactivar-servicio-solicitado']  			= "sitio/update_servicio_solicitado";

$route['usuario/perfil/(:any)'] 					= "usuario/perfil_usuario/$1";
$route['usuario/perfil/(:any)/(:num)'] 					= "usuario/perfil_usuario/$1/$2";

$route['404_override'] 	= 'sitio/error_404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */