<?php
require_once __DIR__.'/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router=new Router();

//RUTAS PARA PROPIEDADES
$router->get('/admin', [PropiedadController::class,'index']); // Aquí se define la ruta /admin y  pasamos el metodo(index) y donde buscarlo PropiedadController::class
$router->get('/propiedades/crear',[PropiedadController::class,'create']);
$router->post('/propiedades/crear',[PropiedadController::class,'create']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'update']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'update']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'delete']);

//RUTAS PARA VENDEDORES
$router->get('/vendedores/crear',[VendedorController::class,'create']);
$router->post('/vendedores/crear',[VendedorController::class,'create']);
$router->get('/vendedores/actualizar',[VendedorController::class,'update']);
$router->post('/vendedores/actualizar',[VendedorController::class,'update']);
$router->post('/vendedores/eliminar',[VendedorController::class,'delete']);

$router->comprobarRutas();


