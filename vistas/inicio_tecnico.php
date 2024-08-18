<?php
session_start();

?>

<?php
    require_once('../modelos/tickets.class.php');
    require_once('../modelos/solicitud.class.php');
    require_once('../modelos/visitas.class.php');
    $p=new solicitud();
    $datoss=$p->TodasSolicitudesPendientes();

    $sv=new Visita("","",$_SESSION['USUARIO']);
    $datossv=$sv->TodasSolicitudesPendientesConfirmacionVisita();

    $r=new ticket("","","","","",$_SESSION['USUARIO']);
    $datosr=$r->ConsultarTicketsResueltoTecnico();

    $t=new ticket("","","","","",$_SESSION['USUARIO']);
    $datost=$t->ConsultarTicketsenDesarrolloTecnico();
    
?>

<?php require("cabezales/head.php"); ?>

<section id=inicio>

    <div class="contenidodeinteres">
        <h2>Hola <?php echo $_SESSION['NOMBREUSUARIO']; ?></h2>
  
        
        <div>
            <button id="BotonMenu" name="SOLICITUDES">Solicitudes</button>
        </div>
            <br>
        <div>
            <button id="BotonMenu" name="TICKETS">Tickets</button>
        </div>

        <h2>Tickets Resueltos</h2>
        
        <table class="tftable" border="1">
            <tr>
                <th># Ticket</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            <?php
					for($ti=0; $ti<count($datosr);$ti++){

			?>
            <tr>
                <td><?php echo $datosr[$ti]["id"]; ?></td>
                <td><?php echo $datosr[$ti]["titulo"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datosr[$ti]['fecha'])); ?></td>
                <td><button id="BotonTabla" name="VERDETALLE" onclick="location.href='../vistas/detalle_ticket_tecnico.php?idTICKET=<?php echo $datosr[$ti]["id"]; ?>'">Más Detalle</button></td>
            </tr>
            <?php } ?>
        </table>


        <h2>Tickets en Desarrollo</h2>
        
        <table class="tftable" border="1">
            <tr>
                <th># Ticket</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            <?php
					for($ti=0; $ti<count($datost);$ti++){

			?>
            <tr>
                <td><?php echo $datost[$ti]["id"]; ?></td>
                <td><?php echo $datost[$ti]["titulo"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datost[$ti]['fecha'])); ?></td>
                <td><button id="BotonTabla" name="VERDETALLE" onclick="location.href='../vistas/detalle_ticket_tecnico.php?idTICKET=<?php echo $datost[$ti]["id"]; ?>'">Más Detalle</button></td>
            </tr>
            <?php } ?>
        </table>


        <h2>Solicitudes Pendientes de Confirmación de Visita</h2>
        
        <table class="tftable" border="1">
            <tr>
                <th># Solicitud</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th>Confirmada</th>
                <th></th>
            </tr>
            <?php
					for($i=0; $i<count($datossv);$i++){

			?>
            <tr>
                <td><?php echo $datossv[$i]["id"]; ?></td>
                <td><?php echo $datossv[$i]["titulo"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datossv[$i]['fecha'])); ?></td>
                <td><?php echo $datossv[$i]["confirmacion"]; ?></td>
                <td><button id="BotonTabla" name="VERDETALLE" onclick="location.href='../vistas/detalle_solicitud_tecnico.php?idSOL=<?php echo $datossv[$i]["id"]; ?>'">Más Detalle</button></td>
            </tr>
            <?php } ?>
        </table>

        
        <h2>Solicitudes Disponibles</h2>
        
        <table class="tftable" border="1">
            <tr>
                <th># Solicitud</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            <?php
					for($i=0; $i<count($datoss);$i++){

			?>
            <tr>
                <td><?php echo $datoss[$i]["id"]; ?></td>
                <td><?php echo $datoss[$i]["titulo"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datoss[$i]['fecha'])); ?></td>
                <td><button id="BotonTabla" name="VERDETALLE" onclick="location.href='../vistas/detalle_solicitud_tecnico.php?idSOL=<?php echo $datoss[$i]["id"]; ?>'">Más Detalle</button></td>
            </tr>
            <?php } ?>
        </table>

        <div>
            <br>
        </div>
        <div>
            <button id="BotonMenu" name="HISTORIAL">Historico de Solicitudes Realizadas</button>
        </div>

    </div>
    

</section>

<?php require("piepagina/foot.php"); ?>