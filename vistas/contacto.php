<?php
session_start();
?>

<?php require("cabezales/head.php"); ?>

<div class="contenidodeinteres">
    <form method="post" action="../controladores/email/enviar_correo_contacto.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="NOMBRE" required>
        <br><br>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="EMAIL" required>
        <br><br>

        <label for="subject">Asunto:</label>
        <input type="text" name="SUBJECT" required>
        <br><br>

        <label for="mensaje">Mensaje:</label>
        <textarea name="MENSAJE" rows="4" required></textarea>
        <br><br>
        
        <button type="submit" name="ENVIAR" value="ENVIAR">ENVIAR</button>
    </form>
</div>

<?php require("piepagina/foot.php"); ?>