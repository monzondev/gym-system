<?php
//clase  para la entidad Estado
include_once 'conection.php';
class estado extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad estado
    private $Querys  = array(
        "create" => "INSERT INTO estado(id_miembro, nombre, descripcion) VALUES ($1,$2,$3)",
        "delete" => "DELETE FROM estado WHERE id_estado = $1",
        "update"  => "UPDATE estado SET  nombre = $2, descripcionn = $3 WHERE id_estado = $1",
        "findAll" => "SELECT id_estado, nombre, descripcion FROM estado",
        "findById" => "SELECT id_estado, nombre, descripcion FROM estado  WHERE id_estado= $1",
        "count" => "SELECT COUNT(id_estado) FROM estado"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }

    //Metodos que devuelve a todos los empleados activos
    public function findAll()
    {
        $query = $this->Querys['findAll'];
        $result = pg_query($this->conexion, $query);
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los empleados
        return $allRows;
    }
}
