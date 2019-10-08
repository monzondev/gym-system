<?php
//clase  para la entidad Pago
 class tipo_membresia{


//propiedades de la entidad
private $id_pago;
private $id_miembro;
private $id_empleado;
private $id_tipo_membresia;
private $fecha;
private $monto;
//consultas sql para la entidad pago
private $Querys  = array(
    "create" => "INSERT INTO tipo_membresia(id_miembro, id_empleado, id_tipo_membresia, fecha, monto) VALUES (?,?,?,?,?)",
    "delete" => "DELETE pago WHERE id_pago = ?",
    "update"  => "UPDATE pago SET  id_miembro = ?, id_empleado =?, id_tipo_membresia = ?, fecha = ?, monton = ? WHERE id_pago = ?",
    "findAll" => "SELECT id_pago, id_miembro, id_empleado, id_tipo_membresia, fecha, monto FROM pago",
    "findById" => "SELECT id_pago, id_miembro, id_empleado, id_tipo_membresia, fecha, monto FROM pago  WHERE id_pago= ? ",
    "count" => "SELECT COUNT(id_pago) FROM pago");

//Metodos get para las propiedades

public function getIdPago(){
   return $this->id_pago;
}

public function getIdMiembro(){
    return $this->id_mimebro;
}

public function getIdEmpleado(){
    return $this->id_empleado;
}

public function getIdTipoMembresia(){
    return $this->id_tipo_membresia;
}

public function getFecha(){
    return $this->fecha;
}

public function getMonto(){
    return $this->monto;
}

//Metodos get para las propiedades

public function setIdPago($idPago){
   $this->id_pago = $idPago;
}

public function setIdMiembro($idMiembro){
    $this->id_miembro = $idMiembro;
}

public function setIdEmpleado($idEmpleado){
    $this->id_empleado = $idEmpleado;
}

public function setIdTipoMembresia($idTipo){
    $this->id_tipo_membresia = $idTipo;
}

public function setFecha($fecha){
    $this->fecha = $fecha;
}

public function setMonto($monto){
    $this->monto = $monto;
}

 }