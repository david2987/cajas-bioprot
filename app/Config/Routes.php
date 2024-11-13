<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/cajas', 'Cajas::index');
$routes->get('/cajas/create', 'Cajas::create');
$routes->post('/cajas/store', 'Cajas::store');
$routes->get('/cajas/edit/(:num)', 'Cajas::edit/$1');
$routes->get('/cajas/view/(:num)', 'Cajas::view/$1');
$routes->post('/cajas/update/(:num)', 'Cajas::update/$1');
$routes->get('/cajas/delete/(:num)', 'Cajas::delete/$1');
$routes->post('/cajas/agregarImagenesCaja','Cajas::agregarImagenesCaja');
$routes->post('/cajas/disponibilizar/(:num)','Cajas::disponibilizar/$1');



$routes->get( '/categorias', 'Categorias::index');
$routes->get( '/categorias/create', 'Categorias::create');
$routes->post( '/categorias/store', 'Categorias::store');
$routes->get( '/categorias/edit/(:num)', 'Categorias::edit/$1');
$routes->post('/categorias/update/(:num)', 'Categorias::update/$1');
$routes->get( '/categorias/delete/(:num)', 'Categorias::delete/$1');


$routes->get('/movimientos', 'Movimientos::index');
$routes->get('/movimientos/create', 'Movimientos::create');
$routes->post('/movimientos/store', 'Movimientos::store');
$routes->get('/movimientos/edit/(:num)', 'Movimientos::edit/$1');
$routes->post('/movimientos/update/(:num)', 'Movimientos::update/$1');
$routes->get('/movimientos/delete/(:num)', 'Movimientos::delete/$1');
$routes->get('/movimientos/show/(:num)', 'Movimientos::show/$1');

$routes->get('/qr/generate/(:num)', 'QrController::generateQr/$1');
$routes->get('/qr/generateqr', 'QrController::runProcessCajas');


$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/authenticate', 'Auth::authenticate');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/create', 'Usuarios::create');
$routes->post('/usuarios/store', 'Usuarios::store');
$routes->get('/usuarios/edit/(:num)', 'Usuarios::edit/$1');
$routes->post('/usuarios/update/(:num)', 'Usuarios::update/$1');
$routes->get('/usuarios/delete/(:num)', 'Usuarios::delete/$1');

$routes->get('/grupos-usuarios', 'GruposUsuarios::index');
$routes->get('/grupos-usuarios/create', 'GruposUsuarios::create');
$routes->post('/grupos-usuarios/store', 'GruposUsuarios::store');
$routes->get('/grupos-usuarios/edit/(:num)', 'GruposUsuarios::edit/$1');
$routes->post('/grupos-usuarios/update/(:num)', 'GruposUsuarios::update/$1');
$routes->get('/grupos-usuarios/delete/(:num)', 'GruposUsuarios::delete/$1');

$routes->get('/permisos', 'Permisos::index');
$routes->get('/permisos/create', 'Permisos::create');
$routes->post('/permisos/store', 'Permisos::store');
$routes->get('/permisos/edit/(:segment)', 'Permisos::edit/$1');
$routes->post('/permisos/update/(:segment)', 'Permisos::update/$1');
$routes->get('/permisos/delete/(:segment)', 'Permisos::delete/$1');

$routes->group('permisos', ['filter' => 'permission:permisos_permiso'], function($routes) {
    $routes->get('', 'Permisos::index');
    $routes->get('create', 'Permisos::create');
    $routes->post('store', 'Permisos::store');
    $routes->get('edit/(:segment)', 'Permisos::edit/$1');
    $routes->post('update/(:segment)', 'Permisos::update/$1');
    $routes->get('delete/(:segment)', 'Permisos::delete/$1');
});


$routes->get('/movimientos/create/(:segment)/(:segment)', 'Movimientos::create/$1/$2');
$routes->post('/movimientos/store', 'Movimientos::store');
$routes->group('movimientos', ['filter' => 'permission:movimientos_permiso'], function($routes) {
    $routes->get('create/(:segment)', 'Movimientos::create/$1');
    $routes->post('store', 'Movimientos::store');
});
$routes->get('/movimientos', 'Movimientos::index');
$routes->get('/movimientos/create/(:segment)', 'Movimientos::create/$1');
$routes->post('/movimientos/store', 'Movimientos::store');
$routes->group('movimientos', ['filter' => 'permission:movimientos_permiso'], function($routes) {
    $routes->get('', 'Movimientos::index');
    $routes->get('create/(:segment)', 'Movimientos::create/$1');
    $routes->post('store', 'Movimientos::store');
});
$routes->get('/movimientos/show/(:num)', 'Movimientos::show/$1');


$routes->get('/gallery', 'Gallery::index');
$routes->get('/gallery/upload', 'Gallery::upload');
$routes->post('/gallery/upload', 'Gallery::upload');
$routes->get('/gallery/getImagesCaja/(:num)' , 'Gallery::getImagesCaja/$1');