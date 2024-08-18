<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/reclamos.class.php');
require_once('../modelos/tickets.class.php');

$Motivo = strip_tags($_POST['tipo_reporte']);
if (isset($_POST['detalles'])) {
  $descripcion = strip_tags($_POST['detalles']);
} else {
  $descripcion = "";
}
$fecha = date("Y-m-d H:i:s");
$id_ticket = strip_tags($_SESSION['IDTICKET']);
$usuario_tecnico = strip_tags($_SESSION['IDTECNICO']);
$activo = 1;
$aceptacion = 0;
$usuario_cliente = $_SESSION['USUARIO'];
$estado = 5;

$r = new Reclamo("",$fecha,$descripcion,$aceptacion,"",$activo,$Motivo,$usuario_cliente,$usuario_tecnico,$id_ticket);
$p = new ticket($id_ticket,"","","","","","",$estado);

$result=$r->guardarreclamo();
$result=$p->cambiarestadoticket();

$s = new Reclamo("","","","","","","","","",$id_ticket);
$sdatos=$s->CorreoTecnicoReportar();

// var_dump($sdatos[0]["cortec"]);


if($result){
	header("Location: ../controladores/email/notificacion_actividad.php");
	$_SESSION['IDTICKET'] = $id_ticket;
	$_SESSION['FECHAACTIVIDAD'] = $fecha;
	$_SESSION['COMENTARIO'] = "Para notificarle que " . $sdatos[0]["nomcli"] . " le ha levantado reclamo debido a incumplimiento. Nuestro Moderador auditara el Ticket para resolver que hacer.";
	$_SESSION['STATUS'] = "Detenido";
	$_SESSION['REMITENTE'] = $sdatos[0]["nomcli"];
	$_SESSION['DESTINATARIO'] = $sdatos[0]["cortec"];
} else {
	echo "<script>
		alert('Hubo un error al guardar los datos de la solicitud');
		window.location = '../vistas/inicio_cliente.php';
	</script>";
}


// if ($result) {
	
// 	$mensaje="Se ingreso el reclamo con exito";
// }
// else
// {
// 	$mensaje= "Hubo un error al guardar los datos del reclamo";
// }

// echo "<script>
// 	alert('$mensaje');
// 	window.location= '../vistas/inicio_cliente.php';
// </script>";



?>
