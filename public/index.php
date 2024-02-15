<?php
require_once __DIR__.'/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;

$router=new Router();




$router->get('/admin', [PropiedadController::class,'index']); // Aquí se define la ruta /admin y  pasamos el metodo(index) y donde buscarlo PropiedadController::class
$router->get('/propiedades/crear',[PropiedadController::class,'create']);
$router->post('/propiedades/crear',[PropiedadController::class,'create']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'update']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'update']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'delete']);


$router->comprobarRutas();


