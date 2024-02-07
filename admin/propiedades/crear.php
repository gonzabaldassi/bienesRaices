<?php
    // Activa la visualización de errores
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require "../../includes/app.php";

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();


    $propiedad = new Propiedad;

    //Consultar para obtener los vendedores
    $vendedores=Vendedor::all();
    
    //Array con mensajes de errores
    $errores = Propiedad::getErrores();

    //Ejecuta el código luego de que el user envía el form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Creacion de una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);

        //*SUBIDA DE ARCHIVOS*

        //Generar nombre aleatorio para las imagenes
        $nombreImg = md5(uniqid( rand(),true)) . ".jpg"; //Función que se usa pra hashear. Con uniqid hacemos que no se repita

        //Setear la imagen
     
        //Realiza un resize a la imagen con Intervention
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

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
            $propiedad -> guardar();
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
            <?php include '../../includes/templates/formularioPropiedades.php'?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
        incluirTemplate('footer');
    ?> 