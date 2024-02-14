<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $resultadoAlerta =null;
        
        $router->render('propiedades/admin', [
            'propiedades'=>$propiedades,
            'resultadoAlerta'=>$resultadoAlerta
        ]);
    }

    public static function create(){
        echo "Crear";
    }

    public static function update(){
        echo "Actualizar";
    }
    
}

