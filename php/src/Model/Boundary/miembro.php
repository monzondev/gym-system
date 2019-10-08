<?php
//clase  para la entidad Empleado
class empleado {

    //propiedades de la entidad
    private $id_miembro;
    private $id_tipo_membresia;
    private $nombres;
    private $apellidos;
    private $usuario;
    private $correo;
    private $genero;
    private $telefono;
    private $activo;
    private $fecha_nacimiento;
    //consultas sql para la entidad miembro
    private $Querys  = array(
        "create" => "INSERT INTO empleado(id_tipo_membresia, nombres, apellidos, usuario, correo, genero, telefono, activo, fecha_nacimiento) VALUES (?,?,?,?,?,?,?,?,?,?)",
        "delete" => "DELETE miembro WHERE id_miembro = ?",
        "update"  => "UPDATE miembro SET  id_tipo_membresia = ?, nombres =?, apellidos = ?, usuarios = ?, correo = ?, genero = ?, telefono = ?, activo= ?, fecha_nacimiento= ? WHERE id_empleado = ?",
        "findAll" => "SELECT id_miembro, id_tipo_membresia, nombres, apellidos, usuario, correo, genero, telefono, activo, fecha_nacimiento FROM miembro",
        "findById" => "SELECT id_miembro, id_tipo_membresia, nombres, apellidos, usuario, correo, genero, telefono, activo, fecha_nacimiento FROM miembro  WHERE id_miembro= ? ",
        "count" => "SELECT COUNT(id_miembro) FROM miembro");

    //Metodos get para las propiedades

    public function getIdMiembro(){
        return $this->id_mimebro;
    }

    public function getIdTipoMembresia(){
        return $this->id_tipo_membresia;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getActivo(){
        return $this->activo;
    }

    public function getFechaNacimiento(){
        return $this->fecha_nacimiento;
    }

    //Metodos set para las propiedades

    public function setIdMiembro($idMiembro){
       $this->id_miembro = $idMiembro;
    }

    public function setIdTipoMembresia($idTipoMembresia){
        $this->id_tipo_membresia = $idTipoMembresia;
    }

    public function setNombres($nombres){
       $this->nombres = $nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function setUsuario($usuario){
       $this->usuario = $usuario;
    }

    public function setPassword($password){
       $this->password = $password;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function setGenero($genero){
        $this->genero = $genero;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function setActivo($activo){
        $this->activo = $activo;
    }

    public function setFechaNacimiento($fechaNacimiento){
        $this->fecha_nacimiento = $fechaNacimiento;
    }
}