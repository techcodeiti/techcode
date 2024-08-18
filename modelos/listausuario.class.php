<?php

require_once('config.php');
class Tipousuario
{
    private $id;
    private $nombre;
    
    function __construct($i="",$n="")
    {
        $this->id=$i;
        $this->nombre=$n;
    }
    
    public Function consultarTipoUsuario()
    {
        $conex=conectar();
        $sql= "select * from tiposusuarios where id not in(3)";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
    }

} 
?>