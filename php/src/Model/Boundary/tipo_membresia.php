<?php
//clase  para la entidad Tipo Membresia
 class tipo_membresia{


//propiedades de la entidad
private $id_tipo_membresia;
private $nombre;
private $precio;
private $activo;
private $descripcion;
//consultas sql para la entidad tipo_membresia
private $Querys  = array(
    "create" => "INSERT INTO tipo_membresia(nombre,precio, activo, descripcion) VALUES (?,?,?,?)",
    "delete" => "DELETE tipo_membresia WHERE id_tipo_membresia = ?",
    "update"  => "UPDATE tipo_membresia SET  nombre = ?, precio =?, activo = ?, descripcion = ? WHERE id_tipo_membresia = ?",
    "findAll" => "SELECT id_tipo_membresia, nombre, precio, activo, descripcion FROM tipo_membresia",
    "findById" => "SELECT id_tipo_membresia, nombre, precio, activo, descripcion FROM tipo_membresia  WHERE id_tipo_membresia= ? ",
    "count" => "SELECT COUNT(id_tipo_membresia) FROM tipo_membresia");


//Metodos get para las propiedades

public function getIdTipoMembresia(){
    return $this->id_tipo_membresia;
}

public function getNombre(){
    return $this->nombre;
}

public function getPrecio(){
    return $this->precio;
}

public function getActivo(){
    return $this->activo;
}

public function getDescripcion(){
    return $this->descripcion;
}

//Metodos set para las propiedades

public function setIdTipoMembresia($idTipo){
    $this->id_tipo_membresia = $idTipo;
}

public function setNombre($nombre){
    $this->nombre=$nombre;
}

public function setPrecio($precio){
    $this->precio = $precio;
}

public function setActivo($activo){
    $this->activo = $activo;
}

public function setdescripcion($descripcion){
    $this->descripcion = $descripcion;
}

}