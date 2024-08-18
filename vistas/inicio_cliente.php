<?php
session_start();

?>

<?php
    require_once('../modelos/solicitud.class.php');
    require_once('../modelos/estados.class.php');
    $p=new solicitud("","","","",$_SESSION['USUARIO']);
    $datoss=$p->ConsultarSolicitudesPendientes();

    
    
?>

<?php require("cabezales/head.php"); ?>

<section id=inicio>

    <div class="contenidodeinteres">
        <h2>Hola <?php echo $_SESSION['NOMBREUSUARIO']; ?></h2>
        
        <div>
            <button id="BotonMenu" name="IRSOLICITUD" onclick="location.href='../vistas/crear_solicitud.php'">Crear Solicitud</button>
        </div>
        
        <h2>Solicitudes Realizadas</h2>
        
        <table class="tftable" border="1">
            <tr>
                <th>Nro Solicitud</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th></th>
            </tr>
            <?php
					for($i=0; $i<count($datoss);$i++){

                        $es = new estadosolicitud($datoss[$i]["estado"]);
                        $datoses=$es->consultarEstadoSolicitud();
                        $resultadoes = $datoses[0];

			?>
            <tr>
                <td><?php echo $datoss[$i]["id"]; ?></td>
                <td><?php echo $datoss[$i]["titulo"]; ?></td>
                <td><?php echo date("d/m/Y",strtotime($datoss[$i]['fecha'])); ?></td>
                <td><?php echo $resultadoes["nombre"]; ?></td>
                <td><button id="BotonTabla" name="VERDETALLE" onclick="location.href='../vistas/detalle_solicitud_cliente.php?idSOL=<?php echo $datoss[$i]["id"]; ?>'">Más Detalle</button></td>
            </tr>
            <?php } ?>
        </table>


    </div>
</section>

<?php require("piepagina/foot.php"); ?>