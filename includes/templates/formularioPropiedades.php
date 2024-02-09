<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio propiedad" min="0" value="<?php echo sanitizar($propiedad -> precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen){?>
        <img src="/bienesraices/imagenes/<?php echo $propiedad->imagen;?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" placeholder="Ej. 3" min="1" name="propiedad[habitaciones]" value="<?php echo sanitizar($propiedad -> habitaciones); ?>">

    <label for="banios">Baños:</label>
    <input type="number" id="banios" placeholder="Ej. 3" min="1" name="propiedad[banios]" value="<?php echo sanitizar($propiedad->banios); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" placeholder="Ej. 3" min="1" name="propiedad[estacionamiento]" value="<?php echo sanitizar($propiedad -> estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="Vendedor">Vendedor</label>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option selected value="" disabled>**SELECCIONE**</option>
        <?php foreach ($vendedores as $vendedor){?>
            <option 
            <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''?>
            value="<?php echo sanitizar($vendedor->id)?>"><?php echo sanitizar($vendedor->nombre)." ".sanitizar($vendedor->apellido);?></option>
        <?php } ?>
    </select>
</fieldset>