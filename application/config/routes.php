<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user_pagina_inicial_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin']                                                 = 'admin_controller';
$route['admin/log_out']                                         = 'admin_controller/log_out';


$route['admin/personales']                                      = 'admin_catalogo_controller/personales';
$route['admin/graduacion']                                      = 'admin_catalogo_controller/graduacion';
$route['admin/personales/categoria/add']                        = 'admin_catalogo_controller/agregar_categoria';
$route['admin/personales/categoria/mod']                        = 'admin_catalogo_controller/modificar_categoria';
$route['admin/personales/categoria/del']                        = 'admin_catalogo_controller/eliminar_categoria';
$route['admin/personales/productos/add']                        = 'admin_catalogo_controller/agregar_producto';
$route['admin/personales/productos/mod']                        = 'admin_catalogo_controller/modificar_producto';
$route['admin/personales/productos/del']                        = 'admin_catalogo_controller/eliminar_producto';
$route['admin/personales/productos/save_file']                  = 'admin_catalogo_controller/guardar_imagen';


$route['admin/asignar_personas']                                = 'admin_asignacion_controller';
$route['admin/asignar_personas/autocomplete']                   = 'admin_asignacion_controller/obtener_usuarios_sin_graduacion';
$route['admin/asignar_personas/asignar_graduacion']             = 'admin_asignacion_controller/asignar_graduacion_a_persona';
$route['admin/asignar_personas/desasignar_graduacion']          = 'admin_asignacion_controller/desasignar_graduacion_a_persona';
$route['admin/asignar_personas/asignar_representante']          = 'admin_asignacion_controller/asignar_representante';
$route['admin/asignar_personas/obtener_personas_graduacion']    = 'admin_asignacion_controller/obtener_personas_por_graduacion';


$route['admin/gestionar_graduacion']                            = 'admin_gestion_graduacion_controller';
$route['admin/gestionar_graduacion/add']                        = 'admin_gestion_graduacion_controller/agregar_graduacion';
$route['admin/gestionar_graduacion/mod']                        = 'admin_gestion_graduacion_controller/modificar_graduacion';
$route['admin/gestionar_graduacion/alta']                       = 'admin_gestion_graduacion_controller/alta_graduacion';
$route['admin/gestionar_graduacion/save_file']                  = 'admin_gestion_graduacion_controller/guardar_imagen';
$route['admin/gestionar_graduacion/obtener_graduacion']         = 'admin_gestion_graduacion_controller/obtener_graduacion';


$route['admin/gestionar_lugares']                               = 'admin_gestion_lugares_controller';
$route['admin/gestionar_lugares/autocomplete']                  = 'admin_gestion_lugares_controller/obtener_usuarios_ligados_a_graduacion';
$route['admin/gestionar_lugares/obtener_layout']                = 'admin_gestion_lugares_controller/obtener_layout';
$route['admin/gestionar_lugares/borrar_reserva']                = 'admin_gestion_lugares_controller/borrar_reserva';
$route['admin/gestionar_lugares/reservar_lugares']              = 'admin_gestion_lugares_controller/reservar_lugares';  
$route['admin/gestionar_lugares/actualizar_lugares']            = 'admin_gestion_lugares_controller/actualizar_lugares';        
$route['admin/gestionar_lugares/checar_disponibilidad']         = 'admin_gestion_lugares_controller/checar_disponibilidad';
$route['admin/gestionar_lugares/obtener_lugares_graduacion']    = 'admin_gestion_lugares_controller/obtener_lugares_por_graduacion';

$route['admin/gestionar_pagos']                                 = 'admin_gestion_pagos_controller';
$route['admin/gestionar_pagos/autocomplete']                    = 'admin_gestion_pagos_controller/obtener_usuarios_ligados_a_graduacion';
$route['admin/gestionar_pagos/agregar_pago']                    = 'admin_gestion_pagos_controller/agregar_pago';
$route['admin/gestionar_pagos/validar_pago']                    = 'admin_gestion_pagos_controller/validar_pago';
$route['admin/gestionar_pagos/cancelar_pago']                   = 'admin_gestion_pagos_controller/cancelar_pago';
$route['admin/gestionar_pagos/obtener_saldos_graduacion']       = 'admin_gestion_pagos_controller/obtener_saldos_por_graduacion';
$route['admin/gestionar_pagos/obtener_pendientes_grduacion']    = 'admin_gestion_pagos_controller/obtener_cargos_pendientes_de_revision';

$route['admin/gestionar_pedidos']                               = 'admin_gestion_pedidos_controller';
$route['admin/gestionar_pedidos/obtener_pedidos_personas']      = 'admin_gestion_pedidos_controller/obtener_pedidos_de_personas';
$route['admin/gestionar_pedidos/obtener_pedidos_graduacion']    = 'admin_gestion_pedidos_controller/obtener_pedidos_de_graduacion';

$route['admin/cupones']                                         = 'admin_cupones_controller';
$route['admin/cupones/obtener_cupones']                         = 'admin_cupones_controller/obtener_cupones';
$route['admin/cupones/anadir_cupones']                          = 'admin_cupones_controller/añadir_cupones';
$route['admin/cupones/save_file']                               = 'admin_cupones_controller/guardar_imagen';

$route['admin/(:any)']                                          = 'admin_controller';


$route['user_authentication'] = 'user_authentication';
$route['user/agregaraCarro'] = 'user_controller/agregaraCarro';

$route['user/log_in']                                           = 'user_pagina_inicial_controller/log_in';
$route['user/log_in/email']                                     = 'user_pagina_inicial_controller/log_in_email';
$route['user/log_out']                                          = 'user_pagina_inicial_controller/log_out';
$route['user/registrarse']                                      = 'user_pagina_inicial_controller/registrar';

$route['user/paquetes_personales']                              = 'user_paquetes_personales_controller';
$route['user/paquetes_personales/agregar_a_carrito']            = 'user_paquetes_personales_controller/agregar_a_carro';

$route['user/mi_graduacion']                                    = 'user_mi_graduacion_controller';
$route['user/mi_graduacion/asignar_producto_graduacion']        = 'user_mi_graduacion_controller/asginar_producto_a_graduacion';
$route['user/download']                                         = 'user_mi_graduacion_controller/descargar_cupones';

$route['user/carrito_compras']                                  = 'user_carrito_compras_controller';
$route['user/carrito_compras/comprar']                          = 'user_carrito_compras_controller/comprar';
$route['user/carrito_compras/remover_producto']                 = 'user_carrito_compras_controller/remover_producto';

$route['user/saldo']                                            = 'user_saldo_controller';
$route['user/saldo/save_file']                                  = 'user_saldo_controller/guardar_imagen';
$route['user/saldo/add_pago']                                   = 'user_saldo_controller/agregar_pago';

$route['contact_us']                                            = 'user_pagina_inicial_controller/send_mail';