<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/presupuesto.class.php');
require_once('../modelos/solicitud.class.php');

$usuario_tecnico = $_SESSION['USUARIO'];
$id_solicitud = strip_tags($_POST['IDSOLICITUD']);
$fecha = date("Y-m-d H:i:s");
$descripcion = strip_tags($_POST['DESCRIPCION']);
$subcategoria = strip_tags($_POST['SUBCATEGORIA']);
$monto = strip_tags($_POST['MONTO']);
$aceptado = 0;

// var_dump($_POST['SUBCATEGORIA']);

$p= new presupuesto("",$usuario_tecnico,$id_solicitud,$fecha,$descripcion,$monto,$aceptado,$subcategoria);

$result=$p->guardarpresupuesto();

$s = new presupuesto("",$usuario_tecnico,$id_solicitud);
$sdatos=$s->PresupuestoDatosCorreo_Tecnico();


if($result){
	// $s = new presupuesto("",$usuario_tecnico,$id_solicitud);
	// $sdatos=$s->PresupuestoDatosCorreo_Tecnico();
	header("Location: ../controladores/email/notificacion_solicitud_visita.php");
	$_SESSION['IDSOLICITUD'] = $id_solicitud;
	$_SESSION['FECHAACTIVIDAD'] = $fecha;
	$_SESSION['COMENTARIO'] = $descripcion;
	$_SESSION['MONTO'] = $monto;
	$_SESSION['REMITENTE'] = $sdatos[0]["nomtec"];
	$_SESSION['DESTINATARIO'] = $sdatos[0]["corcli"];
} else {
	echo "<script>
		alert('Hubo un error al guardar los datos de la solicitud');
		window.location = '../vistas/detalle_solicitud_tecnico.php?idSOL=$id_solicitud';
	</script>";
}


// if ($result) {

//  	$mensaje="Se ingreso el presupuesto con exito";
//  }
//  else
//  {
//  	$mensaje= "Hubo un error al guardar los datos de la solicitud";
//  }

//  echo "<script>
//  	alert('$mensaje');
//  	window.location= '../vistas/inicio_tecnico.php';
//  </script>";


?>