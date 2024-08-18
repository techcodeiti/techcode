<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/tickets.class.php');
require_once('../modelos/solicitud.class.php');
require_once('../modelos/presupuesto.class.php');


$titulo = strip_tags($_POST['TITULO']);
$descripcion = strip_tags($_POST['DESCRIPCION']);
$fecha = date("Y-m-d H:i:s");
$usuario_cliente = $_SESSION['USUARIO'];
$usuario_tecnico = strip_tags($_POST['TECNICO']);
$id_solicitud = strip_tags($_POST['IDSOLICITUD']);
$estado = 1;
$fecha_solicitud = strip_tags($_POST['FECHASOLICITUD']);
$monto = strip_tags($_POST['MONTO']);
$subcategoria = strip_tags($_POST['SUBCATEGORIA']);
$idpresupuesto = strip_tags($_POST['IDPRESUPUESTO']);
$estado_solicitud = 2;
$aceptado = 1;
$declinado = 2;

//var_dump($subcategoria);

  $p= new ticket("",$titulo,$descripcion,$fecha,$usuario_cliente,$usuario_tecnico,$id_solicitud,$estado,$fecha_solicitud,$monto,$subcategoria);
  $s= new solicitud($id_solicitud,"","","","","",$estado_solicitud);
  $pre= new presupuesto($idpresupuesto,"",$id_solicitud,"","","",$aceptado);
  $pred= new presupuesto($idpresupuesto,"",$id_solicitud,"","","",$declinado);


  $result=$p->guardarticket();
  $result=$s->cambiarestadosolicitud();
  $result=$pre->cambiarestadopresupuestoaceptado();
  $resultdeclinadopre=$pred->cambiarestadopresupuestodeclinado();

  $s = new presupuesto($idpresupuesto,$usuario_tecnico,$id_solicitud);
  $sdatos=$s->PresupuestoDatosCorreo_OK();

  if($result){
    $gt = new ticket("","","","","","",$id_solicitud,"","","","");
    $getIdTicket=$gt->ObtenerIdTicket();
    header("Location: ../controladores/email/notificacion_solicitud_visita.php");
    $_SESSION['IDSOLICITUD'] = $id_solicitud;
    $_SESSION['FECHAACTIVIDAD'] = $fecha;
    $_SESSION['COMENTARIO'] = "Para comunicarle que su presupuesto ha sido aceptado y se genero el Ticket #" . $getIdTicket[0]["id"] . ". Acuerdese de contactarse con el cliente para avanzar en la tarea.";
    $_SESSION['REMITENTE'] = $sdatos[0]["nomcli"];
    $_SESSION['DESTINATARIO'] = $sdatos[0]["cortec"];
  } else {
    echo "<script>
      alert('Hubo un error al guardar los datos del ticket');
      window.location = '../vistas/inicio_cliente.php';
    </script>";
 

  }
  // if ($result) {

  // 	$mensaje="Se genera el ticket con exito";
  // }
  // else
  // {
  // 	$mensaje= "Hubo un error al guardar los datos del ticket";
  // }

  // echo "<script>
  // 	alert('$mensaje');
  // 	window.location= '../vistas/inicio_cliente.php';
  // </script>";


?>