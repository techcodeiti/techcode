<?php
session_start();
?>

<?php
require_once('../modelos/solicitud.class.php');
require_once('../modelos/estados.class.php');
require_once('../modelos/presupuesto.class.php');
require_once('../modelos/visitas.class.php');
require_once('../modelos/tickets.class.php');
$idSol=$_GET["idSOL"];
$idCli=$_SESSION['USUARIO'];

$s =new solicitud($idSol,"","","",$idCli);
$datosST = $s->SolicitudClienteDetalle();
$datosS = $datosST[0];

$es = new estadosolicitud($datosS["estado"]);
$datoses=$es->consultarEstadoSolicitud();
$resultadoes = $datoses[0];


$vi = new Visita("",$idSol);
$datosV=$vi->ConsultarVisitas();

$pr=new presupuesto("","",$idSol);
$datosP=$pr->ConsultarPresupuestosSolicitudes();

$ti = new ticket("","","","","","",$idSol);
$datosti = $ti->VerificarSolicitudTicket();
$verificarticket = $datosti[0];
$verif = $verificarticket['verif_ticket'];

$datosticket = $ti->SolicitudTicket();
if ($datosticket){
$irticket = $datosticket[0];
} else {
    
}

?>


<?php require("cabezales/head.php"); ?>

<div class="modal-overlay" id="fondoSombreado"></div>

<div class="contenidodeinteres">

    <h2>Solicitud #<?php echo $datosS["id"]; ?></h2>

    <form method="post" action="../vistas/verificar_actividad.php">

        <label>Fecha: <?php echo date("d/m/Y",strtotime($datosS['fecha'])); ?></label>
        <br>
        <label>Título: <?php echo $datosS["titulo"]; ?></label>
        <br>
        <label>Descripción: </label>
        <br>
        <textarea readonly rows="20" cols="100" ><?php echo $datosS["descripcion"]; ?></textarea>
        <br>
        <label>Estado: <?php echo $resultadoes["nombre"]; ?></label>
        <br>
        <input type="checkbox" id="requiere_visita" name="REQUIERE_VISITA" <?php if($datosS["requierevisita"] == 1)
                                                                                    {?> checked <?php
                                                                                    }?> disabled>
        <label for="requiere_visita">Requiere Visita</label>
    
    
        <?php
    
        if ($verif == 1) {
        ?>
        <input type="hidden" name="IDTICKET" value="<?php echo $irticket['id']; ?>">
        <input type="hidden" name="IDTECNICO" value="<?php echo $irticket['usuario_tecnico']; ?>">
        <input type="hidden" name="IDSOLICITUD" value="<?php echo $datosS['id']; ?>">
        <button type="submit" name="VERTICKET" value="VERTICKET">Ir al Ticket</button>
        <?php
        }
        ?>
    </form>

    <h2>Solicitudes de Visitas:</h2>

    <table class="tftable" border="1">
        <tr>
            <th>Técnico</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th></th>
        </tr>
        <?php
        if (empty($datosV)) {
        ?>
        <tr>
            <td colspan="4" style="text-align:center">Aun no han solicitado visitas!</td>
        </tr>
        <?php
        } else {
			for($i=0; $i<count($datosV);$i++){
		?>
        <tr>
            <td><?php echo $datosV[$i]["nombre_usuario"]; ?></td>
            <td><?php echo date("d/m/Y",strtotime($datosV[$i]["fecha_visita"])); ?></td>
            <td><?php echo date("H:i",strtotime($datosV[$i]["fecha_visita"])); ?></td>
            <td><button onclick="mostrarVentanaEmergente(this)" id="BotonTabla" name="ACEPTARPRESUPUESTO" data-idvisita="<?php echo $datosV[$i]["id"]; ?>" data-idsolicitud="<?php echo $datosV[$i]["idsolicitud"]; ?>">Coordinar Visita</button>
            <div id="ventanaEmergente">
                    <div id="contenidoVentana">
                        <form method="post" action="../controladores/aceptar_visita.controller.php">
                            <label>Fecha: </label>
                            <input type="date" name="FECHA" min="<?php echo date('Y-m-d'); ?>"  required />
                            <br>
                            <br>
                            <label>Hora:</label>
                            <select class = "form-control" id="hora" name="HORA" required>
                                <?php
                                for($h = 9; $h <= 20; $h ++){
                                    $formatHour = str_pad($h, 2, '0', STR_PAD_LEFT);
                                ?>
                                <option value="<?php echo $formatHour ?>"><?php echo $formatHour ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select class = "form-control" id="hora" name="MINUTOS" required>
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                            <br>
                            <br>
                            <input type="hidden" name="IDVISITAPOPUP" value="">
                            <input type="hidden" name="IDSOLICITUDPOPUP" value="">
                            <button type="submit" name="ACEPTARVISITA" value ="ACEPTARVISITA">Confirmar</button>
                        </form>
                        <br>
                        <br>
                        <button onclick="cerrarVentanaEmergente()">Cerrar</button>
                    </div>
            </div>
            </td>
        </tr>
        <?php }} ?>
            
    </table>

    <h2>Presupuestos:</h2>
    <table class="tftable" border="1">
        <tr>
            <th>Técnico</th>
            <th>Motivo</th>
            <th>Total</th>
            <th></th>
        </tr>
        <?php
        if (empty($datosP)) {
        ?>
        <tr>
            <td colspan="4" style="text-align:center">Aun no han presupuestado</td>
        </tr>
        <?php
        } else {
        for ($i = 0; $i < count($datosP); $i++) {
        ?>
        <tr>
            <form method="post" action="../controladores/ticket.controller.php">
                <td><?php echo $datosP[$i]["usuario_tecnico"]; ?></td>
                <td><?php echo $datosP[$i]["descripcion"]; ?></td>
                <td><?php echo $datosP[$i]["monto"]; ?></td>
                <td style="display:none;"><input type="hidden" name="TECNICO" value="<?php echo $datosP[$i]["usuario_tecnico"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="DESCRIPCION" value="<?php echo $datosS["descripcion"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="TITULO" value="<?php echo $datosS["titulo"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="IDSOLICITUD" value="<?php echo $datosP[$i]["id_solicitud"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="FECHASOLICITUD" value="<?php echo $datosS["fecha"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="MONTO" value="<?php echo $datosP[$i]["monto"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="SUBCATEGORIA" value="<?php echo $datosP[$i]["id_subcategoria"]; ?>"></td>
                <td style="display:none;"><input type="hidden" name="IDPRESUPUESTO" value="<?php echo $datosP[$i]["id"]; ?>"></td>
                <td><button id="BotonTabla" name="ACEPTARPRESUPUESTO">Aceptar</button></td>
            </form>
        </tr>
        <?php } } ?>    
    </table>

    <form method="post" action="../controladores/eliminar_solicitud.controller.php" name="signin-form">
        <input type="hidden" name="IDSOLICITUD" value="<?php echo $datosS["id"]; ?>">
        <button type="submit" style="background:orangered;" name="ELIMINARSOLICITUD" value="ELIMINARSOLICITUD">Eliminar Solicitud</button>
    </form>

</div>

<?php require("piepagina/foot.php"); ?>