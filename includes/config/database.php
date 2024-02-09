<?php

function conectarDB() : mysqli{
    $db=new mysqli('localhost','root','root','bienesraices');

    $db->set_charset('utf8');
    
    if (!$db) {
        echo "Error, NO se pudo conectar.";
        exit;
    }

    return $db;
}