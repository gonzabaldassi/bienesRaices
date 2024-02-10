<?php

namespace MVC;

class Router{
    public $rutasGET = [];
    public $rutasPOST = [];

    //Metodop para verificar si la urlActual es valida y que tipo de accion desea realizar
    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //Identifico la URL que estoy visitando mediante la info del server
        $metodo = $_SERVER['REQUEST_METHOD']; //Identifico si es POST o GET

       if ($metodo === 'GET') {
        $funcion = $this->rutasGET[$urlActual] ?? null;
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
}