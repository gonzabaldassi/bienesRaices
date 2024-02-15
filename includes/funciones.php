<?php 

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');



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

//Escapar (sanitizar) el HTML
function sanitizar($html) : string{
    $s=htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos=['vendedor','propiedad'];

    return in_array($tipo,$tipos);//Buscar un string dentro de un arreglo, en este caso busca lo que viene por parametro ($tipo) en el array $tipos
    
}

function notificar($codigo){
    $mensaje='';
    switch ($codigo) {
        case 1:
            $mensaje= 'Registrado Correctamente';
            break;
        case 2:
            $mensaje= 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje= 'Eliminado Correctamente';
            break;
        
        default:
            $mensaje=false;
            break;
    }

    return $mensaje;

}