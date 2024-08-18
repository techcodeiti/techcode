<?php
session_start();

$idticket = strip_tags($_POST['IDTICKET']);

?>

<?php require("cabezales/head.php"); ?>

<div class="contenidodeinteres">

<h2>Ticket #<?php echo $idticket; ?></h2>

<form method="post" action="../controladores/registrar_actividad.controller.php" name="signin-form">

    <div class="form-element">
        <label>Estado</label>
        <select class="form-control"  name="ESTADO" required>
                <option value="">Estado</option>
                        <option value=1>En Desarrollo</option>
                        <option value=2>Detenido</option>
                        <option value=3>Resuelto</option>

        </select>
    </div>
    <div class="form-element">
        <label>Descripción</label>
        <p></p>
        <textarea name="COMENTARIO" placeholder="Ingrese su actividad..." rows="20" cols="100" maxlength="255" required></textarea>
    </div>
    <input type="hidden" name="IDTICKET" value="<?php echo $idticket; ?>">
    <button type="submit" name="REGISTRARACTIVIDAD" value="REGISTRARACTIVIDAD">Registrar</button>
</form>

</div>

<?php require("piepagina/foot.php"); ?>