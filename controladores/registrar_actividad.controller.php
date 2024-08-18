<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/registro_ticket.class.php');
require_once('../modelos/tickets.class.php');

$id_ticket = strip_tags($_POST['IDTICKET']);
$fecha = date("Y-m-d H:i:s");
$comentario = strip_tags($_POST['COMENTARIO']);
$id_usuario = $_SESSION['USUARIO'];
$estado = strip_tags($_POST['ESTADO']);

 $p= new RegistroTicket("",$id_ticket,$fecha,$comentario,$id_usuario);

 $s= new ticket($id_ticket,"","","","","","",$estado);

 $st = new ticket($id_ticket);

 $result=$p->guardarregistro();

 $tdatos = $st-> TicketDatosCorreo();

 $estado_original = strip_tags($tdatos[0]["estado"]);

 if ($estado !== "0") {
	if($estado !== $estado_original){
		$result=$s->cambiarestadoticket();
	}
 }

 

 if ($result){
 	header("Location: ../controladores/email/notificacion_actividad.php");
 	$_SESSION['IDTICKET'] = $id_ticket;
 	$_SESSION['FECHAACTIVIDAD'] = $fecha;
 	$_SESSION['COMENTARIO'] = $comentario;
 	$_SESSION['STATUS'] = $tdatos[0]["estnombre"];
	if($_SESSION['TIPOUSUARIO'] == 1){
		$_SESSION['REMITENTE'] = $tdatos[0]["nomcli"];
		$_SESSION['DESTINATARIO'] = $tdatos[0]["cortec"];
	}
	if($_SESSION['TIPOUSUARIO'] == 2){
		$_SESSION['REMITENTE'] = $tdatos[0]["nomtec"];
		$_SESSION['DESTINATARIO'] = $tdatos[0]["corcli"];
	}

 } else {
 	echo "<script>
 		alert('Hubo un error al guardar los datos de la solicitud');
 	</script>";
	var_dump("Hola");
 	if($_SESSION['TIPOUSUARIO'] == 1){
 		echo "<script>
 			window.location= '../vistas/inicio_cliente.php';
 		</script>";
 	}
 	if($_SESSION['TIPOUSUARIO'] == 2){
 		echo "<script>
 			window.location= '../vistas/detalle_ticket_tecnico.php?idTICKET=$id_ticket';
 		</script>";
 	}
 }

?>