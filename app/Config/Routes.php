<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
/*
$routes->get('CargarAmo', 'CargarAmo::index');
$routes->post('form/exito', 'CargarAmo::');
*/

$routes->get('mostrar_amo', 'Amos::index');
$routes->get('cargar_amo', 'Amos::cargar');
$routes->post('guardar', 'Amos::guardar');
$routes->get('borrar/(:num)', 'Amos::borrar/$1'); $routes->get('editar/(:num)', 'Amos::editar/$1');
$routes->post('actualizar', 'Amos::actualizar');

$routes->get('CargarMascota','CargarMascota::index');
$routes->post('form/cargarMascota','CargarMascota::cargarMascota');
$routes->get('VerMascotas','VerMascotas::index');

$routes->get('ModificarMascota/(:num)','ModificarMascota::index/$1');
$routes->post('form/modificarMascota','ModificarMascota::modificar');
$routes->post('form/adoptarMascota', 'VerMascotas::adoparMascota');
$routes->post('form/darBaja', 'VerMascotas::darBajaMascota');
