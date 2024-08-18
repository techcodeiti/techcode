<?php
session_start();
?>
<?php
    require_once('../modelos/usuarios.class.php');
    require_once('../modelos/departamento.class.php');
    $p=new usuario($_SESSION['USUARIO']);
    $datosp=$p->ConsultarUsuario();
    $resultado = $datosp[0];
    $fecha_nacimiento = new DateTime($resultado['fecha_nacimiento']);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento);

    $d=new departamento($resultado['departamento']);
    $datosd=$d->consultar1Departamento();
    $resultado1 = $datosd[0];
?>

<?php require("cabezales/head.php"); ?>

<section id=inicio>



    <div class="contenidodeinteres">
        <?php
        if($resultado['foto'] == NULL){
        ?>
        <img id="fotoperfil" src="cabezales/logo.JPG" alt="logo" width="400" height="400">
        <?php
        } else {
        ?>
        <img id="fotoperfil" src="<?php echo $resultado['foto']; ?>" alt="logo" width="400" height="400">
        <?php
        }
        ?>
    
        <div>
            <p>Nombre: <?php echo $resultado['nombre']; ?></p>
        </div>
        <div>
            <p>Apellido: <?php echo $resultado['apellido']; ?></p>
        </div>
        <div>
            <p>Fecha de Nacimiento: <?php echo date("d/m/Y",strtotime($resultado['fecha_nacimiento'])); ?></p>
        </div>
        <div>
            <p>Edad: <?php echo $edad->y; ?></p>
        </div>
        <div>
            <p>Correo: <?php echo $resultado['correo']; ?></p>
        </div>
        <div>
            <p>Telefono: <?php echo $resultado['telefono']; ?></p>
        </div>
        <div>
            <p>Departamento: <?php echo $resultado1['nombre']; ?></p>
        </div>
        <div>
            <p>Ciudad/Localidad: <?php echo $resultado['ciudad']; ?></p>
        </div>
        <div>
            <p>Dirección: <?php echo $resultado['direccion']; ?></p>
        </div>
    </div>
</section>

<?php require("piepagina/foot.php"); ?>