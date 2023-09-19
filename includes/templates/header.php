<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <meta name="description" content="Sitio web de compra y venta de Bienes Raices">
    <link rel="icon" href="/bienesraices/build/img/logo_bienesraices.ico">
    <link rel="preload" href="/bienesraices/build/css/app.css" as="style">
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">

</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="Logotipo de bienesraices">
                </a>
                
                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="Icono menu responsive">
                </div>
                
                <div class="derecha">
                    <img src="/bienesraices/build/img/dark-mode.svg" alt="Icono de modo oscuro" class="dark-mode-btn">
                    <nav class="navegacion">
                        <a href="/bienesraices/nosotros.php">Nosotros</a>
                        <a href="/bienesraices/anuncios.php">Anuncios</a>
                        <a href="/bienesraices/blog.php">Blog</a>
                        <a href="/bienesraices/contacto.php">Contacto</a>
                    </nav>
                </div>


            </div> <!--.barra-->

            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos</h1>
            <?php } ?>
            
            
        </div> <!--.contenido-header-->
    </header>