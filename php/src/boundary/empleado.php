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
        "create" => "INSERT INTO empleado(id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)",
        "delete" => "DELETE FROM empleado WHERE id_empleado = $1",
        "update"  => "UPDATE empleado SET  id_tipo_empleado = $1, nombres =$2, apellidos = $3, usuarios = $4, password = $5, correo = $6, genero = $7, telefono = $8, activo= $9, fecha_nacimiento= $10 WHERE id_empleado = $11",
        "findAll" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado",
        "findById" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado  WHERE id_empleado= $1 ",
        "count" => "SELECT COUNT(id_empleado) FROM empleado",
        "findByUser" => "SELECT id_empleado, id_tipo_empleado, nombres, apellidos, usuario, password, correo, genero, telefono, activo, fecha_nacimiento FROM empleado  WHERE usuario=  $1 "
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
        $result = pg_query_params($this->conexion, $query, array($array['tipoempleado'],$array['nombres'], $array['apellidos'],$array['usuario'], $array['password'],$array['email'], $array['genero'], $array['telefono'], $array['activo'],$array['fecha']));
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;
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
