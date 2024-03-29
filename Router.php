<?php
namespace MVC;

class Router{
    public $rutasGET = [];
    public $rutasPOST = [];
    
    //Metodop para verificar si la urlActual es valida y que tipo de accion desea realizar
    public function comprobarRutas(){
        //Iniciamos la sesion
        session_start();

        //Vemos si está o no autenticado
        $auth= $_SESSION['login'] ?? null;

        //Array de rutas protegidas
        $rutasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //Identifico la URL que estoy visitando mediante la info del server
        $metodo = $_SERVER['REQUEST_METHOD'];      //Identifico si es POST o GET

       if ($metodo === 'GET') {
        $funcion = $this->rutasGET[$urlActual] ?? null;
       }else if ($metodo === 'POST') {
        $funcion = $this->rutasPOST[$urlActual] ?? null;
       }

       //Proteger las rutas
       if (in_array($urlActual, $rutasProtegidas) && !$auth) {
            header('Location: /');
       }

       //COndicional que verifica que la URL existe y tiene una funcion asociada
       if ($funcion) {
        // Funcion que nos permite llamar a una funcion(definida en el controlador), cuando no conocemos su nombre
        call_user_func($funcion, $this); // Le enviamos la funcion relacionada con la URL que visita el user y las rutas, tanto GET como POST
       }else{}
    }

    //Metodo para accionar todas las url que vienen con método GET
    //La clave del arreglo es la URL y el valor es su funcion
    public function get($url, $funcion){
        $this->rutasGET[$url]=$funcion;
    }

    //Metodo para accionar todas las peticiones que vienen con método POST
    //La clave del arreglo es la direccion y el valor es su funcion
    public function post($url, $funcion){
        $this->rutasPOST[$url]=$funcion;
    }

    //Muestra una vista
    public function render($view, $data=[]){
        foreach ($data as $key => $value) {
            $$key=$value; //El $$ significa variable de variable. Mantiene el nombre pero no pierde el valor. Genera variables con el nombre de los key del arreglo asociativo qeu le estamos pasando por parametro
        }

        ob_start(); //Iniciamos un almacenamiento en memoria, lo que carguemos no va al navegador, queda en un buffer

        include __DIR__ . "/views/".$view.'.php';

        $contenido = ob_get_clean(); //Limpiamos la memoria y se almacena el include anterior a la variable $contenido

        include __DIR__.'/views/layout.php';
        
    }
}