<?php
date_default_timezone_set('America/Montevideo');
session_start();
require_once('../modelos/solicitud.class.php');

$titulo = strip_tags($_POST['TITULO']);
$descripcion = strip_tags($_POST['DESCRIPCION']);
$requiere_visita = strip_tags($_POST['REQUIERE_VISITA']);
$fecha = date("Y-m-d H:i:s");
$usuario_cliente = $_SESSION['USUARIO'];
$estado = 1;

$p= new solicitud("",$titulo,$descripcion,$fecha,$usuario_cliente,$requiere_visita,$estado);

$result=$p->guardarsolicitud();

if ($result) {
	
	$mensaje="Se ingreso la solicitud con exito";
}
else
{
	$mensaje= "Hubo un error al guardar los datos de la solicitud";
}

echo "<script>
	alert('$mensaje');
	window.location= '../vistas/inicio_cliente.php';
</script>";


?>