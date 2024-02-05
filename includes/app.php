<?php
require 'funciones.php';
require "config/database.php";
require __DIR__."/../vendor/autoload.php";

use App\Propiedad;

//Conectamos con la db
$db = conectarDB();
Propiedad::setDataBase($db);