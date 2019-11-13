<?php
include_once 'conection.php';
//metodo que habilita el uso de sesiones en este archivo
session_start();
//clase  para la entidad Empleado
class empleado extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad empleado
    private $Querys  = array(
        "create" => "INSERT INTO empleado(id_tipo_empleado, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, password, correo, genero, telefono, activo, fecha_nacimiento) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12)",
        "delete" => "DELETE FROM empleado WHERE id_empleado = $1",
        "update"  => "UPDATE empleado SET  id_tipo_empleado = $1, primer_nombre=$2, segundo_nombre=$3, primer_apellido=$4,segundo_apellido=$5, usuario = $6, password = $7, correo = $8, genero = $9, telefono = $10, activo= $11, fecha_nacimiento= $12 WHERE id_empleado = $13",
        "disable"  => "UPDATE empleado SET  activo = false WHERE id_empleado = $1",
        "findAll" => "SELECT id_empleado, id_tipo_empleado, primer_nombre, segundo_nombre, primer_apellido,segundo_apellido, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado",
        "findAllActive" => "SELECT id_empleado, id_tipo_empleado, primer_nombre, segundo_nombre, primer_apellido,segundo_apellido, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado WHERE activo = true",
        "findById" => "SELECT id_empleado, id_tipo_empleado, primer_nombre, segundo_nombre, primer_apellido,segundo_apellido, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado  WHERE id_empleado= $1 ",
        "count" => "SELECT COUNT(id_empleado) FROM empleado",
        "findByUser" => "SELECT id_empleado, id_tipo_empleado, primer_nombre, segundo_nombre, primer_apellido,segundo_apellido, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado  WHERE usuario=  $1 "
    );
    public function __construct()
    {
        $this->conexion = parent::__construct();
    }

    /*********************************************************************/
    //Metodo para validar que el usuario igresado este en la base de datos
    public function getUserbyUser($name)
    {
        $query = $this->Querys['findByUser'];
        $result = pg_query_params($this->conexion, $query, array($name));
        if (pg_num_rows($result)) {
            $row = pg_fetch_assoc($result);
        } else {
            $row = null;
        }
        //devuelve el usuario logeado si se encuentra
        return $row;
    }

    /*********************************************************************/
    //Metodo para oboetener empleado por id_empleado este en la base de datos
    public function getUserbyId($idEmpleado)
    {
        $query = $this->Querys['findById'];
        $result = pg_query_params($this->conexion, $query, array($idEmpleado));
        if (pg_num_rows($result)) {
            $row = pg_fetch_assoc($result);
        } else {
            $row = null;
        }
        //devuelve el usuario logeado si se encuentra
        return $row;
    }

    /*********************************************************************/
    //Metodos que devuelve a todos los empleados
    public function getAllEmpleados()
    {
        $query = $this->Querys['findAll'];
        $result = pg_query($this->conexion, $query);
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los empleados
        return $allRows;
    }

    /*********************************************************************/
    //Metodos que devuelve a todos los empleados activos
    public function getAllActiveEmpleados()
    {
        $query = $this->Querys['findAllActive'];
        $result = pg_query($this->conexion, $query);
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los empleados
        return $allRows;
    }

    /*********************************************************************/
    //Metodo para crear una sesion por empleado
    public function createSessionByUser($user)
    {

        $_SESSION['idEmpleado'] = $user['id_empleado'];
        $_SESSION['tipoEmpleado'] = $user['id_tipo_empleado'];
        $_SESSION['usuario'] = $user['usuario'];
    }

    /*********************************************************************/
    //Metodo para verificar el estado de la sesion
    public function ValidateSession()
    {

        if (!isset($_SESSION['idEmpleado'])) {
            header("Location: login.php");
            exit();
        }
    }

    /*********************************************************************/
    //Metodo para verificar el estado de la sesion en la interfaz login
    public function ValidateSessionLogin()
    {

        if (isset($_SESSION['idEmpleado'])) {
            header("Location: index.php");
            exit();
        }
    }

    /*********************************************************************/
    //Metodo para encriptar la contraseña de un empleado
    public function EncryptPassword($userpassword)
    {
        if (isset($userpassword) && $userpassword != "") {
            $passwordHash = password_hash($userpassword, PASSWORD_DEFAULT);
        } else {
            $passwordHash = null;
        }
        return $passwordHash;
    }

    /*********************************************************************/
    //Metodo para validar que el usuario este o no este en la base de datos
    public function validateUser($name)
    {
        $query = $this->Querys['findByUser'];
        $result = pg_query_params($this->conexion, $query, array($name));
        if (pg_num_rows($result)) {
            $userFound = true;
        } else {
            $userFound = false;
        }
        //devuelve el estado de la busqueda
        return $userFound;
    }

    /*********************************************************************/
    //Metodo que crea un nuevo empleado en el sistema
    public function agregarEmpleado($array){
        if (is_bool($array['genero'])){
            $array['genero'] = ($array['genero']) ? 'true':'false';
        }
        $query = $this->Querys['create'];
        $result = pg_query_params($this->conexion, $query, array(
            $array['tipoempleado'], $array['primer_nombre'], $array['segundo_nombre'],
            $array['primer_apellido'], $array['segundo_apellido'], $array['usuario'],
            $array['password'], $array['email'], $array['genero'], $array['telefono'],
            $array['activo'], $array['fecha']));
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;
    }

    /*********************************************************************/
    //Metodo que modificar un empleado en el sistema
    public function modificarEmpleado($empleado){
        $empleado->genero = ($empleado->genero ? 'true':'false');
        $empleado->fecha_nacimiento = (new DateTime($empleado->fecha_nacimiento))->format('Y-m-d');
        $query = $this->Querys['update'];
        $result = pg_query_params($this->conexion, $query, array(
            $empleado->id_tipo_empleado, $empleado->primer_nombre, $empleado->segundo_nombre,
            $empleado->primer_apellido, $empleado->segundo_apellido,$empleado->usuario,
            $empleado->password,$empleado->correo, $empleado->genero, $empleado->telefono,
            $empleado->activo,$empleado->fecha_nacimiento, $empleado->id_empleado
        ));
        
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;        
    }

    /*********************************************************************/
    //Metodo que deshabilita un empleado en el sistema
    public function deshabilitarEmpleado($idEmpleado){
        $user = $this->getUserbyId($idEmpleado);
        if(!is_null($user) && $user["activo"] == 't'){
            $query = $this->Querys['disable'];
            pg_query_params($this->conexion, $query, array($idEmpleado));
            return true;
        }
        return false;
    }

    /*********************************************************************/
    //Metodo que elimina un empleado del sistema
    public function eliminarEmpleado($idEmpleado){
        $query = $this->Querys['delete'];
        $result = pg_query_params($this->conexion, $query, array($idEmpleado));
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;
    }
}
