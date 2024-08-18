<?php
session_start();
?>

<?php
    require_once('../modelos/usuarios.class.php');
    $p=new Usuario();
    $datosc=$p->UsuariosCliente();
    $datost=$p->UsuariosTecnicos();
    
?>

<?php require("cabezales/head.php"); ?>

<section id=inicio>

    <div class="modal-overlay" id="fondoSombreado"></div>

    <div class="contenidodeinteres">

        <h2>Clientes</h2>

        <table class="tftable" border="1">
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nombre Usuario</th>
                <th>Correo</th>
                <th>Fecha de Alta</th>
            </tr>
            <?php
					for($tc=0; $tc<count($datosc);$tc++){

			?>
            <tr>
                <td><?php echo $datosc[$tc]["id"]; ?></td>
                <td><?php echo $datosc[$tc]["nombre"]; ?></td>
                <td><?php echo $datosc[$tc]["apellido"]; ?></td>
                <td><?php echo $datosc[$tc]["nombre_usuario"]; ?></td>
                <td><?php echo $datosc[$tc]["correo"]; ?></td>
                <td><?php echo date("d/m/Y", strtotime("2023-05-01")); ?></td>
            </tr>
            <?php } ?>
        </table>

        <h2>Técnicos</h2>

        <table class="tftable" border="1">
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nombre Usuario</th>
                <th>Correo</th>
                <th>Fecha de Alta</th>
                <th>Amonestaciones</th>
                <th></th>
            </tr>
            <?php
					for($tt=0; $tt<count($datost);$tt++){

			?>
            <tr>
                <td><?php echo $datost[$tt]["id"]; ?></td>
                <td><?php echo $datost[$tt]["nombre"]; ?></td>
                <td><?php echo $datost[$tt]["apellido"]; ?></td>
                <td><?php echo $datost[$tt]["nombre_usuario"]; ?></td>
                <td><?php echo $datost[$tt]["correo"]; ?></td>
                <td><?php echo date("d/m/Y", strtotime("2023-05-01")); ?></td>
                <td><?php echo $datost[$tt]["cantamonestacion"]; ?>/3</td>
                <td>
                    <?php if ($datost[$tt]["suspender"] == 1){ ?>
                            <button onclick="mostrarVentanaSuspension(this)" id="BotonTabla" name="SUSPENDER" data-idtecnico="<?php echo $datost[$tt]["id"]; ?>">Suspender</button>
                            <div id="ventanaEmergente">
                                <div id="contenidoVentana">
                                    <form method="post" action="../controladores/suspender.controller.php">
                                        <label for="COMENTARIO">Comentario:</label>
                                        <textarea name="COMENTARIO" placeholder="Ingrese su comentario..." rows="20" cols="50" maxlength="100" required></textarea>
                                        <br>
                                        <label>Fecha Reanudación:</label>
                                        <input type="date" name="FECHA" min="<?php echo date('Y-m-d'); ?>"  required />
                                        <br>
                                        <br>
                                        <input type="hidden" name="IDTECNICOPOPUP" value="">
                                        <button type="submit" name="SUSPENDERUSUARIO" value ="SUSPENDERUSUARIO">Confirmar</button>
                                    </form>
                                    <button onclick="cerrarVentanaSuspension()">Cerrar</button>
                                </div>
                            </div>
                    <?php
                          }
                    ?>
                </td>
               
            </tr>
            <?php } ?>
        </table>

    </div>

</section>

<?php require("piepagina/foot.php"); ?>