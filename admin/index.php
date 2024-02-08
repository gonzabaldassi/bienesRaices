<?php
    require "../includes/app.php";
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    //Implementar un metodo para obtener todas las propiedades mediante activeRecords
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //Muestra alerta
    $mensaje = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            $tipo=$_POST['tipo'];

            //Validamos que el tipo que viene por POST sea valido
            if (validarTipoContenido($tipo)) {

                //Verificamos si es una propiedad o vendedor
                if ($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
    
                    $propiedad->eliminar();
                }else if($tipo === 'vendedor'){
                    $vendedor = Vendedor::find($id);
    
                    $vendedor->eliminar();
                }
            }
            

        }
    }

    //Incluir template
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($mensaje) === 1):?>
            <p class="alerta exito">Registrado Correctamente</p>

        <?php elseif(intval($mensaje) === 2): ?>
            <p class="alerta exito">Actualizado Correctamente</p>
        <?php elseif(intval($mensaje) === 3): ?>
            <p class="alerta exito">Eliminado Correctamente</p>
        <?php endif; ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody> <!--Mostrar los resultados de la query -->
                <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad -> titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad-> imagen; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad ->precio; ?> </td>
                    <td class="acciones">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad -> id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad -> id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <a href="/bienesraices/admin/vendedores/crear.php" class="boton boton-verde">Nuevo vendedor/a</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre y Apellido</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody> <!--Mostrar los resultados de la query -->
                <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre." ".$vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?> </td>
                    <td class="acciones">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor -> id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/bienesraices/admin/vendedores/actualizar.php?id=<?php echo $vendedor -> id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php
        //Cerrar la conexión de la db
        mysqli_close($db);

        incluirTemplate('footer');
    ?>
