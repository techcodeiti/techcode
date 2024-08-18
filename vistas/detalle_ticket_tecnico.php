<?php
session_start();
?>

<?php
require_once('../modelos/tickets.class.php');
require_once('../modelos/usuarios.class.php');
require_once('../modelos/estados.class.php');
require_once('../modelos/registro_ticket.class.php');
$idTicket=$_GET["idTICKET"];
$t =new ticket($idTicket);
$datosST = $t->TicketTecnicoDetalle();
$datosS = $datosST[0];

$nus = new usuario($datosS["usuario_cliente"]);
$datosUSU = $nus ->ConsultarUsuario();
$resultadousu = $datosUSU[0];

$rt=new RegistroTicket("",$datosS["id"]);
$datort=$rt->ConsultarRegistroTicket();

?>



<?php require("cabezales/head.php"); ?>

<div class="contenidodeinteres">
    <h2>Ticket #<?php echo $datosS["id"]; ?></h2>

    <form method="post" action="../vistas/registrar_actividad.php">

    <label>Usuario: <?php echo $resultadousu["nombre_usuario"]; ?></label>
    <br>
    <label>Fecha: <?php echo date("d/m/Y",strtotime($datosS['fecha'])); ?></label>
    <br>
    <label>Título: <?php echo $datosS["titulo"]; ?></label>
    <br>
    <label>Descripción: </label>
    <textarea readonly rows="20" cols="100" ><?php echo $datosS["descripcion"]; ?></textarea>
    <label>Estado: <?php echo $datosS["nombre"]; ?></label>
    <input type="hidden" name="IDTICKET" value="<?php echo $datosS["id"]; ?>">

    <?php

    if($datosS["estado"] != 4){ 

        echo '<div>
            <button type="submit" name="MODIFICARTICKET" value="MODIFICARTICKET">Registrar Actividad</button>
        </div>';
    }
    ?>

    </form>

    <?php

    if($datosS["estado"] != 4){

        echo '<div>
            <button id="BotonMenu" name="SOLICITARVISITA" onclick="location.href=\'../vistas/solicitar_visita.php\'">Solicitar Visita</button>
        </div>';
    }    
    ?>

    

    <h2>Desarrollo de la Actividad</h2>
    
    
    
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