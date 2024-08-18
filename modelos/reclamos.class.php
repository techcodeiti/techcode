<?php

require_once('config.php');
class Reclamo{
    private $id;
    private $fecha_reporte;
    private $descripcion_reporte;
    private $aceptacion_reporte;
    private $fecha_aceptacion;
    private $activo_reporte;
    private $motivo_reporte;
    private $usuario_cliente;
    private $usuario_tecnico;
    private $id_ticket;

    public function __construct($i="", $fr="", $dr="", $acr="", $acf="", $ar="", $mr="", $uc="", $ut="", $it="")
    {
        $this->id = $i;
        $this->fecha_reporte = $fr;
        $this->descripcion_reporte = $dr;
        $this->aceptacion_reporte = $acr;
        $this->fecha_aceptacion = $acf;
        $this->activo_reporte = $ar;
        $this->motivo_reporte = $mr;
        $this->usuario_cliente = $uc;
        $this->usuario_tecnico = $ut;
        $this->id_ticket = $it;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($i)
    {
        $this->id = $i;
    }

    public function getFechaReporte()
    {
        return $this->fecha_reporte;
    }

    public function setFechaReporte($fr)
    {
        $this->fecha_reporte = $fr;
    }

    public function getDescripcionReporte()
    {
        return $this->descripcion_reporte;
    }

    public function setDescripcionReporte($dr)
    {
        $this->descripcion_reporte = $dr;
    }

    public function getAceptacionReporte()
    {
        return $this->aceptacion_reporte;
    }

    public function setAceptacionReporte($acr)
    {
        $this->aceptacion_reporte = $acr;
    }

    public function setFechaAceptacion($acf)
    {
        $this->fecha_aceptacion = $acf;
    }

    public function getFechaAceptacion()
    {
        return $this->fecha_aceptacion;
    }

    public function setActivoReporte($ar)
    {
        $this->activo_reporte = $ar;
    }

    public function getMotivoReporte()
    {
        return $this->motivo_reporte;
    }

    public function setMotivoReporte($mr)
    {
        $this->motivo_reporte = $mr;
    }

    public function getUsuarioCliente()
    {
        return $this->usuario_cliente;
    }

    public function setUsuarioCliente($uc)
    {
        $this->usuario_cliente = $uc;
    }

    public function getUsuarioTecnico()
    {
        return $this->usuario_tecnico;
    }

    public function setUsuarioTecnico($ut)
    {
        $this->usuario_tecnico = $ut;
    }

    public function getIdTicket()
    {
        return $this->id_ticket;
    }

    public function setIdTicket($it)
    {
        $this->id_ticket = $it;
    }

    public function guardarreclamo(){
        $conex = conectar();

        $sql = "INSERT INTO reporte (fecha_reporte,descripcion_reporte,aceptacion_reporte,activo_reporte,
                                     motivo_reporte, usuario_cliente, usuario_tecnico, id_ticket)
                VALUES (:fecha_reporte,:descripcion_reporte,:aceptacion_reporte,:activo_reporte,:motivo_reporte,
                        :usuario_cliente,:usuario_tecnico,:id_ticket)";
        $result = $conex->prepare($sql);
        $result->execute(array(":fecha_reporte" => $this->fecha_reporte,
                               ":descripcion_reporte" => $this->descripcion_reporte,
                               ":aceptacion_reporte" => $this->aceptacion_reporte,
                               ":activo_reporte" => $this->activo_reporte,
                               ":motivo_reporte" => $this->motivo_reporte,
                               ":usuario_cliente" => $this->usuario_cliente,
                               ":usuario_tecnico" => $this->usuario_tecnico,
                               ":id_ticket" => $this->id_ticket));
        
        if($result){
            return(true);
        }else{
            return(false);
        }
    }

    public function aceptacionReclamo(){
        $conex = conectar();

        $sql = "SELECT DISTINCT aceptacion_reporte FROM reporte WHERE id_ticket = :id_ticket AND usuario_cliente = :usuario_cliente AND aceptacion_reporte = 0;";
        $result=$conex->prepare($sql);
        $result->execute(array(":id_ticket" => $this->id_ticket,":usuario_cliente" => $this->usuario_cliente));
        $resultado=$result->fetchAll();
        return $resultado;
        if($resultado){
            return(true);
        }else{
            return(false);
        }
    }

    public function ReclamoAbierto(){
        $conex = conectar();

        $sql = "SELECT DISTINCT aceptacion_reporte FROM reporte WHERE id_ticket = :id_ticket AND aceptacion_reporte = 0;";
        $result=$conex->prepare($sql);
        $result->execute(array(":id_ticket" => $this->id_ticket));
        $resultado=$result->fetchAll();
        return $resultado;
        if($resultado){
            return(true);
        }else{
            return(false);
        }
    }

    public function VerReclamosAbiertos(){
        $conex = conectar();

        $sql = "SELECT id_reporte, id_ticket, descripcion_reporte, fecha_reporte FROM reporte WHERE aceptacion_reporte = 0;";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
        if($resultado){
            return(true);
        }else{
            return(false);
        }
    }

    public function VerReclamosCerrados(){
        $conex = conectar();

        $sql = "SELECT id_reporte, id_ticket, descripcion_reporte, fecha_reporte FROM reporte WHERE aceptacion_reporte = 1;";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
        if($resultado){
            return(true);
        }else{
            return(false);
        }
    }


    Public Function ReclamoDetalle()
{
        $conex=conectar();
        
        $sql= "SELECT r.id_reporte,
                      r.fecha_reporte,
                      CONCAT(RTRIM(u.nombre),' ', LTRIM(u.apellido)) AS cliente,
                      CONCAT(RTRIM(t.nombre),' ', RTRIM(t.apellido)) AS tecnico,
                      r.usuario_tecnico,
                      mr.nombre AS motivo,
                      r.descripcion_reporte
               FROM reporte r
               JOIN usuario u ON u.tipo_usuario = 1
                              AND r.usuario_cliente = u.id
               JOIN usuario t ON t.tipo_usuario = 2
                              AND r.usuario_tecnico = t.id
               JOIN motivoreporte mr ON r.motivo_reporte = mr.id
               WHERE r.id_reporte = :id"; 
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

Public Function CorreoTecnicoReportar()
{
        $conex=conectar();
        
        $sql= "SELECT tic.id,
                      tec.nombre_usuario nomtec,
                      tic.usuario_tecnico,
                      tec.correo cortec,
                      cli.nombre_usuario nomcli,
                      tic.usuario_cliente,
                      cli.correo corcli
               FROM tickets tic
               JOIN usuario tec ON tec.tipo_usuario = 2
                                AND tic.usuario_tecnico = tec.id
               JOIN usuario cli ON cli.tipo_usuario = 1
                                AND tic.usuario_cliente = cli.id
               WHERE tic.id = :id_ticket"; 
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

Public Function AceptarReclamo()
{
        $conex=conectar();
        
        $sql= "UPDATE reporte
               SET aceptacion_reporte = :aceptacion_reporte, fecha_aceptacion = :fecha_aceptacion, activo_reporte = 0
               WHERE id_reporte = :id; "; 
        $result=$conex->prepare($sql); 
        $result->execute(array(":id" => $this->id,
                               ":aceptacion_reporte" => $this->aceptacion_reporte,
                               ":fecha_aceptacion" => $this->fecha_aceptacion));
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