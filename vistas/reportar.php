<?php
session_start();
?>

<?php
require_once('../modelos/reclamos.class.php');
$ra = new Reclamo("","","","","","",$_SESSION['USUARIO'],"",$_SESSION['IDTICKET']);
$datosra = $ra->aceptacionReclamo();

require_once('../modelos/motivos.class.php');

$rm=new motivoreporte();
$datorm=$rm->consultarMotivoReporte();

?>

<?php require("cabezales/head.php"); ?>

<?php
if (isset($datosra[0]["aceptacion_reporte"])) {
    if ($datosra[0]["aceptacion_reporte"] == 0) {

        //var_dump($_SESSION['IDSOLICITUD']);
        //var_dump($_SESSION['IDTICKET']);
        //var_dump($_SESSION['IDTECNICO']);

        echo "<script>
	    alert('Ya tienes un reclamo abierto sobre este Ticket. Por favor, espera a que se resuelva.');
	    window.location= '../vistas/verificar_actividad.php';
        </script>";
        
    }
} else {


         var_dump($_SESSION['IDSOLICITUD']);
         var_dump($_SESSION['IDTICKET']);
         var_dump($_SESSION['IDTECNICO']);


?>


    <div class="contenidodeinteres">

        <h2>Seleccione el Motivo:</h2>

        <form method="post" action="../controladores/procesar_reporte.php" name = "signin-form">
            
            <?php
                for($i=0; $i<count($datorm);$i++){
            ?>
            <div class="form-element">
                <input type="radio" id="<?php echo $datorm[$i]["id"]; ?>" name="tipo_reporte" value="<?php echo $datorm[$i]["id"]; ?>">
                <label for="<?php echo $datorm[$i]["id"]; ?>"><?php echo $datorm[$i]["nombre"]; ?></label><br>
            </div>
            
            <?php } ?>

            <div class="form-element">
                <label for="detalles">Detalles:</label>
                <textarea name="detalles" id="detalles" rows="20" cols="100" disabled required></textarea>
            </div>

            <button type="submit" name="REPORTAR" value="REPORTAR">Reportar</button>
        
        </form>



    </div>

    <script>
        const tipoReporte = document.getElementsByName('tipo_reporte');
        const detallesTextarea = document.getElementById('detalles');

    // Función para habilitar o deshabilitar el textarea de detalles según la selección
        function toggleDetallesTextarea() {
            if (this.value === '1') { //Cuando el valor es 1 (El nombre de valor es 'Otro') se habilitara el cuadro de texto.
                detallesTextarea.disabled = false;
            } else {
                detallesTextarea.disabled = true;
            }
        }

    // Asignar el evento change a todos los input de tipo radio de tipo_reporte
        for (let i = 0; i < tipoReporte.length; i++) {
            tipoReporte[i].addEventListener('change', toggleDetallesTextarea);
        }

    </script>

<?php
}
?>

<?php require("piepagina/foot.php"); ?>