<?php

require_once('config.php');
class Presupuesto
{
    private $id;
    private $usuario_tecnico;
    private $id_solicitud;
    private $fecha;
    private $descripcion;
    private $monto;
    private $aceptado;
    private $id_subcategoria;


function __construct($i="",$ut="",$is="",$f="",$d="",$m="",$ac="",$isc="")
{
    $this->id=$i;
    $this->usuario_tecnico=$ut;
    $this->id_solicitud=$is;
    $this->fecha=$f;
    $this->descripcion=$d;
    $this->monto=$m;
    $this->aceptado=$ac;
    $this->id_subcategoria=$isc;
}



public function setId($i)
{
    $this->id= $i;
}

public function setUsuariotecnico($ut)
{
    $this->usuario_tecnico=$ut;
}

public function setIdsolicitud($is)
{
    $this->id_solicitud=$is;
}

public function setFecha($f)
{
    $this->fecha=$f;
}

public function setDescripcion($d)
{
    $this->descripcion=$d;
}

public function setMonto($m)
{
    $this->monto=$m;
}

public function setAceptado($ac)
{
    $this->aceptado=$ac;
}

public function setIdsubcategoria($isc)
{
  $this->id_subcategoria=$isc;
}

public function getId()
{
    return $this->id;
}

public function getUsuariotecnico()
{
    return $this->usuario_tecnico;
}

public function getIdsolicitud()
{
    return $this->id_solicitud;
}

public function getFecha()
{
    return $this->fecha;
}

public function getDescripcion()
{
    return $this->descripcion;
}

public function getMonto()
{
    return $this->monto;
}

public function getAceptado()
{
    return $this->aceptado;
}

public function getIdsubcategoria()
{
  return $this->id_subcategoria;
}

public function guardarpresupuesto()
{
    $conex=conectar();

    $sql = "insert into presupuesto (usuario_tecnico,id_solicitud,fecha,descripcion,monto,aceptado,id_subcategoria)
            values (:usuario_tecnico,:id_solicitud,:fecha,:descripcion,:monto,:aceptado,:id_subcategoria)";
    
        $result = $conex->prepare($sql);
    $result->execute(array(":usuario_tecnico" => $this->usuario_tecnico, ":id_solicitud" => $this->id_solicitud,":fecha" => $this->fecha,":descripcion" => $this->descripcion,":monto" => $this->monto,
                           ":aceptado" => $this->aceptado, ":id_subcategoria" => $this->id_subcategoria));
    
    
    if($result)
    {
      return(true);
    }
    else
    {
      return(false);
    }
   
}

Public Function ConsultarPresupuestosSolicitudes()
{
    $conex=conectar();
    
    $sql= "SELECT * FROM presupuesto WHERE id_solicitud=:id_solicitud and aceptado = 0";
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

public function cambiarestadopresupuestoaceptado()
{
  $conex=conectar();
  
  $sqlupdate = "UPDATE presupuesto SET aceptado = :aceptado WHERE id=:id AND id_solicitud=:id_solicitud";
  $result=$conex->prepare($sqlupdate);
  $result->execute(array(":aceptado" => $this->aceptado,":id" => $this->id,":id_solicitud" => $this->id_solicitud));
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

public function cambiarestadopresupuestodeclinado()
{
  $conex=conectar();
  
  $sqlupdate = "UPDATE presupuesto SET aceptado = :aceptado WHERE id_solicitud=:id_solicitud AND id <> :id";
  $result=$conex->prepare($sqlupdate);
  $result->execute(array(":aceptado" => $this->aceptado,":id_solicitud" => $this->id_solicitud,":id" => $this->id));
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

Public Function VerificarSolicitudconPresupuesto()
{
    $conex=conectar();  
    
    $sql= "SELECT CASE WHEN (SELECT id_solicitud FROM presupuesto WHERE id_solicitud = :id_solicitud LIMIT 1) THEN 1 ELSE 0 END  verif_sol";
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


Public Function PresupuestoDatosCorreo_Tecnico()
    {
        $conex=conectar();
        
        $sql= "SELECT sol.id,
                      sol.usuario_cliente,
                      cli.nombre_usuario nomcli,
                      cli.correo corcli,
                      pre.usuario_tecnico,
                      tec.nombre_usuario nomtec,
                      tec.correo cortec,
                      sol.estado,
                      ses.nombre estnombre
               FROM solicitud sol
               JOIN usuario cli ON cli.tipo_usuario = 1
                                AND sol.usuario_cliente = cli.id
               JOIN solicitudestado ses ON sol.estado = ses.id
               JOIN presupuesto pre ON sol.id = pre.id_solicitud
               JOIN usuario tec ON tec.tipo_usuario = 2
                                AND pre.usuario_tecnico = tec.id
               WHERE sol.id = :id_solicitud
               AND pre.usuario_tecnico = :usuario_tecnico";
        $result=$conex->prepare($sql);
        $result->execute(array(":id_solicitud" => $this->id_solicitud, ":usuario_tecnico" => $this->usuario_tecnico));
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

    Public Function PresupuestoDatosCorreo_OK()
    {
        $conex=conectar();
        
        $sql= "SELECT sol.id,
                      sol.usuario_cliente,
                      cli.nombre_usuario nomcli,
                      cli.correo corcli,
                      pre.usuario_tecnico,
                      tec.nombre_usuario nomtec,
                      tec.correo cortec,
                      sol.estado,
                      ses.nombre estnombre
               FROM solicitud sol
               JOIN usuario cli ON cli.tipo_usuario = 1
                                AND sol.usuario_cliente = cli.id
               JOIN solicitudestado ses ON sol.estado = ses.id
               JOIN presupuesto pre ON sol.id = pre.id_solicitud
               JOIN usuario tec ON tec.tipo_usuario = 2
                                AND pre.usuario_tecnico = tec.id
               WHERE sol.id = :id_solicitud
               AND pre.usuario_tecnico = :usuario_tecnico
               AND pre.id = :id";
        $result=$conex->prepare($sql);
        $result->execute(array(":id" => $this->id,":id_solicitud" => $this->id_solicitud, ":usuario_tecnico" => $this->usuario_tecnico));
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