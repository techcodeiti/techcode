<?php

require_once('config.php');
class Solicitud
{
    private $id;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $usuario_cliente;
    private $requiere_visita;
    private $estado;

function __construct($i="",$t="",$d="",$f="",$uc="",$rv="",$es="")
{
    $this->id=$i;
    $this->titulo=$t;
    $this->descripcion=$d;
    $this->fecha=$f;
    $this->usuario_cliente=$uc;
    $this->requiere_visita=$rv;
    $this->estado=$es;
}


public function setId($i)
{
  $this->id= $i;
}

public function setTitulo($t)
{
    $this->titulo=$t;
}

public function setDescripcion($d)
{
    $this->descripcion=$d;
}

public function setFecha($f)
{
    $this->fecha=$f;
}

public function setUsuariocliente($uc)
{
    $this->usuario_cliente=$uc;
}

public function setRequiereVisita($rv)
{
    $this->requiere_visita=$rv;
}

public function setEstado($es)
{
    $this->estado=$es;
}

public function setFechasolicitud($fs)
{
    $this->fecha_solicitud=$fs;
}

public function setMonto($m)
{
    $this->monto=$m;
}


public function getId()
{
  return $this->id;
}

public function getTitulo()
{
  return $this->titulo;
}

public function getDescripcion()
{
  return $this->descripcion;
}

public function getFecha()
{
    return $this->fecha;
}

public function getUsuariocliente()
{
    return $this->usuario_cliente;
}

public function getRequiereVisita()
{
    return $this->requiere_visita;
}

public function getEstado()
{
    return $this->estado;
}


public function guardarsolicitud()
{
    $conex=conectar();

    $sql = "insert into solicitud (titulo,descripcion,fecha,usuario_cliente,requierevisita,estado)
            values (:titulo,:descripcion,:fecha,:usuario_cliente,:requiere_visita,:estado)";
    
        $result = $conex->prepare($sql);
    $result->execute(array(":titulo" => $this->titulo, ":descripcion" => $this->descripcion,":fecha" => $this->fecha,":usuario_cliente" => $this->usuario_cliente,
                          ":requiere_visita" => $this->requiere_visita,":estado" => $this->estado));
    
    
    if($result)
    {
      return(true);
    }
    else
    {
      return(false);
    }
   
}

public function cambiarestadosolicitud()
{
  $conex=conectar();
  
  $sqlupdate = "UPDATE solicitud SET estado = :estado WHERE id=:id";
  $result=$conex->prepare($sqlupdate);
  $result->execute(array(":estado" => $this->estado,":id" => $this->id));
  $resultado=$result->rowCount();

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

Public Function TodasSolicitudesPendientes()
{
    $conex=conectar();
    $sql= "SELECT s.id, s.titulo, s.fecha
    FROM solicitud s
    WHERE s.estado = 1
    ";
    $result=$conex->prepare($sql);
    $result->execute();
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


Public Function SolicitudTecnicoDetalle()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM solicitud WHERE id=:id"; 
    $result=$conex->prepare($sql); 
    $result->execute(array(":id" => $this->id));
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



Public Function ConsultarSolicitudesPendientes()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM solicitud WHERE usuario_cliente=:usuario_cliente and estado in (1,2)";
    $result=$conex->prepare($sql);
    $result->execute(array(":usuario_cliente" => $this->usuario_cliente));
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

Public Function SolicitudClienteDetalle()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM solicitud WHERE usuario_cliente=:usuario_cliente and id=:id";
    $result=$conex->prepare($sql);
    $result->execute(array(":usuario_cliente" => $this->usuario_cliente,":id" => $this->id));
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




Public Function EliminarSolicitud()
{
    $conex=conectar();
    
    $sql= "DELETE FROM solicitud where estado = 1 and id = :id";
    $result=$conex->prepare($sql);
    $result->execute(array(":id" => $this->id));
    $resultado=$result->rowCount();
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