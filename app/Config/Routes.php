<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



// Rutas para Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('/usuarios', 'AdminController::usuarios');
    $routes->get('/reportes', 'AdminController::reportes');
});

// Rutas para Docente
$routes->group('docente', ['namespace' => 'App\Controllers\Docente', 'filter' => 'role:docente'], function($routes) {
    $routes->get('/', 'DocenteController::index');
    $routes->get('/clases', 'DocenteController::clases');
});

// Rutas para Estudiante
$routes->group('estudiante', ['namespace' => 'App\Controllers\Estudiante', 'filter' => 'role:estudiante'], function($routes) {
    $routes->get('/', 'EstudianteController::index');
    $routes->get('/notas', 'EstudianteController::notas');
});

// Rutas adicionales

$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/reset-password', 'PasswordController::requestReset');
$routes->post('/reset-password', 'PasswordController::sendResetLink');
$routes->get('/reset-password/(:any)', 'PasswordController::resetPassword/$1');
$routes->post('/reset-password/update', 'PasswordController::updatePassword');
$routes->get('/errors/access_denied', 'ErrorsController::accessDenied');

$routes->get('/complete-profile', 'ProfileController::completeProfile');
$routes->post('/update-profile', 'ProfileController::updateProfile');



/*
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::login', ['filter' => 'noauth']);
    $routes->post('login', 'AuthController::loginProcess');
    $routes->get('logout', 'AuthController::logout');

    $routes->get('forgot-password', 'Auth::forgotPassword', ['filter' => 'noauth']);
    $routes->post('forgot-password', 'Auth::processForgotPassword');
    $routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1', ['filter' => 'noauth']);
    $routes->post('reset-password', 'Auth::processResetPassword');
});

$routes->group('profile', ['filter' => 'auth'], function($routes) {
    $routes->get('update', 'ProfileController::update');
    $routes->post('update', 'ProfileController::update');
});


$routes->get('reglamento', 'Home::reglamento');
$routes->get('servicios', 'Home::servicios');
$routes->get('acercade', 'Home::acercade');


$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin\AdminController::index');


    $routes->resource('users', ['controller' => 'UserController']);
    $routes->resource('editoriales', ['controller' => 'Editoriales']);
    $routes->resource('autores', ['controller' => 'Autores']);
    $routes->resource('generos', ['controller' => 'Generos']);
    $routes->resource('recursos', ['controller' => 'Recursos']);
    $routes->resource('publicaciones', ['controller' => 'Publicaciones']);


    $routes->get('carousel', 'CarouselController::index');
    $routes->get('carousel/create', 'CarouselController::create');
    $routes->post('carousel/store', 'CarouselController::store');
    $routes->get('carousel/edit/(:num)', 'CarouselController::edit/$1');
    $routes->put('carousel/update/(:num)', 'CarouselController::update/$1');
    $routes->get('carousel/delete/(:num)', 'CarouselController::delete/$1');


    $routes->get('/descarga/(:num)', 'ArchivoController::descargar/$1');
    $routes->get('archivos/visualizar/(:num)', 'ArchivoController::visualizar/$1');

    $routes->get('archivos', 'ArchivoController::index');
    $routes->get('archivos/create', 'ArchivoController::create');
    $routes->post('archivos/store', 'ArchivoController::store');
    $routes->get('archivos/edit/(:num)', 'ArchivoController::edit/$1');
    $routes->post('archivos/update/(:num)', 'ArchivoController::update/$1');
    $routes->get('archivos/delete/(:num)', 'ArchivoController::delete/$1');


    $routes->get('clasificaciones', 'ClasificacionController::index');
    $routes->get('clasificaciones/create', 'ClasificacionController::create');
    $routes->post('clasificaciones/store', 'ClasificacionController::store');
    $routes->get('clasificaciones/edit/(:num)', 'ClasificacionController::edit/$1');
    $routes->post('clasificaciones/update/(:num)', 'ClasificacionController::update/$1');
    $routes->get('clasificaciones/delete/(:num)', 'ClasificacionController::delete/$1');
});


$routes->group('usuario', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Usuario\UsuarioController::index');
    $routes->get('archivos/visualizar/(:num)', 'ArchivoController::visualizar/$1');
});

$routes->get('/resultados-busqueda', 'ArchivoController::mostrarResultados');
$routes->get('/archivos/visualizar/(:num)', 'ArchivoController::visualizar2/$1');
*/








