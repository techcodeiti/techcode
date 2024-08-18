<?php
session_start();
?>
<?php
require_once('../modelos/registro_ticket.class.php');
if (empty($_SESSION['IDSOLICITUD'])) {
    $idsolicitud = strip_tags($_POST['IDSOLICITUD']);
    $_SESSION['IDSOLICITUD'] = $idsolicitud;
//} else {   
//    $idsolicitud = strip_tags($_SESSION['IDSOLICITUD']);
//    $_SESSION['IDSOLICITUD'] = $idsolicitud;
}

//if (empty($_SESSION['IDTICKET'])) {
    $idticket = strip_tags($_POST['IDTICKET']);
    $_SESSION['IDTICKET'] = $idticket;
//} //else {   
 //   $idticket = strip_tags($_SESSION['IDTICKET']);
 //   $_SESSION['IDTICKET'] = $idticket;
//}

if (empty($_SESSION['IDTECNICO'])) {
    $idusuariotecnico = strip_tags($_POST['IDTECNICO']);
    $_SESSION['IDTECNICO'] = $idusuariotecnico;
}// else {   
 //   $idusuariotecnico = strip_tags($_SESSION['IDTECNICO']);
 //   $_SESSION['IDTECNICO'] = $idusuariotecnico;
//}


$rt=new RegistroTicket("",$idticket);
$datort=$rt->ConsultarRegistroTicket();

?>

<?php require("cabezales/head.php"); ?>


<div class="contenidodeinteres">

<h2>Registro de Actividad</h2>

<!--<h1> tickdet <?php echo strip_tags($_POST['IDTICKET']) ?></h1> -->
<!--<h1> soli <?php echo strip_tags($_POST['IDSOLICITUD']) ?></h1> -->

    <div>
        <button id="BotonMenu" name="COMENTARTICKET" onclick="location.href='../vistas/comentar_actividad.php'">Comentar</button>
    </div>

    <div>
        &nbsp
    </div>
    <div>
        <button id="BotonMenu" name="FINALIZARTICKET" onclick= "location.href='../controladores/finalizar_actividad.controller.php'">Finalizar Solicitud</button>
    </div>

    <div>
        &nbsp
    </div>
    <div>
        <button id="BotonMenu" name="REPORTAR" onclick="location.href='../vistas/reportar.php'"">Reportar</button>
    </div>

    <div>
        &nbsp
    </div>

<table class="tftable" border="1">
            <tbody>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Comentario</th>
                </tr>
                <?php
					for($i=0; $i<count($datort);$i++){
                ?>
                <tr>
                    <td><?php echo $datort[$i]["fecha"]; ?></td>
                    <td><?php echo $datort[$i]["id_usuario"]; ?></td>
                    <td><?php echo $datort[$i]["comentario"]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
</table>


</div>