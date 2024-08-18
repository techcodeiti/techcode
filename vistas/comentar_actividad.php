<?php
session_start();
?>

<?php
$idticket = $_SESSION['IDTICKET'];
$estado = 0;
?>

<?php
require_once('../modelos/reclamos.class.php');
$ra = new Reclamo("","","","","","","","",$_SESSION['IDTICKET']);
$datosra = $ra->ReclamoAbierto();
?>

<?php require("cabezales/head.php"); ?>

<?php
if (isset($datosra[0]["aceptacion_reporte"])) {
    if ($datosra[0]["aceptacion_reporte"] == 0) {

        //var_dump($_SESSION['IDSOLICITUD']);
        //var_dump($_SESSION['IDTICKET']);
        //var_dump($_SESSION['IDTECNICO']);

        echo "<script>
	    alert('No puedes comentar sobre un ticket Reportado en Revisión. Por favor, espera a que se resuelva.');
	    window.location= '../vistas/verificar_actividad.php';
        </script>";
        
    }
} else {


?>


    <div class="contenidodeinteres">

    <h2>Ticket #<?php echo $idticket; ?></h2>

    <form method="post" action="../controladores/registrar_actividad.controller.php" name="signin-form">

        <div class="form-element">
            <label>Descripción</label>
            <p></p>
            <textarea name="COMENTARIO" placeholder="Ingrese su actividad..." rows="20" cols="100" maxlength="255" required></textarea>
        </div>
        <input type="hidden" name="IDTICKET" value="<?php echo $idticket; ?>">
        <input type="hidden" name="ESTADO" value="<?php echo $estado; ?>">
        <button type="submit" name="REGISTRARACTIVIDAD" value="REGISTRARACTIVIDAD">Registrar</button>
    </form>

    </div>

<?php
}
?>

<?php require("piepagina/foot.php"); ?>