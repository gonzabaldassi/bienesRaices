<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        //Muestra alerta
        $resultadoAlerta = $_GET['resultado'] ?? null;
        
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

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            //Creacion de una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            //*SUBIDA DE ARCHIVOS*

            //Generar nombre aleatorio para las imagenes
            $nombreImg = md5(uniqid( rand(),true)) . ".jpg"; //Función que se usa pra hashear. Con uniqid hacemos que no se repita

            //Setear la imagen
        
            //Realiza un resize a la imagen con Intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                //Seteamos el nombre de la imagen que creamos arriba
                $propiedad->setImagen($nombreImg);
            }

            $errores=$propiedad->validar();

            //Controlamos que no haya errores antes de insertar
            if (empty($errores)) {
                
                //Crear la carpeta para subir las imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
        
                //Guardamos la imagen en el servidor
                $image->save(CARPETA_IMAGENES.$nombreImg);

                //Guarda en la db
                $propiedad -> guardar();
            }
        }

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

