<?php
session_start();
?>

<?php
require_once('../modelos/reclamos.class.php');

$idRec=$_GET["idREC"];

$r =new reclamo($idRec);
$datosRe = $r->ReclamoDetalle();
$datosR = $datosRe[0];
//var_dump($datosR["Id_reporte"]);

?>


<?php require("cabezales/head.php"); ?>

<h2>Solicitud #<?php echo $datosR["id_reporte"]; ?></h2>

<form method="post" action="../controladores/aceptar_reclamo.php">

    <label>Fecha: <?php echo date("d/m/Y",strtotime($datosR['fecha_reporte'])); ?></label>
    <br>
    <label>Reportado por: <?php echo $datosR["cliente"]; ?></label>
    <br>
    <label>Tecnico Responsable: <?php echo $datosR["tecnico"]; ?></label>
    <br>
    <label>Motivo: <?php echo $datosR["motivo"]; ?></label>
    <br>
    <label>Descripción: </label>
    <br>
    <textarea readonly rows="20" cols="100" ><?php echo $datosR["descripcion_reporte"]; ?></textarea>

    <input type="hidden" name="IDRECLAMO" value="<?php echo $datosR['id_reporte']; ?>">
    <input type="hidden" name="IDTECNICO" value="<?php echo $datosR['usuario_tecnico']; ?>">
    <button type="submit" name="ACEPTARRECLAMO" value="ACEPTARRECLAMO">Aceptar Reclamo</button>

</form>