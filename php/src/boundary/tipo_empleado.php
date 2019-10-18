<?php
include_once 'conection.php';
//clase  para la entidad Tipo empleado
class tipo_empleado  extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad tipo_empleado
    private $Querys  = array(
        "create" => "INSERT INTO tipo_empleado(nombre, descripcion) VALUES ($1,$2)",
        "delete" => "DELETE tipo_empleado WHERE id_tipo_empleado = $1",
        "update"  => "UPDATE tipo_empleado SET  nombre = $1, descripcion = $2 WHERE id_tipo_empleado = $3",
        "findAll" => "SELECT id_tipo_empleado, nombre, descripcion FROM tipo_empleado",
        "findById" => "SELECT id_tipo_empleado, nombre, descripcion FROM tipo_empleado  WHERE id_tipo_empleado = $1 ",
        "count" => "SELECT COUNT(id_tipo_empleado) FROM tipo_empleado"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }

    /*********************************************************************/

    //Metodo para buscar un tipo de empleado por id
    public function getTipoEmpleado($id)
    {
        $query = $this->Querys['findById'];
        $result = pg_query_params($this->conexion, $query, array($id));
        if (pg_num_rows($result)) {
            $row = pg_fetch_assoc($result);
        } else {
            $row = null;
        }
        //devuelve el usuario logeado si se encuentra
        return $row;
    }

    /*********************************************************************/
    //Metodo que obtiene todos los tipos de empleado
    public function getAllTipoEmpleado()
    {
        $query = $this->Querys['findAll'];
        $result = pg_query($this->conexion, $query);
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los tipos de empleados
        return $allRows;
    }
}

