<?php

require_once('config.php');

class Suspension{
    private $id;
    private $usuario_tecnico;
    private $comentario;
    private $fecha;
    private $fecha_reanudacion;

    public function __construct($i="", $ut="", $co="", $fe="", $fer=""){
        $this->id = $i;
        $this->usuario_tecnico = $ut;
        $this->comentario = $co;
        $this->fecha = $fe;
        $this->fecha_reanudacion = $fer;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($i)
    {
        $this->id = $i;
    }
    
    public function getUsuarioTecnico()
    {
        return $this->usuario_tecnico;
    }

    public function setUsuarioTecnico($ut)
    {
        $this->usuario_tecnico = $ut;
    }
    
    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($co)
    {
        $this->comentario = $co;
    }
    
    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fe)
    {
        $this->fecha = $fe;
    }
    
    public function getFechaReanudacion()
    {
        return $this->fecha_reanudacion;
    }

    public function setFechaReanudacion($fer)
    {
        $this->fecha_reanudacion = $fer;
    }

    public function guardarsuspension(){
        $conex = conectar();

        $sql = "INSERT INTO suspensionusuarios (usuario_tecnico,comentario,fecha,fecha_reanudacion)
                VALUES (:usuario_tecnico,:comentario,:fecha,:fecha_reanudacion)";
        $result = $conex->prepare($sql);
        $result->execute(array(":usuario_tecnico" => $this->usuario_tecnico,
                               ":comentario" => $this->comentario,
                               ":fecha" => $this->fecha,
                               ":fecha_reanudacion" => $this->fecha_reanudacion));
        
        if($result){
            return(true);
        }else{
            return(false);
        }
    }

}


?>