<?php 

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL."/$nombre.php";
}

function estaAutenticado():bool{
    session_start();
    $auth = $_SESSION['login']; //Este login dentro de la superglboal $_SESSION lo creamos en el login.php
    if ($auth) {
        return true;
    }  
    return false;
    
}