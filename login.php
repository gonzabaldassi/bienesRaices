<?php
    require 'includes/app.php';
    //Conexion a la DB
    $db = conectarDB();
        
    $errores = [];

    //Autenticar el usuario
    if ($_SERVER['REQUEST_METHOD']==='POST') {

        //Guardamos los datos que vienen del POST y los sanitizamos
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $pass = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[]="El email es obligatorio o no es válido";
        }

        if (!$pass) {
            $errores[]="El password es obligatorio";
        }

        if (empty($errores)) {
            //Controlar si el usuario existe o no
            $query = "SELECT * FROM usuarios WHERE email='$email' ";

            $resultado = mysqli_query($db, $query);

            

            if ($resultado->num_rows) { //Este if comprueba que haya resultados de una consulta a la db

                //Obtenemos el usuario
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($pass, $usuario['password']);

                if ($auth) {
                    //Guardar que el usuario fue autenticado
                    session_start();

                    //Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /bienesraices/admin/index.php');

                }else{
                    $errores[] = "La contraseña ingresada no es correcta";
                }
                
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }
    
    
    //Incluye el header
    incluirTemplate('header');
?>

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

    <?php
        incluirTemplate('footer');
    ?>
