<?php
session_start();

?>

<?php require("cabezales/head.php"); ?>

<form method="post" action="../controladores/solicitud.controller.php" name="signin-form">
    <div class="form-element">
        <label>Id Cliente: <?php echo $_SESSION['USUARIO']; ?></label>
    </div>
    <div class="form-element">
        <label>Titulo</label>
        <input type="text" name="TITULO" required />
    </div>
    <div class="form-element">
        <label>Descripción</label>
        <p></p>
        <textarea name="DESCRIPCION" placeholder="Ingrese su descripción..." rows="20" cols="100" maxlength="255" required></textarea>
        <input type="hidden" name="REQUIERE_VISITA" value=0>
        <input type="checkbox" id="requiere_visita" name="REQUIERE_VISITA" value=1>
        <label for="requiere_visita">Requiere Visita</label>
    </div>
    <button type="submit" name="CREARSOLICITUD" value="CREARSOLICITUD">Crear Solicitud</button>
</form>

<?php require("piepagina/foot.php"); ?>