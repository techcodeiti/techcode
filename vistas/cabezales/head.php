<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/TechCode/estilo.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <script src="/TechCode/JavaScript/functions.js"></script>
    <title>TechCode</title>
</head>
<body>

<header>
        <img id="logo" src="/TechCode/vistas/cabezales/logo.JPG" alt="logo">
        <nav>
        <?php
       // if (session_status() == PHP_SESSION_NONE) {
        if (isset($_SESSION['TIPOUSUARIO'])) {
            ?>
                <ul>
                    <?php
                    if($_SESSION['TIPOUSUARIO'] == 1){
                    ?>
                    <li><a href='../vistas/inicio_cliente.php'>INICIO</a></li>
                    <li><a href="../vistas/contacto.php">CONTACTO</a></li>
                    <li><a href='../vistas/perfil.php'>MI PERFIL</a></li>
                    <?php
                    }
                    if($_SESSION['TIPOUSUARIO'] == 2){
                    ?>
                    <li><a href='../vistas/inicio_tecnico.php'>INICIO</a></li>
                    <li><a href="../vistas/contacto.php">CONTACTO</a></li>
                    <li><a href='../vistas/perfil.php'>MI PERFIL</a></li>
                    <?php
                    }
                    if($_SESSION['TIPOUSUARIO'] == 3){
                    ?>
                    <li><a href='../vistas/inicio_moderador.php'>INICIO</a></li>
                    <li><a href="../vistas/listas_usuarios.php">LISTA DE USUARIOS</a></li>
                    <li><a href="../vistas/administrar_datos.php">ADMINISTRAR DATOS</a></li>
                    <?php
                    }
                    ?>
                    <li><a href='../controladores/cerrar_sesion.php'>CERRAR SESIÓN</a></li>
                </ul>
            <?php
        } else {
            ?>
                <ul>
                    <li><a href='../vistas/login.php'>INICIO</a></li>
                    <li><a href="../TechCode/vistas/contacto.php">CONTACTO</a></li>
                </ul>
                
            <?php
            }
        ?>
        </nav>
</header>