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
    } else  if ($_POST['genero'] == 0) {
        $genero = false;
    }
    $array = [
        "tipoempleado" => $_POST['tipoempleado'],
        "primer_nombre" => $_POST['nombre1'],
        "segundo_nombre" => $_POST['nombre2'],
        "primer_apellido" => $_POST['apellido1'],
        "segundo_apellido" => $_POST['apellido2'],
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

if (isset($_GET['editEmpleado']) && $_GET['editEmpleado']) {
    $json = file_get_contents('php://input');
    $empleado = json_decode($json);
    //code 1=Ok, 2=Bad, 3=Warning
    $response = array('message' => 'Mensaje', 'code' => 1);
    //Comprobar que el id del empleado a editar
    if(isset($empleado) && isset($empleado->id_empleado) ){
        //Comprobar que existe en la base de datos
        $findEmpleado = $Empleado->getUserbyId($empleado->id_empleado);
        if(isset($findEmpleado) && isset($findEmpleado['id_empleado']) ){
            //Si la contraseña esta vacia no requiere cambio de contraseña
            if(empty($empleado->password)){
                //No se ha modificado la contraseña
                $empleado->password = $findEmpleado['password'];
            }else{
                //Se cambio la contraseña
                $empleado->password = $Empleado->EncryptPassword($empleado->password);
            }
            //Verificar si existes el nombre de usuario o ver si aun es el mismo nombre de usuario
            $allowUserName = ($Empleado->validateUser($empleado->usuario)==false) || ($findEmpleado["usuario"]==$empleado->usuario);
            if($allowUserName){
                //Modificamos al usuario
                if ($Empleado->modificarEmpleado($empleado)) {
                    $response['code'] = '1';
                    $response['message'] = 'Se ha modificado con exito';
                }else{
                    $response['code'] = '2';
                    $response['message'] = 'No ha podido modificar empleado';
                }
            }else{
                $response['code'] = '2';
                $response['message'] = 'No puede utilizar este nombre de usuario';
            }
        }else{
            $response['code'] = '2';
            $response['message'] = 'Este empleado no existe';
        }
    }else{
        $response['code'] = '2';
        $response['message'] = 'Empleado no posee ID';
    }
    echo json_encode($response);
    exit();
}

if (isset($_GET['disableEmpleado']) && $_GET['disableEmpleado']) {
    $json = file_get_contents('php://input');
    $empleado = json_decode($json);
    //code 1=Ok, 2=Bad, 3=Warning
    $response = array('message' => 'Mensaje', 'code' => 1);
    if($Empleado->deshabilitarEmpleado($empleado->id_empleado)){
        $response['code'] = '1';
        $response['message'] = 'Se ha eliminado empleado';
    }else{
        $response['code'] = '2';
        $response['message'] = 'El Empleado no existe';
    }
    echo json_encode($response);
    exit();
}

header('Location: /view/index.php');
exit();
?>