<?php

require_once('config.php');

class Visita
{
    private $id;
    private $idsolicitud;
    private $usuario_tecnico;
    private $usuario_cliente;
    private $visita_aceptada;
    private $fecha_visita;

    public function __construct($id="", $ids="", $ut="", $uc="", $va="", $fv="")
    {
        $this->id = $id;
        $this->idsolicitud = $ids;
        $this->usuario_tecnico = $ut;
        $this->usuario_cliente = $uc;
        $this->visita_aceptada = $va;
        $this->fecha_visita = $fv;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdSolicitud()
    {
        return $this->idsolicitud;
    }

    public function setIdSolicitud($ids)
    {
        $this->idsolicitud = $ids;
    }

    public function getUsuarioTecnico()
    {
        return $this->usuario_tecnico;
    }

    public function setUsuarioTecnico($ut)
    {
        $this->usuario_tecnico = $ut;
    }

    public function getUsuarioCliente()
    {
        return $this->usuario_cliente;
    }

    public function setUsuarioCliente($uc)
    {
        $this->usuario_cliente = $uc;
    }

    public function getVisitaAceptada()
    {
        return $this->visita_aceptada;
    }

    public function setVisitaAceptada($va)
    {
        $this->visita_aceptada = $va;
    }

    public function getFechaVisita()
    {
        return $this->fecha_visita;
    }

    public function setFechaVisita($fv)
    {
        $this->fecha_visita = $fv;
    }

    public function guardar()
    {
        $conex=conectar();

        $sql = "insert into solicitudvisita (idsolicitud,usuario_tecnico,usuario_cliente,visita_aceptada)
                values (:idsolicitud,:usuario_tecnico,:usuario_cliente,:visita_aceptada)";
		
		    $result = $conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud,":usuario_tecnico" => $this->usuario_tecnico,
                               ":usuario_cliente" => $this->usuario_cliente,":visita_aceptada" => $this->visita_aceptada));

/*	$sql = "insert into solicitudvisita (idsolicitud,usuario_tecnico,usuario_cliente,visita_aceptada,fecha_visita)
                values (:idsolicitud,:usuario_tecnico,:usuario_cliente,:visita_aceptada,:fecha_visita)";
		
		    $result = $conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud,":usuario_tecnico" => $this->usuario_tecnico,
                               ":usuario_cliente" => $this->usuario_cliente,":visita_aceptada" => $this->visita_aceptada,
                               ":fecha_visita" => $this->fecha_visita));
*/        
        
        if($result)
        {
          return(true);
        }
        else
        {
          return(false);
        }
       
    }

    Public Function VerificarSolicitudconVisita()
    {
        $conex=conectar();  
        
        $sql= "SELECT CASE WHEN (SELECT idsolicitud FROM solicitudvisita WHERE idsolicitud = :idsolicitud LIMIT 1) THEN 1 ELSE 0 END  verif_sol";
        $result=$conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud));
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

    public function ConsultarVisitas()
    {
        $conex=conectar();
        $sql = "SELECT sv.id,
                       sv.idsolicitud,
                       sv.usuario_tecnico,
                       u.nombre_usuario,
                       sv.visita_aceptada,
                       sv.fecha_visita
                FROM solicitudvisita sv
                JOIN usuario u ON sv.usuario_tecnico = u.id
                               AND u.tipo_usuario = 2
                WHERE idsolicitud = :idsolicitud";
        $result=$conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud));
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

    public function ConsultarVisitasxTecnico()
    {
        $conex=conectar();
        $sql = "SELECT sv.id,
                       sv.idsolicitud,
                       sv.usuario_tecnico,
                       u.nombre_usuario,
                       sv.visita_aceptada,
                       sv.fecha_visita
                FROM solicitudvisita sv
                JOIN usuario u ON sv.usuario_tecnico = u.id
                               AND u.tipo_usuario = 2
                WHERE idsolicitud = :idsolicitud
                AND sv.usuario_tecnico = :usuario_tecnico";
        $result=$conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud,":usuario_tecnico" => $this->usuario_tecnico));
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


    Public Function TodasSolicitudesPendientesConfirmacionVisita()
{
    $conex=conectar();
    $sql= "SELECT s.id, s.titulo, s.fecha,
                  CASE WHEN sv.visita_aceptada = 1 THEN 'SI' ELSE 'NO' END confirmacion
    FROM solicitud s
    LEFT JOIN solicitudvisita sv on s.id = sv.idsolicitud
                                 AND sv.usuario_tecnico = :usuario_tecnico
    WHERE s.estado = 1
    AND sv.visita_aceptada IN (1,0)";
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

    public function ProgramarVisita()
    {
        $conex=conectar();
        $sqlupdate = "UPDATE solicitudvisita
                SET visita_aceptada = :visita_aceptada, fecha_visita = :fecha_visita
                WHERE id = :id
                AND idsolicitud = :idsolicitud";
        $result=$conex->prepare($sqlupdate);
        $result->execute(array(":id" => $this->id,":idsolicitud" => $this->idsolicitud,":visita_aceptada" => $this->visita_aceptada,":fecha_visita" => $this->fecha_visita));
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

    Public Function SolicitudDatosCorreo_Tecnico()
    {
        $conex=conectar();
        
        $sql= "SELECT sol.id,
                      sol.usuario_cliente,
                      cli.nombre_usuario nomcli,
                      cli.correo corcli,
                      sov.usuario_tecnico,
                      tec.nombre_usuario nomtec,
                      tec.correo cortec,
                      sol.estado,
                      ses.nombre estnombre,
                      sov.visita_aceptada
               FROM solicitud sol
               JOIN usuario cli ON cli.tipo_usuario = 1
                                AND sol.usuario_cliente = cli.id
               JOIN solicitudestado ses ON sol.estado = ses.id
               JOIN solicitudvisita sov ON sol.id = sov.idsolicitud
               JOIN usuario tec ON tec.tipo_usuario = 2
                                AND sov.usuario_tecnico = tec.id
               WHERE sol.id = :idsolicitud
               AND sov.usuario_tecnico = :usuario_tecnico
               AND sov.visita_aceptada = 0";
        $result=$conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud, ":usuario_tecnico" => $this->usuario_tecnico));
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

    Public Function SolicitudDatosCorreo_Cliente()
    {
        $conex=conectar();
        
        $sql= "SELECT sol.id,
                      sol.usuario_cliente,
                      cli.nombre_usuario nomcli,
                      cli.correo corcli,
                      sov.usuario_tecnico,
                      tec.nombre_usuario nomtec,
                      tec.correo cortec,
                      sol.estado,
                      ses.nombre estnombre,
                      sov.visita_aceptada
               FROM solicitud sol
               JOIN usuario cli ON cli.tipo_usuario = 1
                                AND sol.usuario_cliente = cli.id
               JOIN solicitudestado ses ON sol.estado = ses.id
               JOIN solicitudvisita sov ON sol.id = sov.idsolicitud
               JOIN usuario tec ON tec.tipo_usuario = 2
                                AND sov.usuario_tecnico = tec.id
               WHERE sol.id = :idsolicitud
               AND sov.id = :id
               AND sov.visita_aceptada = 1";
        $result=$conex->prepare($sql);
        $result->execute(array(":idsolicitud" => $this->idsolicitud, ":id" => $this->id));
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