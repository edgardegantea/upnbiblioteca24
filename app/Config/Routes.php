<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


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


$routes->group('admin', ['filter' => ['auth', 'role:admin'], 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');
    // $routes->resource('usuarios', ['controller' => 'UserController']);
    $routes->resource('archivos', ['controller' => 'ArchivoController']);
    $routes->resource('editoriales', ['controller' => 'Editoriales']);
    $routes->resource('autores', ['controller' => 'Autores']);
    $routes->resource('generos', ['controller' => 'Generos']);

    $routes->resource('publicaciones', ['controller' => 'PublicacionesController']);
    $routes->get('/descarga/(:num)', 'ArchivoController::descargar/$1');
    $routes->get('archivos/visualizar/(:num)', 'ArchivoController::visualizar/$1');


    $routes->get('recursos/step1', 'Recursos::step1_autores');
    $routes->post('recursos/step1', 'Recursos::processStep1');
    $routes->get('recursos/step2', 'Recursos::step2_categoria');
    $routes->post('recursos/step2', 'Recursos::processStep2');
    $routes->get('recursos/step3', 'Recursos::step3_tag');
    $routes->post('recursos/step3', 'Recursos::processStep3');
    $routes->get('recursos/step4', 'Recursos::step4_editorial');
    $routes->post('recursos/step4', 'Recursos::processStep4');
    $routes->get('recursos/step5', 'Recursos::step5_recurso');
    $routes->post('recursos/step5', 'Recursos::store');

    $routes->resource('recursos', ['controller' => 'Recursos']);

    $routes->group('carousel', function ($routes) {
        $routes->get('/', 'CarouselController::index');
        $routes->get('create', 'CarouselController::create');
        $routes->post('store', 'CarouselController::store');
        $routes->get('edit/(:num)', 'CarouselController::edit/$1');
        $routes->put('update/(:num)', 'CarouselController::update/$1');
        $routes->get('delete/(:num)', 'CarouselController::delete/$1');
    });


    $routes->group('usuarios', function ($routes) {
        $routes->get('/', 'UserController::index');                      // Listar todos los usuarios
        $routes->get('create', 'UserController::create');                // Mostrar formulario de creación de usuario
        $routes->post('store', 'UserController::store');                 // Guardar un nuevo usuario
        $routes->get('show/(:num)', 'UserController::show/$1');          // Mostrar detalles de un usuario específico
        $routes->get('edit/(:num)', 'UserController::edit/$1');


        // Mostrar formulario de edición de usuario
        $routes->post('update/(:num)', 'UserController::update/$1');
        // $routes->post('/', 'UserController::update/$1');     // Actualizar un usuario existente (utilizando POST y _method='PUT')
        $routes->delete('delete/(:num)', 'UserController::delete/$1');   // Eliminar un usuario
    });




});


$routes->group('docente', ['filter' => ['auth', 'role:docente']], function ($routes) {
    $routes->get('/', 'Docente\DocenteController::index');
    $routes->get('x', 'Docente\DocenteController::x');
});


$routes->group('estudiante', ['filter' => ['auth', 'role:usuario'], 'namespace' => 'App\Controllers\Estudiante'], function ($routes) {
    $routes->get('/', 'UsuarioController::index');
});
