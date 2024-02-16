<?php
    require 'includes/app.php';
    incluirTemplate('header',true);
?>

    <main class="contenedor seccion">
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
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Deptos en Venta</h2>

        <?php 
            
            include 'includes/templates/anuncios.php'
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jepg">
                        <img src="build/img/blog1.jpg" alt="entrada de blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito en <span>21/8/2023</span> por: <span>Gonzalo Baldassi</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casas con los mejores materiales y ahorrando dinero.</p>
                    </a>
                </div>
            </article><!--.entrada-blog-->

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jepg">
                        <img src="build/img/blog2.jpg" alt="entrada de blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito en <span>21/8/2023</span> por: <span>Gonzalo Baldassi</span></p>
                        <p>
                            Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y
                            colores para darle vida a tu espacio. 
                        </p>
                    </a>
                </div>
            </article><!--.entrada-blog-->
        </section> <!---.blog-->
        
        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que 
                    me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>-Gonzalo Baldassi</p>
            </div>
        </section> <!--.testimoniales-->
    </div>

    <?php
        incluirTemplate('footer');
    ?>
