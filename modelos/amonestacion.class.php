<?php

class Amonestacion
{
    private $id;
    private $id_reporte;
    private $usuario_tecnico;
    private $amonestacion;
    private $fecha_amonestacion;

    public function __construct($i="", $ir="", $ut="", $a="", $fa="")
{
    $this->id = $i;
    $this->id_reporte = $ir;
    $this->usuario_tecnico = $ut;
    $this->amonestacion = $a;
    $this->fecha_amonestacion = $fa;
}


    public function getId()
    {
        return $this->id;
    }

    public function setId($i)
    {
        $this->id = $i;
    }

    public function getIdReporte()
    {
        return $this->id_reporte;
    }

    public function setIdReporte($ir)
    {
        $this->id_reporte = $ir;
    }

    public function getUsuarioTecnico()
    {
        return $this->usuario_tecnico;
    }

    public function setUsuarioTecnico($ut)
    {
        $this->usuario_tecnico = $ut;
    }

    public function getAmonestacion()
    {
        return $this->amonestacion;
    }

    public function setAmonestacion($a)
    {
        $this->amonestacion = $a;
    }

    public function getFechaAmonestacion()
    {
        return $this->fecha_amonestacion;
    }

    public function setFechaAmonestacion($fa)
    {
        $this->fecha_amonestacion = $fa;
    }

    public function guardaramonestacion(){
        $conex = conectar();

        $sql = "INSERT INTO amonestaciones (id_reporte,usuario_tecnico,amonestacion,fecha_amonestacion)
                VALUES (:id_reporte,:usuario_tecnico,:amonestacion,:fecha_amonestacion)";
        $result = $conex->prepare($sql);
        $result->execute(array(":id_reporte" => $this->id_reporte,
                               ":usuario_tecnico" => $this->usuario_tecnico,
                               ":amonestacion" => $this->amonestacion,
                               ":fecha_amonestacion" => $this->fecha_amonestacion));
        
        if($result){
            return(true);
        }else{
            return(false);
        }
    }

    Public Function CorreoTecnicoAmonestacion()
    {
            $conex=conectar();
            
            $sql= "SELECT a.id_amonestacion,
                          a.id_reporte,
                          a.usuario_tecnico,
                          tec.nombre_usuario nomtec,
                          tec.correo cortec,
                          r.id_ticket
                   FROM amonestaciones a
                   JOIN usuario tec ON tec.tipo_usuario = 2
                                    AND a.usuario_tecnico = tec.id
                   JOIN reporte r ON a.id_reporte = r.id_reporte
                   WHERE a.id_reporte = :id_reporte
                   AND a.usuario_tecnico = :usuario_tecnico"; 
            $result=$conex->prepare($sql); 
            $result->execute(array(":id_reporte" => $this->id_reporte,
                                   ":usuario_tecnico" => $this->usuario_tecnico));
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