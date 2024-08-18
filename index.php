<?php
if (session_status() == PHP_SESSION_NONE) {
    require("vistas/login.php");
} else {
    if($_SESSION['TIPOUSUARIO'] == 1){
        require("vistas/inicio_cliente.php");
    }
    if($_SESSION['TIPOUSUARIO'] == 2){
        require("vistas/inicio_tecnico.php");
    }
    if($_SESSION['TIPOUSUARIO'] == 3){
        require("vistas/inicio_moderador.php");
    }
}

?>