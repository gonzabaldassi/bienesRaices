<?php
    require "../includes/app.php";
    estaAutenticado();

    use App\Propiedad; 

    //Implementar un metodo para obtener todas las propiedades mediante activeRecords
    $propiedades = Propiedad::all();


    //Muestra alerta
    $mensaje = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            //Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = $id";

            $resultado = mysqli_query($db, $query);

            $propiedad = mysqli_fetch_assoc($resultado);

            unlink("../imagenes/".$propiedad['imagen'].".jpg");

            //Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id = $id";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header('Location: /bienesraices/admin/index.php?resultado=3');
            }
        }
    }

    //Incluir template
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($mensaje) === 1):?>
            <p class="alerta exito">Propiedad Registrada Correctamente</p>

        <?php elseif(intval($mensaje) === 2): ?>
            <p class="alerta exito">Propiedad Actualizada Correctamente</p>
        <?php elseif(intval($mensaje) === 3): ?>
            <p class="alerta exito">Propiedad Eliminada Correctamente</p>
        <?php endif; ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    
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
                    <td><?php echo $propiedad->getID(); ?></td>
                    <td><?php echo $propiedad -> getTitulo(); ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad-> getImagen(); ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad -> getPrecio(); ?> </td>
                    <td class="acciones">
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad -> getID(); ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad -> getID(); ?>" class="boton-amarillo-block">Actualizar</a>
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
