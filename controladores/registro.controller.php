<?php
require_once('../modelos/usuarios.class.php');

$nombre= strip_tags($_POST['NOMBRE']);
$apellido= strip_tags($_POST['APELLIDO']);
$nombre_usuario = strip_tags($_POST['USERNAME']);
$fecha_nacimiento = strip_tags($_POST['FECHANAC']);
$correo= strip_tags($_POST['CORREO']);
$password= strip_tags($_POST['PASSWORD']);
$telefono= strip_tags($_POST['TELEFONO']);
$foto= NULL;
$direccion= strip_tags($_POST['DIRECCION']);
$ciudad= strip_tags($_POST['CIUDAD']);
$departamento= strip_tags($_POST['DEPARTAMENTO']);
$tipo_usuario= strip_tags($_POST['TIPOUSUARIO']);
$activo= 1;

$p= new usuario("",$nombre,$apellido,$nombre_usuario,$fecha_nacimiento,$correo,$password,$telefono,$foto,$direccion,$ciudad,$departamento,$tipo_usuario,$activo);

$result=$p->guardar();

if ($result) {
	
	$mensaje="Los datos se guardaron correctamente";
}
else
{
	$mensaje= "Hubo un error al guardar los datos de la persona";
}

echo "<script>
	alert('$mensaje');
	window.location= '../index.php';
</script>";


?>