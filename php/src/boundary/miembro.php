<?php
//clase  para la entidad Empleado
include_once 'conection.php';
class miembro  extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad miembro
    private $Querys  = array(
        "create" => "INSERT INTO empleado(id_tipo_membresia, nombres, apellidos, usuario, correo, genero, telefono, activo, fecha_nacimiento) VALUES (?,?,?,?,?,?,?,?,?,?)",
        "delete" => "DELETE miembro WHERE id_miembro = ?",
        "update"  => "UPDATE miembro SET  id_tipo_membresia = ?, nombres =?, apellidos = ?, usuarios = ?, correo = ?, genero = ?, telefono = ?, activo= ?, fecha_nacimiento= ? WHERE id_empleado = ?",
        "findAll" => "SELECT id_miembro, id_tipo_membresia, nombres, apellidos, usuario, correo, genero, telefono, activo, fecha_nacimiento FROM miembro",
        "findById" => "SELECT id_miembro, id_tipo_membresia, nombres, apellidos, usuario, correo, genero, telefono, activo, fecha_nacimiento FROM miembro  WHERE id_miembro= ? ",
        "count" => "SELECT COUNT(id_miembro) FROM miembro"
    );
    public function __construct()
    {
        $this->conexion = parent::__construct();
    }
}
