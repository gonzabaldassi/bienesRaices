<?php
// Activa la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

$vendedor = new vendedor;

//Array con mensajes de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($errores)) {}
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