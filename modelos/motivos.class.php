<?php

require_once('config.php');
class motivoreporte
{
    private $id;
    private $nombre;
    function __construct($i="",$n="")
    {
        $this->id=$i;
        $this->nombre=$n;
    }
    
    public Function consultarMotivoReporte()
    {
        $conex=conectar();
        $sql= "select * from motivoreporte order by principal";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
    }
} 
?>