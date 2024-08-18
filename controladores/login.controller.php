<?php
session_start();
require_once('../modelos/usuarios.class.php');
$nombre_usuario = $_POST['USERNAME'];
$password = $_POST['PASSWORD'];

$p=new usuario("","","",$nombre_usuario);
$resultado=$p->controlLogin();
$resultado1 = !empty($resultado) ? $resultado[0] : null;

if (!$resultado1) {
    $mensaje = "Usuario o Contraseña Incorrecto.";
    echo "<script>
    alert('$mensaje');
    window.location = '../index.php';
    </script>";
} else {
    if ($resultado1['activo'] == 0) {
        $mensaje = "Usuario Bloqueado, por favor ponerse en contacto con el Administrador";
        echo "<script>
        alert('$mensaje');
        window.location = '../index.php';
        </script>";
    } elseif ($password == $resultado1['password']) {
        $_SESSION['USUARIO'] = $resultado1['id'];
        $_SESSION['NOMBREUSUARIO'] = $resultado1['nombre_usuario'];
        $_SESSION['TIPOUSUARIO'] = $resultado1['tipo_usuario'];
        $mensaje = "Se ha accedido correctamente";
    } else {
        $mensaje = "Verifique su contraseña";
        echo "<script>
        alert('$mensaje');
        window.location = '../index.php';
        </script>";
    }
}


$tipo_usuario = $resultado1['tipo_usuario'];

if ($tipo_usuario == 1){
echo "<script>
	alert('$mensaje');
	window.location= '../vistas/inicio_cliente.php';
</script>";
} 
if ($tipo_usuario == 2){
	echo "<script>
	alert('$mensaje');
	window.location= '../vistas/inicio_tecnico.php';
</script>";	
}
if ($tipo_usuario == 3){
	echo "<script>
	alert('$mensaje');
	window.location= '../vistas/inicio_moderador.php';
</script>";	
}



?>