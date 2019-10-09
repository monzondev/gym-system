<?php
//clase  para la entidad Pago
include_once 'conection.php';
class pago extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad pago
    private $Querys  = array(
        "create" => "INSERT INTO pago(id_miembro, id_empleado, id_tipo_membresia, date_time, monto) VALUES (?,?,?,?,?)",
        "delete" => "DELETE pago WHERE id_pago = ?",
        "update"  => "UPDATE pago SET  id_miembro = ?, id_empleado =?, id_tipo_membresia = ?, date_time = ?, monton = ? WHERE id_pago = ?",
        "findAll" => "SELECT id_pago, id_miembro, id_empleado, id_tipo_membresia, date_time, monto FROM pago",
        "findById" => "SELECT id_pago, id_miembro, id_empleado, id_tipo_membresia, date_time, monto FROM pago  WHERE id_pago= ? ",
        "count" => "SELECT COUNT(id_pago) FROM pago"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }
}
