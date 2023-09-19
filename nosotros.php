<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Imagen sobre nosotros" loading="lazy">
                </picture>
            </div><!--.imagen-->

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin faucibus ultricies tempus. Aenean rhoncus nisi at purus facilisis fringilla. Duis vitae nisl auctor, cursus felis sit amet, consequat felis. 
                    Praesent nulla enim, gravida eget consequat et, posuere eget dolor. Vestibulum ullamcorper consequat enim, id bibendum est 
                    dictum vitae. Aenean vel elementum mauris, sed tempus dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus nulla lacus, tristique id massa vitae, iaculis volutpat lectus. 
                    Nam ac massa in risus dictum mollis. Mauris mollis in mi nec commodo. Fusce nisl orci, dignissim a blandit ac, efficitur porta sapien.
                </p>

                <p>
                    Nullam bibendum, ipsum fermentum tincidunt egestas, turpis purus porttitor diam, quis venenatis sem mi sit amet ligula. In hac habitasse platea dictumst. Donec sit amet nibh ut urna bibendum luctus. Nunc laoreet eget lorem non posuere. Maecenas at maximus urna. Nulla at dignissim felis, vitae pretium sem. Duis a arcu vitae tortor varius lacinia id ut tortor. Aenean vel massa ac eros scelerisque rhoncus. Curabitur efficitur ex ante, et congue felis facilisis sit amet. Maecenas porta odio et ipsum efficitur porta. Etiam sollicitudin diam arcu, sed finibus elit facilisis volutpat. Sed non scelerisque sapien. Vestibulum luctus pretium elit.
                </p>

                <p>
                    Ut sit amet felis eros. Integer tristique, mi eu malesuada feugiat, nisl nunc aliquam nisi, non elementum nunc odio vitae tortor. Sed sit amet blandit justo. Mauris id odio risus. Vestibulum a elit a odio pellentesque faucibus non eu lectus. Vestibulum placerat arcu sed turpis tincidunt, ac laoreet leo faucibus. Integer nec urna ultricies lorem rutrum venenatis at id eros. Suspendisse eu nulla lacinia, porttitor tortor ac, eleifend neque.
                </p>
            </div><!--.textp-nosotros-->
        </div> <!--.contenido-nosotros-->
    </main>

    <section class="contenedor seccion">
        <h2>Mas sobre nosotros</h2>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam deleniti laborum sequi! Inventore officia, commodi quisquam itaque doloribus exercitationem sit</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam deleniti laborum sequi! Inventore officia, commodi quisquam itaque doloribus exercitationem sit</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam deleniti laborum sequi! Inventore officia, commodi quisquam itaque doloribus exercitationem sit</p>
            </div>
        </div> <!--.iconos-nosotros-->
    </section>


    <?php
        incluirTemplate('footer');
    ?>