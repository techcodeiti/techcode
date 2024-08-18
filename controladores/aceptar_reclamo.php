<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/reclamos.class.php');
require_once('../modelos/amonestacion.class.php');

$fecha = date("Y-m-d H:i:s");
$id_reporte = strip_tags($_POST['IDRECLAMO']);
$id_tecnico = strip_tags($_POST['IDTECNICO']);
$aceptacion_reclamo = 1;
$cerrar_reclamo = 0;
$amonestacion = 1;


$r = new Reclamo($id_reporte,"","",$aceptacion_reclamo,$fecha,$cerrar_reclamo,"","","","");
$a = new Amonestacion("",$id_reporte,$id_tecnico,$amonestacion,$fecha);

$result=$r->AceptarReclamo();
$result=$a->guardaramonestacion();

$s = new Amonestacion("",$id_reporte,$id_tecnico);
$sdatos=$s->CorreoTecnicoAmonestacion();

if($result){
	header("Location: ../controladores/email/notificacion_actividad.php");
	$_SESSION['IDTICKET'] = $sdatos[0]["id_ticket"];
	$_SESSION['FECHAACTIVIDAD'] = $fecha;
	$_SESSION['COMENTARIO'] = "Para notificarle que ha sido amonestado debido a incumplimientos o falta de compromiso sobre la tarea.";
	$_SESSION['STATUS'] = "Detenido";
	$_SESSION['REMITENTE'] = "Administrador/Moderador";
	$_SESSION['DESTINATARIO'] = $sdatos[0]["cortec"];
} else {
	echo "<script>
		alert('Hubo un error al guardar los datos de la solicitud');
		window.location = '../vistas/inicio_moderador.php';
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
// 	window.location= '../vistas/inicio_moderador.php';
// </script>";

?>