<?php
//clase  para la entidad Tipo empleado
 class tipo_empleado{


//propiedades de la entidad
private $id_tipo_empleado;
private $nombre;
private $descripcion;
//consultas sql para la entidad tipo_empleado
private $Querys  = array(
    "create" => "INSERT INTO tipo_empleado(nombre, descripcion) VALUES (?,?)",
    "delete" => "DELETE tipo_empleado WHERE id_tipo_empleado = ?",
    "update"  => "UPDATE tipo_empleado SET  nombre = ?, descripcion = ? WHERE id_tipo_empleado = ?",
    "findAll" => "SELECT id_tipo_empleado, nombre, descripcion FROM tipo_empleado",
    "findById" => "SELECT id_tipo_empleado, nombre, descripcion FROM tipo_empleado  WHERE id_tipo_empleado= ? ",
    "count" => "SELECT COUNT(id_tipo_empleado) FROM tipo_empleado");

//Metodos get para las propiedades

public function getIdTipoEmpleado(){
    return $this->id_tipo_empleado;
}

public function getNombre(){
    return $this->nombre;
}

public function getDescripcion(){
    return $this->descripcion;
}

//Metodos set para las propiedades

public function setIdTipoEmpleado($idTipo){
    $this->id_tipo_empleado = $idTipo;
}

public function setNombre($nombre){
    $this->nombre=$nombre;
}

public function setdescripcion($descripcion){
    $this->descripcion = $descripcion;
}

}