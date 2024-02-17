<main class="contenedor seccion">
        <h1>Contacto</h1>
        <?php
        if ($mensaje) {
            echo "<p class='alerta exito'>".$mensaje."</p>";
        }
        ?>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="Imagen de contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Informacion personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>

                <label for="mensaje">mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones" required>Vende o Compra</label>
                <select id="opciones" name="contacto[tipo]">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto"  required>Precio o presupuesto</label>
                <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required> 

                    <label for="contactar-email">email</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div>
            </fieldset>

            <input type="submit" value="enviar" class="boton-verde">
        </form>
</main>