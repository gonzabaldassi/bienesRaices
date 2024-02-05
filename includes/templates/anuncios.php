<?php
    //Declarar la db
    $db = conectarDB();

    //consultar
    if ($limite) {
        $query = "SELECT * FROM propiedades LIMIT $limite";
    }else{
        $query = "SELECT * FROM propiedades";
    }

    //leer los resultados
    $res = mysqli_query($db, $query);

  

?>

    <div class="contenedor-cards">
        <?php while($propiedad = mysqli_fetch_assoc($res)): ?>
        <div class="card">

            <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio de casa">


            <div class="contenido-card">
                <h3><?php echo $propiedad['titulo'];?></h3>
                <p><?php echo $propiedad['descripcion'];?></p>
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

                <a href="anuncio.php?id=<?php echo $propiedad['id'];?>" class="boton-amarillo-block"> Ver propiedad</a>
            </div><!--.contenido-card-->
        </div> <!--.card-->
        <?php endwhile?>
    </div><!--.contenedor-cards-->

<?php
    //Cerrar al conexion
    mysqli_close($db);

?>