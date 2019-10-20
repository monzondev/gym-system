<?php
include_once 'conection.php';
//clase  para la entidad Tipo Membresia
class tipo_membresia extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad tipo_membresia
    private $Querys  = array(
        "create" => "INSERT INTO tipo_membresia(nombre,precio, activo, descripcion) VALUES (?,?,?,?)",
        "delete" => "DELETE FROM tipo_membresia WHERE id_tipo_membresia = ?",
        "update"  => "UPDATE tipo_membresia SET  nombre = ?, precio =?, activo = ?, descripcion = ? WHERE id_tipo_membresia = ?",
        "findAll" => "SELECT id_tipo_membresia, nombre, precio, activo, descripcion FROM tipo_membresia",
        "findById" => "SELECT id_tipo_membresia, nombre, precio, activo, descripcion FROM tipo_membresia  WHERE id_tipo_membresia= ? ",
        "count" => "SELECT COUNT(id_tipo_membresia) FROM tipo_membresia"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }
}
