<?php

function conectarDB() : mysqli{
    $db=mysqli_connect('localhost','root','root','bienesraices');

    $db->set_charset('utf8');
    
    if (!$db) {
        echo "Error, NO se pudo conectar.";
        exit;
    }

    return $db;
}