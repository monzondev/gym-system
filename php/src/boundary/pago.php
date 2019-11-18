<?php
//clase  para la entidad Pago
include_once 'conection.php';
class pago extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad pago
    private $Querys  = array(
        "create" => "INSERT INTO pago(id_miembro, id_empleado, id_tipo_membresia, fecha, monto) VALUES ($1,$2,$3,$4,$5)",
        "delete" => "DELETE FROM pago WHERE id_pago = $1",
        "update"  => "UPDATE pago SET  id_miembro = $1, id_empleado =$2, id_tipo_membresia = $3, date_time = $4, monton = $5 WHERE id_pago = $6",
        "findAll" => "SELECT id_pago, id_miembro, id_empleado, id_tipo_membresia, date_time, monto FROM pago",
        "findById" => "SELECT id_pago, id_miembro, id_empleado, id_tipo_membresia, date_time, monto FROM pago  WHERE id_pago= $1 ",
        "count" => "SELECT COUNT(id_pago) FROM pago"
    );

    public function __construct()
    {
        $this->conexion = parent::__construct();
    }

     /*********************************************************************/
    //Metodo que agrega un pago al sistema
    public function agregarPago($array){

        $query = $this->Querys['create'];
        $result = pg_query_params($this->conexion, $query, array(
            $array['id_miembro'], $array['id_empleado'],
            $array['id_tipo_membresia'],
            $array['fecha'], $array['monto']));
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;
    }
}
