<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/visitas.class.php');
//var_dump("Hola mundo");
$usuario_tecnico = $_SESSION['USUARIO'];
$usuario_cliente = strip_tags($_POST['USUARIOCLIENTE']);
$fecha = date("Y-m-d H:i:s");
$id_solicitud = strip_tags($_POST['IDSOLICITUD']);
$aceptado = 0;

$v= new Visita("",$id_solicitud,$usuario_tecnico,$usuario_cliente,$aceptado,"");
//var_dump($v);
$result=$v->guardar();

$s = new Visita("",$id_solicitud,$usuario_tecnico);
$sdatos=$s->SolicitudDatosCorreo_Tecnico();

if($result){
	header("Location: ../controladores/email/notificacion_solicitud_visita.php");
	$_SESSION['IDSOLICITUD'] = $id_solicitud;
	$_SESSION['FECHAACTIVIDAD'] = $fecha;
	$_SESSION['COMENTARIO'] = "El usuario <b>" . $sdatos[0]["nomtec"] ."</b> ha solicitado coordinar una visita.<br>Coordine fecha y hora para que se logre concretar la misma.";
	$_SESSION['REMITENTE'] = $sdatos[0]["nomtec"];
	$_SESSION['DESTINATARIO'] = $sdatos[0]["corcli"];
} else {
	echo "<script>
		alert('Hubo un error al guardar los datos de la solicitud');
		window.location = '../vistas/detalle_solicitud_tecnico.php?idSOL=$id_solicitud';
	</script>";
}

?>