<?php
    // Activa la visualización de errores
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "../../includes/app.php";

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();
    

    //DB
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $query_vendedores="SELECT * FROM vendedores";
    $res=mysqli_query($db,$query_vendedores);

    //Array con mensajes de errores
    $errores = Propiedad::getErrores();

    //Asignación de variables
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $banios = '';
    $estacionamiento = '';
    $vendedores_id = '';

    //Ejecuta el código luego de que el user envía el form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Creacion de una nueva instancia
        $propiedad = new Propiedad($_POST);

        //*SUBIDA DE ARCHIVOS*

        //Generar nombre aleatorio para las imagenes
        $nombreImg = md5(uniqid( rand(),true)); //Función que se usa pra hashear. Con uniqid hacemos que no se repita

        //Setear la imagen
     
        //Realiza un resize a la imagen con Intervention
        if ($_FILES['imagen']['tmp_name']) {
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);

            //Seteamos el nombre de la imagen que creamos arriba
            $propiedad->setImagen($nombreImg);
        }


        $errores=$propiedad->validar();

        //Controlamos que no haya errores antes de insertar
        if (empty($errores)) {


            //Crear la carpeta para subir las imagenes
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
       

            //Guardamos la imagen en el servidor
            $image->save(CARPETA_IMAGENES.$nombreImg);


            //Guarda en la db
            $resultado = $propiedad -> guardar();



            //Mensaje de exito o error
            if ($resultado) { 
                //Redireccionar al usuario
                header('Location: /bienesraices/admin/index.php?resultado=1');
            }

        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>
        
        <form action="/bienesraices/admin/propiedades/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio propiedad" min="0" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion:</label>
                <textarea  id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propeidad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej. 3" min="1" name="habitaciones" value="<?php echo $habitaciones; ?>">

                <label for="banios">Baños:</label>
                <input type="number" id="banios" placeholder="Ej. 3" min="1" name="banios" value="<?php echo $banios; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" placeholder="Ej. 3" min="1" name="estacionamiento" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_id">
                    <option value="" disabled selected>**SELECCIONE**</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($res)): ?>

                        <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?>   value="<?php echo $row['id']; ?>"><?php echo $row['nombre']." ".$row['apellido'] ?></option>
                    
                    <?php endwhile;?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
        incluirTemplate('footer');
    ?> 