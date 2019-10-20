<?php
include_once '../boundary/empleado.php';
$Empleado = new empleado();


if (isset($_POST['userValidate'])) {
    if (isset($_POST['usuario'])  && $_POST['usuario'] != "") {
        $user = $Empleado->validateUser($_POST['usuario']);
        if ($user != null) {
            $response = ['success' => '2'];
        } else {
            $response = ['success' => '1'];
        }
    } else {
        $response = ['success' => '3'];
    }

    exit(json_encode($response));
}

if (isset($_POST['agregarEmpleado'])) {

    //creando contraseña cifrada
    $hash = $Empleado->EncryptPassword($_POST['password']);
    //codificando genero del nuevo empleado
    if ($_POST['genero'] == 1) {
        $genero = true;
    } else  if ($_POST['genero'] == 2) {
        $genero = false;
    }
    $array = [
        "tipoempleado" => $_POST['tipoempleado'],
        "nombres" => $_POST['nombres'],
        "apellidos" => $_POST['apellidos'],
        "usuario" => $_POST['usuario'],
        "password" => $hash,
        "email" => $_POST['email'],
        "genero" => $genero,
        "telefono" => $_POST['telefono'],
        "activo" => true,
        "fecha" => $_POST['fecha']
    ];

    if ($Empleado->agregarEmpleado($array)) {
        if (isset($_SESSION['AE'])) {
            $_SESSION['AE'] = '1';
            echo "<script language='javascript'>window.location='../view/empleados.php?'</script>;";
            exit();
        } else {
            $_SESSION['AE'] = '1';
            echo "<script language='javascript'>window.location='../view/empleados.php'</script>;";
            exit();
        }
    } else {
        if (isset($_SESSION['AE'])) {
            $_SESSION['AE'] = '2';
            echo "<script language='javascript'>window.location='../view/empleados.php'</script>;";
        } else {
            $_SESSION['AE'] = '2';
            echo "<script language='javascript'>window.location='../view/empleados.php'</script>;";
            exit();
        }
    }
} 
