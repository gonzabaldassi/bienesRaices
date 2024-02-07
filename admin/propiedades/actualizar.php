<?php
    require "../../includes/app.php";

    estaAutenticado();

    Use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    //Validar que el ID que viene en la URL sea valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //Redireccionar si el ID no es valido
    if (!$id) {
        header('Location: /bienesraices/admin/index.php');
    }

    //Consulta para los datos de la propiedad
    $propiedad= Propiedad::find($id);


    //Consultar para obtener los vendedores
    $query_vendedores="SELECT * FROM vendedores";
    $res=mysqli_query($db,$query_vendedores);

    //Array con mensajes de errores
    $errores = Propiedad::getErrores();

    //Ejecuta el código luego de que el user envía el form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Asignar los atributos
        $args=[];
        $args=$_POST['propiedad'];

        // $args=$_POST['titulo'] ?? null;

        $propiedad->sincronizar($args);
        
        //Validacion
        $errores = $propiedad->validar();

        //Subida de archivos
        //Generar nombre aleatorio para las imagenes
        $nombreImg = md5(uniqid( rand(),true)) . ".jpg"; //Función que se usa pra hashear. Con uniqid hacemos que no se repita
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

            //Seteamos el nombre de la imagen que creamos arriba
            $propiedad->setImagen($nombreImg);
        }


        //Controlamos que no haya errores antes de insertar
        if (empty($errores)) {
            //Almacenar la imagen
            $image->save(CARPETA_IMAGENES.$nombreImg);

            //Update a la base de datos
             $propiedad ->guardar();


        }
    }

    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach; ?>
        
        <form method="POST" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formularioPropiedades.php'?>
            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>
    </main>

    <?php
        incluirTemplate('footer');
    ?> 