<?php

require_once('config.php');

class MotivoSubcategoria
{
    private $id;
    private $id_categoria;
    private $descripcion;

    public function __construct($i="", $ic="", $des="")
    {
        $this->id = $i;
        $this->id_categoria = $ic;
        $this->descripcion = $des;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($i)
    {
        $this->id = $i;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($ic)
    {
        $this->id_categoria = $ic;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($des)
    {
        $this->descripcion = $des;
    }

    public Function consultarSubCategoria()
    {
        $conex=conectar();
        $sql= "SELECT sc.id,
                      sc.id_categoria,
                      s.descripcion,
                      sc.descripcion descripcionsc
               FROM motivocategoria s
               JOIN motivosubcategoria sc ON sc.id_categoria = s.id
               ORDER BY sc.id_categoria, sc.id";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
    }


}
?>