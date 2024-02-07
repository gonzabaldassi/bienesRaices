<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo propiedad" value="<?php echo sanitizar($propiedad->getTitulo()); ?>">

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio propiedad" min="0" value="<?php echo sanitizar($propiedad -> getPrecio()); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->getImagen()){?>
        <img src="/bienesraices/imagenes/<?php echo $propiedad->getImagen();?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->getDescripcion()); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion Propeidad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" placeholder="Ej. 3" min="1" name="propiedad[habitaciones]" value="<?php echo sanitizar($propiedad -> getHabitaciones()); ?>">

    <label for="banios">Baños:</label>
    <input type="number" id="banios" placeholder="Ej. 3" min="1" name="propiedad[banios]" value="<?php echo sanitizar($propiedad->getBanios()); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" placeholder="Ej. 3" min="1" name="propiedad[estacionamiento]" value="<?php echo sanitizar($propiedad -> getEstacionamiento()); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="propiedad[vendedores_id]">
        <option value="" disabled selected>**SELECCIONE**</option>
        <?php
        while ($vendedor = mysqli_fetch_assoc($res)) : ?>

            <option <?php echo $vendedores_id === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?></option>

        <?php endwhile; ?>
    </select>
</fieldset>