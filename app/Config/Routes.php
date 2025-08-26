<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::inicio');
$routes->post('/login', 'Home::login');
$routes->get('/salir', 'Home::salir');

// Rutas para administrador
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('usuarios', 'AdminController::usuarios');
    $routes->post('crear-usuario', 'AdminController::crearUsuario');
    $routes->get('eliminar-usuario/(:num)', 'AdminController::eliminarUsuario/$1');
});

// Rutas para recepcionista
$routes->group('recepcion', ['filter' => 'auth:recepcionista'], function($routes) {
    $routes->get('inicio', 'RecepcionController::index');
    $routes->get('registrar-paciente', 'RecepcionController::registrarPaciente');
    $routes->get('agendar-cita', 'RecepcionController::agendarCita');
    $routes->get('ver-citas', 'RecepcionController::verCitas');
});

// Rutas para técnico
$routes->group('tecnico', ['filter' => 'auth:tecnico'], function($routes) {
    $routes->get('panel', 'TecnicoController::index');
    $routes->get('ver-pacientes', 'TecnicoController::verPacientes');
    $routes->get('registrar-tratamiento', 'TecnicoController::registrarTratamiento');
    $routes->get('historial-paciente/(:num)', 'TecnicoController::historialPaciente/$1');
    $routes->get('equipos', 'TecnicoController::equipos');
});

