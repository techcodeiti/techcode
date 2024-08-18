<?php
require_once('../modelos/departamento.class.php'); 
?>

<?php
require_once('../modelos/listausuario.class.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <title>TechCode</title>
</head>
<body>

<section id=inicio>
    <div class="contenidodeinteres">

        <form method="post" action="../controladores/registro.controller.php" name="signup-form">
        <div class="form-element">
            <label>Tipo Usuario</label>
            <?php   
                $tu = new tipousuario();
                $datos_tu=$tu->consultarTipoUsuario();
                $cuentatu=count($datos_tu);
            ?>
            <select class="form-control"  name="TIPOUSUARIO" required>
                <option value="">Seleccion Tipo de Usuario</option>
                <?php
                    for ($j=0;$j<$cuentatu;$j++)
                    {
                    ?>
                        <option value="<?php echo $datos_tu[$j][0]?>"><?php echo $datos_tu[$j][1]?></option>
                    <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-element">
            <label>Nombre</label>
            <input type="text" name="NOMBRE" required />
        </div>
        <div class="form-element">
            <label>Apellido</label>
            <input type="text" name="APELLIDO" required />
        </div>
        <div class="form-element">
            <label>Nombre Usuario</label>
            <input type="text" name="USERNAME" pattern="[a-zA-Z0-9]+" required />
        </div>
        <div class="form-element">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="FECHANAC" value="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="form-element">
            <label>Email</label>
            <input type="email" name="CORREO" required />
        </div>
        <div class="form-element">
            <label>Password</label>
            <input type="password" name="PASSWORD" required />
        </div>
        <div class="form-element">
            <label>Telefono</label>
            <input type="number" name="TELEFONO"/>
        </div>
        <div class="form-element">
            <label>Direccion</label>
            <input type="text" name="DIRECCION" required />
        </div>
        <div class="form-element">
            <label>Ciudad/Localidad</label>
            <input type="text" name="CIUDAD" required />
        </div>
        <div class="form-element">
            <label>Departamento</label>
            <?php   
                $d = new departamento();
                $datos_d=$d->consultarDepartamento();
                $cuenta=count($datos_d);
            ?>
            <select class="form-control"  name="DEPARTAMENTO" required>
                <option value=""></option>
                <?php
                    for ($i=0;$i<$cuenta;$i++)
                    {
                    ?>
                        <option value="<?php echo $datos_d[$i][0]?>"><?php echo $datos_d[$i][1]?></option>
                    <?php
                    }
                ?>
            </select>
        </div>
  <!--      <div class="form-element">
            <label>Imagen</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div> -->
        <button type="submit" name="register" value="register">Registrarse</button>
        </form>


    </div>
</section>

<?php require("piepagina/foot.php"); ?>