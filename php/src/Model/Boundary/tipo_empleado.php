<?php
include_once 'conection.php';
//clase  para la entidad Tipo empleado
class tipo_empleado  extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad tipo_empleado
    private $Querys  = array(
        "create" => "INSERT INTO tipo_empleado(nombre, descripcion) VALUES (?,?)",
        "delete" => "DELETE tipo_empleado WHERE id_tipo_empleado = ?",
        "update"  => "UPDATE tipo_empleado SET  nombre = ?, descripcion = ? WHERE id_tipo_empleado = ?",
        "findAll" => "SELECT id_tipo_empleado, nombre, descripcion FROM tipo_empleado",
        "findById" => "SELECT id_tipo_empleado, nombre, descripcion FROM tipo_empleado  WHERE id_tipo_empleado= ? ",
        "count" => "SELECT COUNT(id_tipo_empleado) FROM tipo_empleado"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }
}
