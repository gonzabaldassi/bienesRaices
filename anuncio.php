<?php

    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if (!$id) {
       header('Location:/bienesraices/index.php');
    }

    //Importar la db
    require 'includes/config/database.php';
    $db = conectarDB();

    //consultar
    $query = "SELECT * FROM propiedades WHERE id = $id";
    
    //leer los resultados
    $res = mysqli_query($db, $query);

    if ($res -> num_rows === 0) {
        header('Location:/bienesraices/index.php');
    }

    $propiedad = mysqli_fetch_assoc($res);

    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo'];?></h1>

        <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>.jpg" alt="Imagen de la propiedad">


        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio'];?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono baño">
                    <p><?php echo $propiedad['banios'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                    <p><?php echo $propiedad['estacionamiento'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones'];?></p>
                </li>
            </ul>

            <p>
                <?php echo $propiedad['descripcion'];?>
            </p>



        </div>
    </main>


    <?php
        mysqli_close($db);
        incluirTemplate('footer');
    ?>