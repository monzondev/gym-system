<?php
include_once '../Model/Boundary/empleado.php';
$Empleado = new empleado();
if ( isset($_POST['usuario']) && isset($_POST['clave']) && $_POST['usuario'] !="" && $_POST['clave'] !="" ) {
    $user = $Empleado->getUserbyUser($_POST['usuario']);
    if($user !=null){
        $user_input = $_POST['clave'];
        if (password_verify($_POST['clave'], $user['password'])) {
            $response = ['success' => '1'];
            $Empleado->createSessionByUser($user);
        }else{
            $response = ['success' => '2'];
        }
    } else {
        $response = ['success' => '3'];
    }
}else{
    $response = ['success' => '4'];
}
exit(json_encode($response));
