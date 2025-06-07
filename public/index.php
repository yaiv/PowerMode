<?php

require_once __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\PrendaController;
use Controllers\SuplementoController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router();

//Zona Privada

$router->get('/admin', [PrendaController::class, 'index']);
$router->get('/prendas/crear', [PrendaController::class, 'crear']);
$router->post('/prendas/crear', [PrendaController::class, 'crear']);
$router->get('/prendas/actualizar', [PrendaController::class, 'actualizar']);
$router->post('/prendas/actualizar', [PrendaController::class, 'actualizar']);
$router->post('/prendas/eliminar', [PrendaController::class, 'eliminar']);

// Rutas para Suplementos
$router->get('/suplementos/crear', [SuplementoController::class, 'crear']);
$router->post('/suplementos/crear', [SuplementoController::class, 'crear']);
$router->get('/suplementos/actualizar', [SuplementoController::class, 'actualizar']);
$router->post('/suplementos/actualizar', [SuplementoController::class, 'actualizar']);
$router->post('/suplementos/eliminar', [SuplementoController::class, 'eliminar']);


//Zona Publica

$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/prendas', [PaginasController::class, 'prendas']);
$router->get('/prenda', [PaginasController::class, 'prenda']);
$router->get('/suplementos', [PaginasController::class, 'suplementos']);
$router->get('/suplemento', [PaginasController::class, 'suplemento']);

//Login y Autenticacion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();