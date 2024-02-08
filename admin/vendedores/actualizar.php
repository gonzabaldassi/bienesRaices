<?php
// Activa la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

//Validar que sea un id valido
$id = $_GET['id'];
$id=filter_var($id,FILTER_VALIDATE_INT);

//Redireccionar si el ID no es valido
if (!$id) {
    header('Location: /bienesraices/admin/index.php');
}


//Consulta para los datos de la propiedad
$vendedor= Vendedor::find($id);

//Array con mensajes de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar los atributos
    $args=[];
    $args=$_POST['vendedor'];

    //Sincronizar el objeto en memoria con lo que el usuario ingresó
    $vendedor->sincronizar($args);

    //Validamos que no haya ningun error para poder realizar el update
    $erroes=$vendedor->validar();
    
    if (empty($errores)) {
        //Update a la db
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Actualizar vendedor/a</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>
        
        <form method="POST" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formularioVendedores.php'?>

            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>
    </main>

    <?php
        incluirTemplate('footer');
    ?> 