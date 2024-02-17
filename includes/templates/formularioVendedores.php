<fieldset>
    <legend>Información Personal</legend>

    <label for="nombre">Nombre:</label>
    <!-- Al poner el name de la siguiente manera: vendedor[nombre] lo que hacemos es mapear exactamente lo que tenemos en la db -->
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre vendedor/a" value="<?php echo sanitizar($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <!-- Al poner el name de la siguiente manera: vendedor[apellido] lo que hacemos es mapear exactamente lo que tenemos en la db -->
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido vendedor/a" value="<?php echo sanitizar($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Información de contacto</legend>
    <label for="telefono">Telefono:</label>
    <!-- Al poner el name de la siguiente manera: vendedor[telefono] lo que hacemos es mapear exactamente lo que tenemos en la db -->
    <input type="text" name="vendedor[telefono]" id="telefono" placeholder="Telefono vendedor/a" value="<?php echo sanitizar($vendedor->telefono); ?>">
</fieldset>