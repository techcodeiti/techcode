<?php
session_start();

?>

<?php

    require_once('../modelos/reclamos.class.php');
    $r = new Reclamo();
    $datosra = $r->VerReclamosAbiertos();
    $datosrc = $r->VerReclamosCerrados();

?>

<?php require("cabezales/head.php"); ?>

<section id=inicio>

    <div class="contenidodeinteres">

        <h2>Hola <?php echo $_SESSION['NOMBREUSUARIO']; ?></h2>

        <h2>Reclamos Abiertos</h2>

        <table class="tftable" border="1">
            <tr>
                <th># Reclamo</th>
                <th># Ticket</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            <?php
					for($i=0; $i<count($datosra);$i++){

			?>
            <tr>
                <td><?php echo $datosra[$i]["id_reporte"]; ?></td>
                <td><?php echo $datosra[$i]["id_ticket"]; ?></td>
                <td><?php echo $datosra[$i]["descripcion_reporte"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datosra[$i]['fecha_reporte'])); ?></td>
                <td><button id="BotonTabla" name="VERDETALLE" onclick="location.href='../vistas/detalle_reclamo_moderador.php?idREC=<?php echo $datosra[$i]["id_reporte"]; ?>'">Más Detalle</button></td>
            </tr>
            <?php } ?>
        </table>
        
        <h2>Reclamos Cerrados (Ultimos 5)</h2>

        <table class="tftable" border="1">
            <tr>
                <th># Reclamo</th>
                <th># Ticket</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
            <?php
					for($i=0; $i<count($datosrc);$i++){

			?>
            <tr>
                <td><?php echo $datosrc[$i]["id_reporte"]; ?></td>
                <td><?php echo $datosrc[$i]["id_ticket"]; ?></td>
                <td><?php echo $datosrc[$i]["descripcion_reporte"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datosrc[$i]['fecha_reporte'])); ?></td>
            </tr>
            <?php } ?>
        </table>
        
        <div>
            &nbsp
        </div>
        
        <div>
            <button id="BotonMenu" name="HISTORIALRECLAMOS">Ver Mas Reclamos</button>
        </div>

    </div>

</section>

<?php require("piepagina/foot.php"); ?>