<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Casas y Deptos en Venta</h1>

        <?php 
            include 'includes/templates/anuncios.php'
        ?>
    </main>

<?php
    incluirTemplate('footer');
?>