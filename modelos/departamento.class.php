<?php

require_once('config.php');
class Departamento
{
    private $id;
    private $nombre;
    function __construct($i="",$n="")
    {
        $this->id=$i;
        $this->nombre=$n;
    }
    
    public Function consultarDepartamento()
    {
        $conex=conectar();
        $sql= "select * from departamentos";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
    }

    public Function consultar1Departamento()
    {
        $conex=conectar();
        $sql= "select * from departamentos where id=:id";
        $result=$conex->prepare($sql);
        $result->execute(array(":id" => $this->id));
        $resultado=$result->fetchAll();
        return $resultado;
    }
} 
?>