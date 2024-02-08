<?php
require 'funciones.php';
require "config/database.php";
require __DIR__."/../vendor/autoload.php";

use App\ActiveRecord;

//Conectamos con la db
$db = conectarDB();
ActiveRecord::setDataBase($db);