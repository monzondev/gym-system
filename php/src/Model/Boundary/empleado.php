<?php
include_once 'conection.php';
//clase  para la entidad Empleado
class empleado extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad empleado
    private $Querys  = array(
        "create" => "INSERT INTO empleado(id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)",
        "delete" => "DELETE empleado WHERE id_empleado = $1",
        "update"  => "UPDATE empleado SET  id_tipo_empleado = $1, nombres =$2, apellidos = $3, usuarios = $4, password = $5, correo = $6, genero = $7, telefono = $8, activo= $9, fecha_nacimiento= $10 WHERE id_empleado = $11",
        "findAll" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado",
        "findById" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado  WHERE id_empleado= $1 ",
        "count" => "SELECT COUNT(id_empleado) FROM empleado"
    );
    public function __construct()
    {
        $this->conexion = parent::__construct();
    }

}
