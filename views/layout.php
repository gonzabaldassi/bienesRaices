<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)){
        $inicio = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <meta name="description" content="Sitio web de compra y venta de Bienes Raices">
    <link rel="icon" href="../build/img/loco_bienesraices.ico">
    <link rel="preload" href="../build/css/app.css" as="style">
    <link rel="stylesheet" href='../build/css/app.css'>

</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de bienesraices">
                </a>
                
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>
                
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Icono de modo oscuro" class="dark-mode-btn">
                    <nav class="navegacion">
                        <a href="/nosotros" class="nosotros">Nosotros</a>
                        <a href="/propiedades" class="propiedades">Anuncios</a>
                        <a href="/blog" class="blog">Blog</a>
                        <a href="/contacto" class="contacto">Contacto</a>
                        <?php if (!$auth): ?>
                            <a href="/login" class="login">Iniciar sesión</a>
                        <?php endif;?>
                        <?php if ($auth): ?>
                            <a href="/logout">Cerrar sesión</a>
                        <?php endif;?>
                    </nav>
                </div>


            </div> <!--.barra-->

            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos</h1>
            <?php } ?>
            
        </div> <!--.contenido-header-->
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor centenedor-footer">
            <nav class="navegacion">
                <a href="/bienesraices/nosotros.php">Nosotros</a>
                <a href="/bienesraices/anuncios.php">Anuncios</a>
                <a href="/bienesraices/blog.php">Blog</a>
                <a href="/bienesraices/contacto.php">Contacto</a>
            </nav>
        </div>
        
        <?php
            $fecha = date('Y');
        ?>

        <p class="copyright">Todos los derechos Reservados <?php echo $fecha; ?> &copy; - Gonzalo Baldassi</p>
    </footer>
    
    <script src="../build/js/bundle.min.js"></script>
</body>
</html>
