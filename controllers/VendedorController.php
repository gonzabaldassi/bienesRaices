<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function create(Router $router){
        $vendedor = new vendedor;

        //Array con mensajes de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor = new Vendedor($_POST['vendedor']);

            //Validar que no haya campos vacíos
            $errores=$vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor'=>$vendedor,
            'errores'=>$errores
        ]);
    }

    public static function update(Router $router){
        //Validar que sea un id valido
        $id=validarID('/admin');

        //Consulta para los datos de la propiedad
        $vendedor= Vendedor::find($id);

        //Array con mensajes de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos
            $args=[];
            $args=$_POST['vendedor'];

            //Sincronizar el objeto en memoria con lo que el usuario ingresó
            $vendedor->sincronizar($args);

            //Validamos que no haya ningun error para poder realizar el update
            $errores=$vendedor->validar();
            
            if (empty($errores)) {
                //Update a la db
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/actualizar',[
            'vendedor'=>$vendedor,
            'erroers'=>$errores
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
                    $vendedor = Vendedor::find($id);

                    $vendedor->eliminar();

                }
            }
        }
    }


}