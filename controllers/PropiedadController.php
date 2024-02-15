<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $resultadoAlerta =null;
        
        $router->render('propiedades/admin', [
            'propiedades'=>$propiedades,
            'resultadoAlerta'=>$resultadoAlerta
        ]);
    }

    public static function create(Router $router){
        $propiedad = new Propiedad;

        //Consultar para obtener los vendedores
        $vendedores=Vendedor::all();

        //Array con mensajes de errores
        $errores = Propiedad::getErrores();

        $router->render('propiedades/crear', [
            'propiedad'=>$propiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores
        ]);
    }

    public static function update(Router $router){
        $router->render('propiedades/actualizar', [
        ]);
    }
    
}

