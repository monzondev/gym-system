<?php
include_once '../boundary/empleado.php';
$Empleado = new empleado();



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
