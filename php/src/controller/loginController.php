<?php
include_once '../boundary/empleado.php';
$Empleado = new empleado();

//Metodo para cerrar la sesion actual
if(isset($_GET['close']) && $_GET['close']==1){
    if (isset($_SESSION['idEmpleado'])) {
        session_start();
        session_destroy();
        header('Location: ../view/login.php');
        exit();
      }

}

    if (isset($_POST['usuario']) && isset($_POST['clave']) && $_POST['usuario'] !="" && $_POST['clave'] !="") {
        $user = $Empleado->getUserbyUser($_POST['usuario']);
        if ($user !=null) {
            $user_input = $_POST['clave'];
            if (password_verify($_POST['clave'], $user['password'])) {
                $response = ['success' => '1'];
                $Empleado->createSessionByUser($user);
            } else {
                $response = ['success' => '2'];
            }
        } else {
            $response = ['success' => '3'];
        }
    } else {
        $response = ['success' => '4'];
    }
    exit(json_encode($response));