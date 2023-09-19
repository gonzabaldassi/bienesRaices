<?php
    //DB
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $query_vendedores="SELECT * FROM vendedores";
    $res=mysqli_query($db,$query_vendedores);

    //Array con mensajes de errores
    $errores = [];

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
        
        //Asignación de variables
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $banios = mysqli_real_escape_string($db, $_POST['banios']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);
        $fechaCreacion = date('Y/m/d');

        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        //Verificacion de errores
        if (!$titulo){
            $errores[] = 'Debes añadir un titulo';
        }

        if (!$precio) {
            $errores[] = 'El Precio es obligatorio';
        }

        if (!$imagen['name'] || $imagen['error']) {
            $errores[] = 'La imagen es obligatoria';
        }

        //Valdiar por tamaño 1mb maximo
        $medida = 1000 * 1000;
        if ($imagen['size']>$medida) {
            $errores[] = 'La imagen es muy pesada';
        }
        
        if (strlen($descripcion)<50) {
            $errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$habitaciones) {
            $errores[] = 'El numero de habitaciones es obligatorio';
        }

        if (!$banios) {
            $errores[] = 'El numero de banios es obligatorio';
        }

        if (!$estacionamiento) {
            $errores[] = 'El numero de lugares de estacionamientos es obligatorio';
        }

        if (!$vendedores_id ) {
            $errores[] = 'Debes seleccionar un vendedor';
        }


        //Controlamos que no haya errores antes de insertar
        if (empty($errores)) {

            //SUBIDA DE ARCHIVOS

            //Crear carpeta
            $carpetaImg = '../../imagenes';

            if (!is_dir($carpetaImg)) {  //is_dir verifica si el directorio existe o no
                mkdir($carpetaImg);      // comando para crear un directorio
            }

            //Generar nombre aleatorio para las imagenes
            $nombreImg = md5(uniqid( rand(),true)); //Función que se usa pra hashear. Con uniqid hacemos que no se repita

            //subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImg . "/".$nombreImg . ".jpg");  //$imagen['tmp_name'] --> imagen que está almacenada en el servidor
            

            //Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, banios, estacionamiento,fechaCreacion, vendedores_id) 
                    VALUES ('$titulo', '$precio','$nombreImg', '$descripcion', '$habitaciones', '$banios', '$estacionamiento','$fechaCreacion', '$vendedores_id')" ;

            //echo $query;
            $resultado = mysqli_query($db, $query);

            if ($resultado) { 
                //Redireccionar al usuario
                header('Location: /bienesraices/admin/index.php?resultado=1');
            }

        }
    }

    require "../../includes/funciones.php";
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