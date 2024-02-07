<?php
//Importar la conexión
require 'includes/app.php';

$db = conectarDB();

//Crear un email y password
$email = "root@root.com";
$password = "root";

//Hasheamos la password
$passwordHash = password_hash($password,PASSWORD_DEFAULT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (email,password) VALUES ('$email', '$passwordHash');";

//Agregarlo a la base de datos
mysqli_query($db,$query);