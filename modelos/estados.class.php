<?php

require_once('config.php');
class estadosolicitud
{
    private $id;
    private $nombre;
    function __construct($i="",$n="")
    {
        $this->id=$i;
        $this->nombre=$n;
    }
    
    public Function consultarEstadoSolicitud()
    {
        $conex=conectar();
        $sql= "select * from solicitudestado where id=:id";
        $result=$conex->prepare($sql);
        $result->execute(array(":id" => $this->id));
        $resultado=$result->fetchAll();
        return $resultado;
    }
} 
?>