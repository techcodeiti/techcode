<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/suspension.class.php');
require_once('../modelos/usuarios.class.php');

$fecha = date("Y-m-d H:i:s");
$fecha_reanudacion = strip_tags($_POST['FECHA']);
$comentario = strip_tags($_POST['COMENTARIO']);
$usuario_tecnico = strip_tags($_POST['IDTECNICOPOPUP']);

$sus = new Suspension("",$usuario_tecnico,$comentario,$fecha,$fecha_reanudacion);
$u = new Usuario($usuario_tecnico);

$result=$sus->guardarsuspension();
$result=$u->usuarioSuspendido();

$sdatos=$u->UsuariosTecnicosCorreo();


if($fecha){
	header("Location: ../controladores/email/notificacion_suspension_correo.php");
	$_SESSION['FECHAACTIVIDAD'] = $fecha;
	$_SESSION['FECHAREANUDACION'] = date("d/m/Y", strtotime($fecha_reanudacion));
	$_SESSION['COMENTARIO'] = $comentario;
	$_SESSION['REMITENTE'] = "Administrador/Moderador";
	$_SESSION['DESTINATARIO'] = $sdatos[0]["cortec"];
} else {
	echo "<script>
		alert('Hubo un error al guardar los datos de la solicitud');
		window.location = '../vistas/inicio_moderador.php';
	</script>";
}
?>