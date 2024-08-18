<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/visitas.class.php');

$id = strip_tags($_POST['IDVISITAPOPUP']);
$id_solicitud = strip_tags($_POST['IDSOLICITUDPOPUP']);
$fecha = strip_tags($_POST['FECHA']);
$horas = strip_tags($_POST['HORA']);
$minutos = strip_tags($_POST['MINUTOS']);
$visita_aceptada = 1;
$hora = $horas . ':' . $minutos;
$fechaconcatenada = date($fecha .  ' '  . $hora . ":00");

setlocale(LC_TIME, 'es_ES.UTF-8');
$nroDia = date('j', strtotime($fecha));
$diaSemana = strftime('%A', strtotime($fecha));
$mes = strftime('%B', strtotime($fecha));

$av= new Visita($id,$id_solicitud,"","",$visita_aceptada,$fechaconcatenada);

$result=$av->ProgramarVisita();

$s = new Visita($id,$id_solicitud);
$sdatos=$s->SolicitudDatosCorreo_Cliente();

if($result){
	header("Location: ../controladores/email/notificacion_solicitud_visita.php");
	$_SESSION['IDSOLICITUD'] = $id_solicitud;
	$_SESSION['FECHAACTIVIDAD'] = $fecha;
	$_SESSION['COMENTARIO'] = "Para confirmar que su solicitud de visita ha sido confirmada. La cual se queda pactada para el dia " . $diaSemana . " " . $nroDia . " de " . $mes . " a las " . $hora . ".";
	$_SESSION['REMITENTE'] = $datos[0]["nomcli"];
	$_SESSION['DESTINATARIO'] = $sdatos[0]["cortec"];
} else {
	echo "<script>
		alert('Hubo un error al guardar los datos de la solicitud');
		window.location = '../vistas/inicio_cliente.php';
	</script>";
}


// if ($result) {
	
// 	$mensaje="Se programo la visita con exito";
// }
// else
// {
// 	$mensaje= "Hubo un error al guardar los datos de la solicitud";
// }

// echo "<script>
// 	alert('$mensaje');
// 	window.location= '../vistas/inicio_cliente.php';
// </script>";



?>