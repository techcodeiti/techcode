<?php
session_start();
require_once('../modelos/presupuesto.class.php');
require_once('../modelos/solicitud.class.php');
require_once('../modelos/visitas.class.php');

$id_solicitud = strip_tags($_POST['IDSOLICITUD']);

$p= new presupuesto("","",$id_solicitud);
$v= new Visita("",$id_solicitud);

$vp=$p->VerificarSolicitudconPresupuesto();
$verificarpresupuesto = $vp[0];

$vv=$v->VerificarSolicitudconVisita();
$verificarvisita = $vv[0];

if($verificarvisita['verif_sol'] == 0){
    $verif = $verificarpresupuesto['verif_sol'];
}
else
{
    $verif = $verificarvisita['verif_sol'];
}



if ($verif == 1) {
	
	$mensaje="No se puede eliminar una solicitud que ya tiene al menos un presupuesto";

    echo "<script>
	alert('$mensaje');
	window.location= '../vistas/detalle_solicitud_cliente.php?idSOL=$id_solicitud';
    </script>";
}
else
{
	$mensaje= "Se eliminara la solicitud.";

    $s = new solicitud($id_solicitud);
    $result = $s->EliminarSolicitud();

    if ($result) {
	
        $mensaje="Se elimino correctamente la solicitud";
    }
    else
    {
        $mensaje= "Hubo un error al eliminar la solicitud";
    }
    
    echo "<script>
        alert('$mensaje');
        window.location= '../vistas/inicio_cliente.php';
    </script>";

}



?>