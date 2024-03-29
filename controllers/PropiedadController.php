<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //Muestra alerta
        $resultadoAlerta = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'propiedades'=>$propiedades,
            'resultadoAlerta'=>$resultadoAlerta,
            'vendedores'=>$vendedores
        ]);
    }


    public static function create(Router $router){
        $propiedad = new Propiedad;

        //Consultar para obtener los vendedores
        $vendedores=Vendedor::all();

        //Array con mensajes de errores
        $errores = Propiedad::getErrores();

        //METODO POST PARA CREAR
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
        //Validamos el ID y en caso de no ser valido, redirigimos al /admin
        $id = validarID('/admin');

        //Consulta para los datos de la propiedad
        $propiedad= Propiedad::find($id);

        //Consultar para obtener los vendedores
        $vendedores=Vendedor::all();

        //Array con mensajes de errores
        $errores = Propiedad::getErrores();

        //METODO POST PARA ACTUALIZAR - Ejecuta el código luego de que el user envía el form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args=[];
            $args=$_POST['propiedad'];

            // $args=$_POST['titulo'] ?? null;

            $propiedad->sincronizar($args);
            
            //Validacion
            $errores = $propiedad->validar();

            //Subida de archivos
            //Generar nombre aleatorio para las imagenes
            $nombreImg = md5(uniqid( rand(),true)) . ".jpg"; //Función que se usa pra hashear. Con uniqid hacemos que no se repita
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                //Seteamos el nombre de la imagen que creamos arriba
                $propiedad->setImagen($nombreImg);
            }

            //Controlamos que no haya errores antes de insertar
            if (empty($errores)) {

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Almacenar la imagen
                    $image->save(CARPETA_IMAGENES.$nombreImg);
                }

                //Update a la base de datos
                $propiedad ->guardar();

            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad'=>$propiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores
        ]);
    }

    public static function delete(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if ($id) {
    
                $tipo=$_POST['tipo'];
    
                //Validamos que el tipo que viene por POST sea valido
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);

                    $propiedad->eliminar();

                }
            }
        }
    }
    
}

