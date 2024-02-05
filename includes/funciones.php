<?php 

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES',__DIR__.'/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL."/$nombre.php";
}

function estaAutenticado():bool{
    session_start();
    
    //Este login dentro de la superglboal $_SESSION lo creamos en el login.php
    if (!$_SESSION['login']) {
        header('Location: /bienesraices/index.php');
    }  
    return false;
    
}

function debugear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}