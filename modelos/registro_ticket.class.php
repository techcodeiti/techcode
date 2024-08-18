<?php

require_once('config.php');
class RegistroTicket
{
    private $id;
    private $id_ticket;
    private $fecha;
    private $comentario;
    private $id_usuario;

function __construct($i="",$it="",$f="",$c="",$iu="")
{
    $this->id=$i;
    $this->id_ticket=$it;
    $this->fecha=$f;
    $this->comentario=$c;
    $this->id_usuario=$iu;
}


public function setId($i)
{
    $this->id= $i;
}

public function setIdticket($it)
{
    $this->id_ticket= $it;
}

public function setFecha($f)
{
    $this->fecha=$f;
}

public function setComentario($c)
{
    $this->comentario=$c;
}

public function setIdusuario($ut)
{
    $this->id_usuario=$iu;
}


public function getId()
{
    return $this->id;
}

public function getIdticket()
{
    return $this->id_ticket;
}

public function getFecha()
{
    return $this->fecha;
}

public function getComentario()
{
    return $this->comentario;
}

public function getIdusuario()
{
    return $this->id_usuario;
}

public function guardarregistro()
{
    $conex=conectar();

    $sql = "insert into registroactividad (id_ticket,fecha,comentario,id_usuario)
            values (:id_ticket,:fecha,:comentario,:id_usuario)";
    
        $result = $conex->prepare($sql);
    $result->execute(array(":id_ticket" => $this->id_ticket, ":fecha" => $this->fecha,":comentario" => $this->comentario,":id_usuario" => $this->id_usuario));
    

    if($result)
    {
      return(true);
    }
    else
    {
      return(false);
    }
   
}

Public Function ConsultarRegistroTicket()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM registroactividad WHERE id_ticket=:id_ticket order by fecha desc";
    $result=$conex->prepare($sql);
    $result->execute(array(":id_ticket" => $this->id_ticket));
    $resultado=$result->fetchAll();
    return $resultado;

    if($resultado)
    {
      return(true);
    }
    else
    {
      return(false);
    }
}


}
?>