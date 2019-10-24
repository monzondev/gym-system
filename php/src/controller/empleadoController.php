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
    $hash = $Empleado->EncryptPassword($_POST['password']);
    $genero = ($_POST['genero']==1);
        
    $empleado = [
        "id_empleado" => $_POST['id_empleado'],
        "id_tipo_empleado" => $_POST['id_tipo_empleado'],
        "primer_nombre" => $_POST['primer_nombre'],
        "segundo_nombre" => $_POST['segundo_nombre'],
        "primer_apellido" => $_POST['primer_apellido'],
        "segundo_apellido" => $_POST['segundo_apellido'],
        "usuario" => $_POST['usuario'],
        "password" => $hash,
        "correo" => $_POST['correo'],
        "genero" => $genero,
        "telefono" => $_POST['telefono'],
        "activo" => true,
        "fecha_nacimiento" => $_POST['fecha_nacimiento']
    ];

    $findEmpleado = $Empleado->getUserbyId($empleado["id_empleado"]);
    //Comprobrar el id del empleado
    if(!is_null($findEmpleado["id_empleado"])){
        //Verificar si existes el nombre de usuario o ver si aun es el mismo nombre de usuario
        $allowUserName = ($Empleado->validateUser($empleado["usuario"])==false) || ($findEmpleado["usuario"]==$empleado["usuario"]);
        
        if($allowUserName){
            //Nombre de usuario disponible
            if ($Empleado->modificarEmpleado($empleado)) {
                //print_r("Disponible");
                $_SESSION['AE'] = '1';
                echo "<script language='javascript'>window.location='../view/empleados.php?'</script>;";
                exit();
            }else{
                //Error al modificar en la base de datos
                $_SESSION['AE'] = '2';
                echo "<script language='javascript'>window.location='../view/empleados.php?'</script>;";
                print_r("Error en al ingresar en DB");
            }            
        }else {
            //Nombre de usuario ya existe
            $_SESSION['AE'] = '2';
            echo "<script language='javascript'>window.location='../view/empleados.php?'</script>;";
            print_r("Error en al ingresar en DB");
        }        
    }else{
        //ID no coinciden
        print_r("ID No Corresponde a ningun usuario");
    }    
    exit();
}

if (isset($_GET['disableEmpleado']) && $_GET['disableEmpleado']) {
    $idEmpleado = $_POST['id_empleado'];
    $response = $Empleado->deshabilitarEmpleado($idEmpleado);    
    echo json_encode($response);
    exit();
}

header('Location: /view/index.php');
exit();
?>