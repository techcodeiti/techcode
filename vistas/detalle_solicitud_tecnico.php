<?php
session_start();
?>

<?php
require_once('../modelos/solicitud.class.php');
require_once('../modelos/usuarios.class.php');
require_once('../modelos/estados.class.php');
require_once('../modelos/visitas.class.php');
require_once('../modelos/subcategorias.class.php');
$idSol=$_GET["idSOL"];
$idTec = $_SESSION['USUARIO'];
$s =new solicitud($idSol);
$datosST = $s->SolicitudTecnicoDetalle();
$datosS = $datosST[0];

$es = new estadosolicitud($datosS["estado"]);
$datoses=$es->consultarEstadoSolicitud();
$resultadoes = $datoses[0];

$sv=new Visita("",$idSol,$idTec);
$datossv=$sv->ConsultarVisitasxTecnico();
$resultadosv = [];

if (isset($datossv[0])) {
    $resultadosv = $datossv[0];
}

if (isset($resultadosv["usuario_tecnico"])) {
    $sv_usuario_tecnico = $resultadosv["usuario_tecnico"];
    $sv_visita_aceptada = $resultadosv["visita_aceptada"];
} else {
    $sv_usuario_tecnico = null;
    $sv_visita_aceptada = 0;
}

$nus = new usuario($datosS["usuario_cliente"]);
$datosUSU = $nus ->ConsultarUsuario();
$resultadousu = $datosUSU[0];
?>


<?php require("cabezales/head.php"); ?>

<h2>Solicitud #<?php echo $datosS["id"]; ?></h2>

<form action="">

    <label>Usuario: <?php echo $resultadousu["nombre_usuario"]; ?></label>
    <br>
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

</form>

<?php
    if($datosS["requierevisita"] == 1) {
        if($idTec == $sv_usuario_tecnico){
            ?>
            <form action="">
                <label style="text-align:center;">Ya has solicitado una visita, aguarde que se confirme</label>
            </form>
            <?php
        } if($sv_visita_aceptada == 1){
            ?>
        <form method="post" action="../controladores/presupuesto.controller.php" name="signin-form">
        <div class="form-element">
                <input type="hidden" name="IDSOLICITUD" value="<?php echo $datosS["id"]; ?>">
                <label>Descripción</label>
                <p></p>
                <textarea name="DESCRIPCION" placeholder="Ingrese su descripción..." rows="20" cols="100" maxlength="255" required></textarea>
                <label for="SUBCATEGORIA">Motivo</label>
                <?php   
                    $sc = new MotivoSubcategoria();
                    $datos_sc=$sc->consultarSubCategoria();
                    $subCategoria=count($datos_sc);
                ?>
                <select class="form-control" id="SUBCATEGORIA" name="SUBCATEGORIA" required>
                    <option value=""></option>
                    <?php
                    usort($datos_sc, function($a, $b){
                        return strcasecmp($a["id_categoria"], $b["id_categoria"]);
                    });

                    $categoria_actual = null;

                    foreach ($datos_sc as $subcategorias){
                        $categoria = $subcategorias["descripcion"];
                        
                        if ($categoria != $categoria_actual){
                            if ($categoria_actual !== null){
                                echo '</optgroup>';
                            }
                            echo '<optgroup label = "' . $categoria .'">';
                            $categoria_actual = $categoria;
                        }

                        echo '<option value = "' . $subcategorias["id"] . '">' .$subcategorias["descripcionsc"] . '</option>';
                    }
                        if ($categoria_actual !== null){
                            echo '</optgroup>';
                        }
                ?>
                </select>
        </div>
            <div class="form-element">
                <label>Monto</label>
                <input type="number" name="MONTO" pattern="^\d*(\.\d{0,2})?$" required />
            </div>
            <button type="submit" name="PRESUPUESTAR" value="PRESUPUESTAR">Presupuestar</button>
        </form>
            <?php
        } else {
            ?>
            <form method="post" action="../controladores/solicitar_visita.controller.php" name="signin-form">
                <input type="hidden" name="USUARIOCLIENTE" value="<?php echo $datosS["usuario_cliente"]; ?>">
                <input type="hidden" name="IDSOLICITUD" value="<?php echo $datosS["id"]; ?>">
                <button type="submit" style="background: blue;" name="SOLICITAVISITA" value="SOLICITARVISITA">Solicitar Visita</button>
            </form>
            <?php
        }
    }
    ?>

<?php
    if($datosS["requierevisita"] == 0) {
    ?>
        <form method="post" action="../controladores/presupuesto.controller.php" name="signin-form">
        <div class="form-element">
                <input type="hidden" name="IDSOLICITUD" value="<?php echo $datosS["id"]; ?>">
                <label>Descripción</label>
                <p></p>
                <textarea name="DESCRIPCION" placeholder="Ingrese su descripción..." rows="20" cols="100" maxlength="255" required></textarea>
                <label for="SUBCATEGORIA">Motivo</label>
                <?php   
                    $sc = new MotivoSubcategoria();
                    $datos_sc=$sc->consultarSubCategoria();
                    $subCategoria=count($datos_sc);
                ?>
                <select class="form-control" id="SUBCATEGORIA" name="SUBCATEGORIA" required>
                    <option value=""></option>
                    <?php
                    usort($datos_sc, function($a, $b){
                        return strcasecmp($a["id_categoria"], $b["id_categoria"]);
                    });

                    $categoria_actual = null;

                    foreach ($datos_sc as $subcategorias){
                        $categoria = $subcategorias["descripcion"];
                        
                        if ($categoria != $categoria_actual){
                            if ($categoria_actual !== null){
                                echo '</optgroup>';
                            }
                            echo '<optgroup label = "' . $categoria .'">';
                            $categoria_actual = $categoria;
                        }

                        echo '<option value = "' . $subcategorias["id"] . '">' .$subcategorias["descripcionsc"] . '</option>';
                    }
                        if ($categoria_actual !== null){
                            echo '</optgroup>';
                        }
                ?>
                </select>
            </div>
            <div class="form-element">
                <label>Monto</label>
                <input type="number" name="MONTO" pattern="^\d*(\.\d{0,2})?$" required />
            </div>
            <button type="submit" name="PRESUPUESTAR" value="PRESUPUESTAR">Presupuestar</button>
        </form>
    <?php
    }
?>

<?php require("piepagina/foot.php"); ?>