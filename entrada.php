<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Construye una piscina para tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>

        <p class="informacion-meta">Escrito el: <span>21/08/2023</span> por: <span>Gonzalo Baldassi</span></p>

        <div class="resumen-propiedad">

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin faucibus ultricies tempus. Aenean rhoncus nisi at purus facilisis fringilla. Duis vitae nisl auctor, cursus felis sit amet, consequat felis. 
                Praesent nulla enim, gravida eget consequat et, posuere eget dolor. Vestibulum ullamcorper consequat enim, id bibendum est 
                dictum vitae. Aenean vel elementum mauris, sed tempus dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus nulla lacus, tristique id massa vitae, iaculis volutpat lectus. 
                Nam ac massa in risus dictum mollis. Mauris mollis in mi nec commodo. Fusce nisl orci, dignissim a blandit ac, efficitur porta sapien.
            </p>

            <p>
                Nullam bibendum, ipsum fermentum tincidunt egestas, turpis purus porttitor diam, quis venenatis sem mi sit amet ligula. In hac habitasse platea dictumst. Donec sit amet nibh ut urna bibendum luctus. Nunc laoreet eget lorem non posuere. 
                Maecenas at maximus urna. Nulla at dignissim felis, vitae pretium sem. Duis a arcu vitae tortor varius lacinia id ut tortor.
                Aenean vel massa ac eros scelerisque rhoncus. Curabitur efficitur ex ante, et congue felis facilisis sit amet. 
                Maecenas porta odio et ipsum efficitur porta. Etiam sollicitudin diam arcu, sed finibus elit facilisis volutpat. Sed non 
                scelerisque sapien. Vestibulum luctus pretium elit.
            </p>

        </div>
    </main>

<?php
    incluirTemplate('footer');
?>
