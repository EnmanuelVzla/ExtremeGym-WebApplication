<?php 
    if(!isset($_SESSION)){
        session_start(); 

    }
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Extreme Gym</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="icon" href="/build/img/favicon.ico">
</head>
<body class="dark-mode">

<div class="header">   
    <div class="contenedor contenido-header">
        <div class="barra">
            <a href="/index.php">
                <img class="imagen-gym" src="/build/img/logomejor.webp" alt="logotipo de Extreme Gym"> 
            </a>

            <div class="mobile-menu">
                <img src="/build/img/barras.svg" alt="icono menu ">
            </div>

            <div class="derecha">
                <nav class="navegacion navEffect">
                    <a class="navEffect-a" href="/nosotros.php"><span>Mais de Nós</span></a>
                    <a class="navEffect-a" href="/productos.php"><span>Produtos</span></a>
                    <a class="navEffect-a" href="/imagenes.php"><span>Imagens</span></a>
                    <a class="navEffect-a" href="/exercicios.php"><span>Exercícios</span></a>
                    <a class="navEffect-a" href="/contacto.php"><span>Contacto</span></a>
                    <?php if($auth): ?>     
                        <a href="/admin/index.php">Admin</a>   
                        <a href="/cerrar-sesion.php">Fechar Sesion</a>                   
                    <?php endif; ?>
                </nav>
            </div>

            <div class="derecha">
                <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
            </div>

        </div> <!--.barra-->
    </div>
</div>

<header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
    <div class="contenedor contenido-header">
        <?php echo $inicio ? '<div class="wrapper"><h1>Extreme Gym <span class="wrapper-h1-span"></span></h1></div>' : ''; ?>
    </div>
</header>

<div class="content">