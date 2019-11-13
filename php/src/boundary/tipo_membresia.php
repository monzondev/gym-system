<?php
include_once 'conection.php';
//clase  para la entidad Tipo Membresia
class tipo_membresia extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad tipo_membresia
    private $Querys  = array(
        "create" => "INSERT INTO tipo_membresia(nombre, precio, activo, dias, descripcion) VALUES ($1, $2 ,$3 ,$4, $5)",
        "delete" => "DELETE FROM tipo_membresia WHERE id_tipo_membresia = $1",
        "update"  => "UPDATE tipo_membresia SET  nombre = $1, precio =$2, activo = $3, dias = $4 descripcion = $5 WHERE id_tipo_membresia = $5",
        "findAll" => "SELECT id_tipo_membresia, nombre, precio, activo, dias, descripcion FROM tipo_membresia",
        "findById" => "SELECT id_tipo_membresia, nombre, precio, activo, dias, descripcion FROM tipo_membresia  WHERE id_tipo_membresia= $1 ",
        "count" => "SELECT COUNT(id_tipo_membresia) FROM tipo_membresia"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }

     /*********************************************************************/
    //Metodo que obtiene todos los tipos de empleado
    public function getAllTipoMembresia()
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
    //Metodo para buscar un tipo de empleado por id
    public function getTipoMembresia($id)
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

}
