<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/usuarios.class.php');
require_once('../modelos/solicitud.class.php');
require_once('../modelos/tickets.class.php');
require_once('../modelos/reclamos.class.php');



$ra = new Reclamo("","","","","","","","",$_SESSION['IDTICKET']);

$datosra = $ra->ReclamoAbierto();

if (isset($datosra[0]["aceptacion_reporte"])) {
	if ($datosra[0]["aceptacion_reporte"] == 0) {

		echo "<script>
	    alert('No puedes dar como finalizada la solicitud debido a que tienes un reclamo abierto.');
	    window.location= '../vistas/verificar_actividad.php';
        </script>";
	}
} else {

	$id_solicitud = strip_tags($_SESSION['IDSOLICITUD']);
	$id_ticket = strip_tags($_SESSION['IDTICKET']);
	$fecha = date("Y-m-d H:i:s");
	$estado_solicitud = 3;
	$estado = 4;

	


	 $p= new ticket($id_ticket,"","","","","","",$estado);
	 $s= new solicitud($id_solicitud,"","","","","",$estado_solicitud);

	 $st = new ticket($id_ticket);

	 $tdatos = $st-> TicketDatosCorreo();

	 $result=$p->cambiarestadoticket();
	 $result=$s->cambiarestadosolicitud(); 

	if($result){
		header("Location: ../controladores/email/notificacion_actividad.php");
		$_SESSION['IDTICKET'] = $id_ticket;
		$_SESSION['FECHAACTIVIDAD'] = $fecha;
		$_SESSION['COMENTARIO'] = "Se ha cerrado el Ticket #". $id_ticket . " por parte de ". $tdatos[0]["nomcli"] .".";
		$_SESSION['STATUS'] = "Cerrado";
		$_SESSION['REMITENTE'] = $tdatos[0]["nomcli"];
		$_SESSION['DESTINATARIO'] = $tdatos[0]["cortec"];
	} else {
		echo "<script>
			alert('Hubo un error al guardar los datos de la solicitud');
			window.location = '../vistas/inicio_cliente.php';
		</script>";
	}

}

?>