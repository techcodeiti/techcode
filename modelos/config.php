<?php
function conectar()
{
    try {
        $conexion = new PDO('mysql:host=10.10.0.103;dbname=techcode', 'appbd', 'Techcode2021*',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return($conexion);
    } catch (PDOException $e) {
	var_dump($conexion);
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";

        exit();
    }
}

function desconectar($conexion)
{
   $conexion=null;
  
}
