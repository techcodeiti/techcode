<?php require("cabezales/head.php"); ?>


<img id="fotologin" src="vistas/cabezales/logo.JPG" alt="logo" width="200" height="200">
<form method="post" action="../TechCode/controladores/login.controller.php" name="signin-form">
    <div class="form-element">
        <label>Usuario</label>
        <input type="text" name="USERNAME" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="PASSWORD" required />
    </div>
    <button type="submit" name="LOGIN" value="LOGIN">Iniciar Sesión</button>
</form>

<form action="../TechCode/vistas/register.php">
    <div class="form-element" >
    <label id = "RegistroLabel">Aun no te has registrado??</label>
    </div>
   <div class="form-element">
   <button type="submit" id=RegistroBoton>Registrarse</button>
   </div>
</form>


</body>
</html>