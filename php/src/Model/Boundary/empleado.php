<?php
//clase  para la entidad Empleado
class empleado {

    //propiedades de la entidad
    private $id_empleado;
    private $id_tipo_empleado;
    private $nombres;
    private $apellidos;
    private $usuario;
    private $password;
    private $correo;
    private $genero;
    private $telefono;
    private $activo;
    private $fecha_nacimiento;
    //consultas sql para la entidad empleado
    private $Querys  = array(
        "create" => "INSERT INTO empleado(id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento) VALUES (?,?,?,?,?,?,?,?,?,?)",
        "delete" => "DELETE empleado WHERE id_empleado = ?",
        "update"  => "UPDATE empleado SET  id_tipo_empleado = ?, nombres =?, apellidos = ?, usuarios = ?, password = ?, correo = ?, genero = ?, telefono = ?, activo= ?, fecha_nacimiento= ? WHERE id_empleado = ?",
        "findAll" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado",
        "findById" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado  WHERE id_empleado= ? ",
        "count" => "SELECT COUNT(id_empleado) FROM empleado");

    //Metodos get para las propiedades

    public function getIdEmpleado(){
        return $this->id_empleado;
    }

    public function getIdTipoEmpleado(){
        return $this->id_tipo_empleado;
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

    public function setIdEmpleado($idEmpleado){
       $this->id_empleado = $idEmpleado;
    }

    public function setIdTipoEmpleado($idTipoEmpleado){
        $this->id_tipo_empleado = $idTipoEmpleado;
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