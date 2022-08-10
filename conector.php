<?php

class Conector {

    private $servername;
    private $username;
    private $password;
    private $dbname;

    private $conexion;

    public function __construct() {
        $this->servername = "127.0.0.1";
        $this->username = "root";
        $this->password = "hipogoku1129";
        $this->dbname = "taller";

        $this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conexion->connect_error) {
            die("Falló la conexión: " . $this->conexion->connect_error);
        }
    }


    public function registrarTrabajo($nombre,$telefono,$reparacion,$precio,$descripcion,$clase,$estado,$patente,$marca){
        $nombre = $this->conexion->real_escape_string($nombre);
        $telefono = $this->conexion->real_escape_string($telefono);
        $reparacion = $this->conexion->real_escape_string($reparacion);
        $precio = $this->conexion->real_escape_string($precio);
        $descripcion = $this->conexion->real_escape_string($descripcion);
        $clase = $this->conexion->real_escape_string($clase);
        $estado = $this->conexion->real_escape_string($estado);
        $patente = $this->conexion->real_escape_string($patente);
        $marca = $this->conexion->real_escape_string($marca);
        $hoy = date('Y-m-d');
        
        $qry = "INSERT INTO trabajo (nombre,telefono,reparacion,precio,descripcion,clase,estado,patente,marca,fecha_inicio)
        VALUES ( '{$nombre}','{$telefono}','{$reparacion}','{$precio}','{$descripcion}','{$clase}','{$estado}','{$patente}','{$marca}','{$hoy}')";

        return ($this->conexion->query($qry));

    }
    
    public function mostrarListado(){
          
        $qry = "SELECT 
        id
        ,nombre
        ,telefono
        ,reparacion
        ,precio
        ,descripcion
        ,clase
        ,estado
        ,patente
        ,marca
        ,fecha_inicio
        ,fecha_entregado
        FROM trabajo
        order by  fecha_inicio ASC";

        return ($this->conexion->query($qry));

    }
    public function mostrarListadoID($trabajoID){
          
        $qry = "SELECT 
        id
        ,nombre
        ,telefono
        ,reparacion
        ,precio
        ,descripcion
        ,clase
        ,estado
        ,patente
        ,marca
        ,fecha_inicio
        ,fecha_entregado
        FROM trabajo
        WHERE id = {$trabajoID}
        order by  fecha_inicio ASC";

        return ($this->conexion->query($qry));

    }
    
    public function mostrarListadoFechaPaginado($buscar,$limit, $rpp){
          
        $qry = "SELECT 
        id
        ,nombre
        ,telefono
        ,reparacion
        ,precio
        ,descripcion
        ,clase
        ,estado
        ,patente
        ,marca
        ,fecha_inicio
        ,fecha_entregado
        FROM trabajo
        WHERE fecha_inicio = '{$buscar}'
        order by  fecha_inicio ASC
        LIMIT {$limit}, {$rpp}";

        return ($this->conexion->query($qry));

    }
  
    public function registrarEntrega($trabajoID){
        $trabajoID = $this->conexion->real_escape_string($trabajoID);
        $hoy = date('Y-m-d');
        
        $qry = "UPDATE
        trabajo
        SET
        fecha_entregado = '{$hoy}'
        WHERE id = {$trabajoID}";

        return ($this->conexion->query($qry));

    }
    public function actualizarTrabajo($id,$nombre, $telefono, $reparacion, $precio, $descripcion,$clase,$estado,$patente,$marca,$hoy,$hoyf) {

        if($hoyf == null){
            $qry = "UPDATE
            trabajo
            SET
            nombre = '{$nombre}',
            telefono = '{$telefono}',
            reparacion = '{$reparacion}',
            precio = '{$precio}',
            descripcion = '{$descripcion}',
            clase = '{$clase}',
            estado = '{$estado}',
            patente = '{$patente}',
            marca = '{$marca}',
            fecha_inicio = '{$hoy}'
            WHERE id = {$id}";
    
            return ($this->conexion->query($qry));
        }else{
            $qry = "UPDATE
            trabajo
            SET
            nombre = '{$nombre}',
            telefono = '{$telefono}',
            reparacion = '{$reparacion}',
            precio = '{$precio}',
            descripcion = '{$descripcion}',
            clase = '{$clase}',
            estado = '{$estado}',
            patente = '{$patente}',
            marca = '{$marca}',
            fecha_inicio = '{$hoy}',
            fecha_entregado = '{$hoyf}'
            WHERE id = {$id}";
    
            return ($this->conexion->query($qry));
        }
       

    }

    public function borrarTrabajo($trabajoID){
        $trabajoID = $this->conexion->real_escape_string($trabajoID);
 
        $qry="DELETE FROM 
        trabajo WHERE id = {$trabajoID}";
        $this->conexion->query($qry);
    }

    public function contarTrabajos () {
            $qry = "SELECT
            COUNT(1)
            FROM trabajo";
    
            return (($this->conexion->query($qry))->fetch_row())[0];
    }
    public function contarTrabajosPatenteTelefono ($buscar) {
        $qry = "SELECT
        COUNT(1)
        FROM trabajo
        WHERE patente = '{$buscar}'
        OR telefono = '{$buscar}'
        order by  fecha_inicio ASC";

        return (($this->conexion->query($qry))->fetch_row())[0];
}
    public function contarTrabajosFecha($buscar) {
        $qry = "SELECT
        COUNT(1)
        FROM trabajo
        WHERE fecha_inicio = '{$buscar}'
        order by  fecha_inicio ASC";

        return (($this->conexion->query($qry))->fetch_row())[0];
}

    public function contarTrabajosSemana() {
    $hoy = date('Y-m-d');
    $hoy1 = date('Y-m-d',strtotime($hoy.'+ 1 days'));
    $semana = date('Y-m-d',strtotime($hoy.'+ 2 days'));
    $ayer1 = date('Y-m-d',strtotime($hoy.'- 1 days'));
    $ayer = date('Y-m-d',strtotime($hoy.'- 2 days'));

    $qry = "SELECT
    COUNT(1)
    FROM trabajo
    WHERE fecha_inicio = '{$hoy}'
    or fecha_inicio = '{$hoy1}'
    or fecha_inicio = '{$semana}'
    or fecha_inicio = '{$ayer1}'
    or fecha_inicio = '{$ayer}'
    order by  fecha_inicio ASC";

    return (($this->conexion->query($qry))->fetch_row())[0];
}

    public function mostrarListadoPatenteTelefonoPaginado($buscar,$limit, $rpp){
          
        $qry = "SELECT 
        id
        ,nombre
        ,telefono
        ,reparacion
        ,precio
        ,descripcion
        ,clase
        ,estado
        ,patente
        ,marca
        ,fecha_inicio
        ,fecha_entregado
        FROM trabajo
        WHERE patente = '{$buscar}'
        OR telefono = '{$buscar}'
        order by  fecha_inicio ASC
        LIMIT {$limit}, {$rpp}";

        return ($this->conexion->query($qry));

    }
    public function mostrarListadoSemanaPaginado($limit, $rpp){
        $hoy = date('Y-m-d');
        $hoy1 = date('Y-m-d',strtotime($hoy.'+ 1 days'));
        $semana = date('Y-m-d',strtotime($hoy.'+ 2 days'));
        $ayer1 = date('Y-m-d',strtotime($hoy.'- 1 days'));
        $ayer = date('Y-m-d',strtotime($hoy.'- 2 days'));
      

        $qry = "SELECT 
        id
        ,nombre
        ,telefono
        ,reparacion
        ,precio
        ,descripcion
        ,clase
        ,estado
        ,patente
        ,marca
        ,fecha_inicio
        ,fecha_entregado
        FROM trabajo
        WHERE fecha_inicio = '{$hoy}'
        or fecha_inicio = '{$hoy1}'
        or fecha_inicio = '{$semana}'
        or fecha_inicio = '{$ayer1}'
        or fecha_inicio = '{$ayer}'
        order by  fecha_inicio ASC 
        LIMIT {$limit}, {$rpp}";

        return ($this->conexion->query($qry));

    }
    public function cargarTrabajosPaginado ($limit, $rpp) {
          
        $qry = "SELECT 
        id
        ,nombre
        ,telefono
        ,reparacion
        ,precio
        ,descripcion
        ,clase
        ,estado
        ,patente
        ,marca
        ,fecha_inicio
        ,fecha_entregado
        FROM trabajo
        order by  fecha_inicio ASC 
        LIMIT {$limit}, {$rpp}";

        return ($this->conexion->query($qry));
    }
   
    public function login($usuario, $passwd) {
        
        $usuario = $this->conexion->real_escape_string($usuario);
        $passwd = $this->conexion->real_escape_string($passwd);

        $qry = "SELECT
        nombre,
        password
        FROM usuario
        WHERE password = '{$passwd}'
        AND nombre = '{$usuario}'";

        return ($this->conexion->query($qry));
    }
}
