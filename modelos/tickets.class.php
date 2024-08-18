<?php

require_once('config.php');
class Ticket
{
    private $id;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $usuario_cliente;
    private $usuario_tecnico;
    private $id_solicitud;
    private $estado;
    private $fecha_solicitud;
    private $monto;
    private $id_subcategoria;

function __construct($i="",$t="",$d="",$f="",$uc="",$ut="",$ic="",$es="",$fs="",$m="",$isc="")
{
    $this->id=$i;
    $this->titulo=$t;
    $this->descripcion=$d;
    $this->fecha=$f;
    $this->usuario_cliente=$uc;
    $this->usuario_tecnico=$ut;
    $this->id_solicitud=$ic;
    $this->estado=$es;
    $this->fecha_solicitud=$fs;
    $this->monto=$m;
    $this->id_subcategoria=$isc;
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

public function setUsuariotecnico($ut)
{
    $this->usuario_tecnico=$ut;
}

public function setIdsolicitud($ic)
{
    $this->id_solicitud=$ic;
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

public function setIdsubcategoria($isc)
{
  $this->id_subcategoria=$isc;
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

public function getUsuariotecnico()
{
    return $this->usuario_tecnico;
}

public function getIdsolicitud()
{
    return $this->id_solicitud;
}

public function getEstado()
{
    return $this->estado;
}

public function getFechasolicitud()
{
    return $this->fecha_solicitud;
}

public function getMonto()
{
    return $this->monto;
}

public function getIdsubcategoria()
{
  return $this->id_subcategoria;
}

public function guardarticket()
{
    $conex=conectar();

    $sql = "insert into tickets (titulo,descripcion,fecha,usuario_cliente,usuario_tecnico,id_solicitud,estado,fecha_solicitud,monto,id_subcategoria)
            values (:titulo,:descripcion,:fecha,:usuario_cliente,:usuario_tecnico,:id_solicitud,:estado,:fecha_solicitud,:monto,:id_subcategoria)";
    
        $result = $conex->prepare($sql);
    $result->execute(array(":titulo" => $this->titulo, ":descripcion" => $this->descripcion,":fecha" => $this->fecha,":usuario_cliente" => $this->usuario_cliente, 
                           ":usuario_tecnico" => $this->usuario_tecnico,":id_solicitud" => $this->id_solicitud,":estado" => $this->estado,
                           ":fecha_solicitud" => $this->fecha_solicitud,":monto" => $this->monto,":id_subcategoria" => $this->id_subcategoria));
    
    
    if($result)
    {
      return(true);
    }
    else
    {
      return(false);
    }
   
}

Public Function ConsultarTicketsenDesarrolloTecnico()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM tickets WHERE estado in (1,2) and usuario_tecnico = :usuario_tecnico";
    $result=$conex->prepare($sql);
    $result->execute(array(":usuario_tecnico" => $this->usuario_tecnico));
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

Public Function ConsultarTicketsResueltoTecnico()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM tickets WHERE estado in (3,4) AND usuario_tecnico = :usuario_tecnico";
    $result=$conex->prepare($sql);
    $result->execute(array(":usuario_tecnico" => $this->usuario_tecnico));
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

Public Function TicketTecnicoDetalle()
{
    $conex=conectar();
    
    $sql= "SELECT t.id, t.descripcion, t.usuario_cliente, t.titulo, t.fecha, t.estado, te.nombre FROM tickets t JOIN ticketestado te ON t.estado = te.id WHERE t.id=:id";
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

Public Function TicketDatosCorreo()
{
    $conex=conectar();
    
    $sql= "SELECT tic.id,
                  tic.usuario_cliente,
                  cli.nombre_usuario nomcli,
                  cli.correo corcli,
                  tic.usuario_tecnico,
                  tec.nombre_usuario nomtec,
                  tec.correo cortec,
                  tic.estado,
                  tes.nombre estnombre
           FROM tickets tic
           JOIN usuario cli ON cli.tipo_usuario = 1
                            AND tic.usuario_cliente = cli.id
           JOIN usuario tec ON tec.tipo_usuario = 2
                            AND tic.usuario_tecnico = tec.id
           JOIN ticketestado tes ON tic.estado = tes.id
           WHERE tic.id = :id";
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

Public Function SolicitudTicket()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM tickets WHERE id_solicitud = :id_solicitud";
    $result=$conex->prepare($sql);
    $result->execute(array(":id_solicitud" => $this->id_solicitud));
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


Public Function VerificarSolicitudTicket()
{
    $conex=conectar(); 
    
    $sql= "SELECT CASE WHEN (SELECT id_solicitud FROM tickets WHERE id_solicitud = :id_solicitud LIMIT 1) THEN 1 ELSE 0 END  verif_ticket";
    $result=$conex->prepare($sql);
    $result->execute(array(":id_solicitud" => $this->id_solicitud));
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

public function cambiarestadoticket()
{
  $conex=conectar();
  
  $sqlupdate = "UPDATE tickets SET estado = :estado WHERE id=:id";
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

public function ObtenerIdTicket(){
  
    $conex=conectar(); 
    
    $sql= "SELECT id
           FROM tickets
           WHERE id_solicitud = :id_solicitud";
    $result=$conex->prepare($sql);
    $result->execute(array(":id_solicitud" => $this->id_solicitud));
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