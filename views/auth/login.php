<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>

        <?php foreach($errores as $error):?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email & Password</legend>

                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Tu email" id="email">

                <label for="password">Password</label>
                <input type="password"name="password" placeholder="Tu password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </form>
</main>
