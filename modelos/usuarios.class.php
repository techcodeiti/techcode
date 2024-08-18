<?php

require_once('config.php');
class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $nombreusuario;
    private $fechanac;
    private $correo;
    private $password;
    private $telefono;
    private $foto;
    private $direccion;
    private $ciudad;
    private $departamento;
    private $tipousuario;
    private $activo;
   
    function __construct($i="",$n="",$a="",$nu="",$fe="",$co="",$pswd="",$tel="",$fot="",$dir="",$ci="",$dep="",$tu="",$ac="")
    {
       $this->id=$i;
       $this->nombre=$n;
       $this->apellido=$a;
       $this->nombreusuario=$nu;
       $this->fechanac=$fe;
       $this->correo=$co;
       $this->password=$pswd;
       $this->telefono=$tel;
       $this->foto=$fot;
       $this->direccion=$dir;
       $this->ciudad=$ci;
       $this->departamento=$dep;
       $this->tipousuario=$tu;
       $this->activo=$ac;
       
    }


    public function setId($i)
    {
      $this->id= $i;
    }

    public function setNombre($n)
    {
      $this->nombre= $n;
    }

    public function setApellido($a)
    {
      $this->apellido= $a;
    }

    public function setNombreusuario($nu)
    {
        $this->nombreusuario=$nu;
    }

    public function setFechanac($fe)
    {
        $this->fechanac=$fe;
    }

    public function setCorreo($co)
    {
        $this->correo=$co;
    }
    
    public function setPassword($pswd)
    {
        $this->password=$pswd;
    }

    public function setTelefono($tel)
    {
        $this->telefono=$tel;
    }

    public function setFoto($fot)
    {
        $this->foto=$fot;
    }

    public function setDireccion($dir)
    {
        $this->direccion=$dir;
    }    

    public function setCiudad($ci)
    {
        $this->ciudad=$ci;
    }   

    public function setDeparamento($dep)
    {
        $this->departamento=$dep;
    }   

    public function setTipousuario($tu)
    {
        $this->tipousuario=$tu;
    }     
    
    public function setActivo($ac)
    {
        $this->activo=$ac;
    }       

    public function getId()
    {
      return $this->id;
    }

    public function getNombre()
    {
      return $this->nombre;
    }

    public function getApellido()
    {
      return $this->apellido;
    }

    public function getNombreusuario()
    {
      return $this->nombreusuario;
    }

    
    public function getFechanac()
    {
        return $this->fechanac;
    }

    public function getCorreo()
    {
        return $this->correo;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }    

    public function getCiudad()
    {
        return $this->ciudad;
    }   

    public function getDeparamento()
    {
        return $this->departamento;
    }   

    public function getTipousuario()
    {
        return $this->tipousuario;
    }     
    
    public function getActivo()
    {
        return $this->activo;
    }       


    public function guardar()
    {
        $conex=conectar();

        $sql = "insert into usuario (nombre,apellido,nombre_usuario,fecha_nacimiento,correo,password,telefono,foto,direccion,departamento,ciudad,tipo_usuario,activo)
                values (:nombre,:apellido,:nombre_usuario,:fecha_nacimiento,:correo,:password,:telefono,:foto,:direccion,:departamento,:ciudad,:tipo_usuario,:activo)";
		
		    $result = $conex->prepare($sql);
        $result->execute(array(":nombre" => $this->nombre, ":apellido" => $this->apellido,":nombre_usuario" => $this->nombreusuario,":fecha_nacimiento" => $this->fechanac,
                               ":correo" => $this->correo,":password" => $this->password,":telefono" => $this->telefono,":foto" => $this->foto,":direccion" => $this->direccion,
                               ":departamento" => $this->departamento,":ciudad" => $this->ciudad,":tipo_usuario" => $this->tipousuario,":activo" => $this->activo));
        
        
        if($result)
        {
          return(true);
        }
        else
        {
          return(false);
        }
       
    }

    Public Function controlLogin()
    {
        $conex=conectar();
        
        $sql= "SELECT id,
                      nombre_usuario,
                      password,
                      tipo_usuario,
                      activo
               FROM usuario WHERE nombre_usuario=:nombre_usuario";
        $result=$conex->prepare($sql);
        $result->execute(array(":nombre_usuario" => $this->nombreusuario));
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

    Public Function ConsultarUsuario()
    {
        $conex=conectar();
        
        $sql= "SELECT * FROM usuario WHERE id=:id";
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

    public Function UsuariosCliente()
    {
        $conex=conectar();
        $sql= "select id, nombre, apellido, nombre_usuario, correo from usuario where tipo_usuario = 1";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
    }

    public Function UsuariosTecnicos()
    {
        $conex=conectar();
        $sql= "SELECT u.id,
                      u.nombre,
                      u.apellido,
                      u.nombre_usuario,
                      u.correo,
                      IFNULL(SUM(a.amonestacion), 0) as cantamonestacion,
                      CASE WHEN IFNULL(SUM(a.amonestacion), 0) >= 3 THEN 1 ELSE 0 END suspender

               FROM usuario u
               LEFT JOIN amonestaciones a ON u.id = a.usuario_tecnico 
               WHERE u.tipo_usuario = 2
               GROUP BY u.id, u.nombre, u.apellido, u.nombre_usuario, u.correo";
        $result=$conex->prepare($sql);
        $result->execute();
        $resultado=$result->fetchAll();
        return $resultado;
    }

    public Function UsuariosTecnicosCorreo()
    {
        $conex=conectar();
        $sql= "SELECT u.id,
                      u.nombre_usuario nomtec,
                      u.correo cortec
               FROM usuario u
               WHERE u.id = :id";
        $result=$conex->prepare($sql);
        $result->execute(array(":id" => $this->id));
        $resultado=$result->fetchAll();
        return $resultado;
    }

    public function usuarioSuspendido()
    {
        $conex=conectar();
        $sql = "UPDATE usuario SET activo = 0 WHERE id=:id";
        $result=$conex->prepare($sql);
        $result->execute(array(":id" => $this->id));
        $resultado=$result->rowCount();
        
        return $resultado;
        if($resultado){
            return(true);
        } else {
            return(false);
        }
    }

}
?>