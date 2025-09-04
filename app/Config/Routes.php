<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::inicio');
$routes->post('/login', 'Home::login');
$routes->get('/salir', 'Home::salir');
$routes->get('/usuario-actual', 'Home::obtenerUsuarioActual');

// Rutas para clientes
$routes->resource('clientes', ['controller' => 'ClienteController']);
$routes->get('clientes/buscar-dni/(:any)', 'ClienteController::buscarPorDNI/$1');
$routes->get('clientes/buscar-nombre/(:any)', 'ClienteController::buscarPorNombre/$1');
$routes->put('clientes/(:num)/activar', 'ClienteController::activar/$1');

// Rutas para categorías de equipos
$routes->resource('categorias-equipos', ['controller' => 'CategoriaEquipoController']);
$routes->put('categorias-equipos/(:num)/activar', 'CategoriaEquipoController::activate/$1');

// Rutas para garantías
$routes->resource('garantias', ['controller' => 'GarantiaController']);
$routes->get('garantias/buscar', 'GarantiaController::search');
$routes->get('garantias/estadisticas', 'GarantiaController::stats');

// Rutas para estados
$routes->resource('estados', ['controller' => 'EstadoController']);
$routes->post('estados/crear-defecto', 'EstadoController::crearDefecto');

// Rutas para proveedores
$routes->resource('proveedores', ['controller' => 'ProveedorController']);
$routes->get('proveedores/buscar/(:any)', 'ProveedorController::buscar/$1');

// Rutas para equipos
$routes->get('equipos/buscar', 'EquipoController::search');
$routes->get('equipos/cliente/(:num)', 'EquipoController::byClient/$1');
$routes->get('equipos/estadisticas', 'EquipoController::stats');
$routes->get('equipos/marcas', 'EquipoController::marcas');
$routes->resource('equipos', ['controller' => 'EquipoController']);

// Rutas para administrador
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('usuarios', 'AdminController::usuarios');
    $routes->post('crear-usuario', 'AdminController::crearUsuario');
    $routes->get('eliminar-usuario/(:num)', 'AdminController::eliminarUsuario/$1');
});

// Rutas para recepcion
$routes->group('recepcion', ['filter' => 'auth:recepcion'], function($routes) {
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

