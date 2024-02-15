<?php
require_once __DIR__.'/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;

$router=new Router();

//RUTAS PARA PROPIEDADES - PRIVADO
$router->get('/admin', [PropiedadController::class,'index']); // Aquí se define la ruta /admin y  pasamos el metodo(index) y donde buscarlo PropiedadController::class
$router->get('/propiedades/crear',[PropiedadController::class,'create']);
$router->post('/propiedades/crear',[PropiedadController::class,'create']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'update']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'update']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'delete']);

//RUTAS PARA VENDEDORES - PRIVADO
$router->get('/vendedores/crear',[VendedorController::class,'create']);
$router->post('/vendedores/crear',[VendedorController::class,'create']);
$router->get('/vendedores/actualizar',[VendedorController::class,'update']);
$router->post('/vendedores/actualizar',[VendedorController::class,'update']);
$router->post('/vendedores/eliminar',[VendedorController::class,'delete']);

//RUTAS DE LA PÁGINA - PUBLICO
$router->get('/',[PaginasController::class, 'index']);
$router->get('/nosotros',[PaginasController::class, 'nosotros']);
$router->get('/propiedades',[PaginasController::class, 'propiedades']);
$router->get('/propiedad',[PaginasController::class, 'propiedad']);
$router->get('/blog',[PaginasController::class, 'blog']);
$router->get('/entrada',[PaginasController::class, 'entrada']);
$router->get('/contacto',[PaginasController::class, 'contacto']);
$router->post('/contacto',[PaginasController::class, 'contacto']);


$router->comprobarRutas();


