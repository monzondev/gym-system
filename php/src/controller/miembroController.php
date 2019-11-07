<?php
    include_once '../boundary/miembro.php';
    include_once '../boundary/empleado.php';
    $miembro = new miembro();
    $empleado = new empleado();
if (isset($_POST['userValidate'])) {
    if (isset($_POST['usuario'])  && $_POST['usuario'] != "") {
        $user = $miembro->validateUser($_POST['usuario']);
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

if (isset($_POST['agregarMiembro'])) {


    $identificador = $miembro->generateCode($_POST['apellido1'], $_POST['apellido2'], date("Y"));



        if ($_POST['genero'] == 1) {
            $genero = true;
        } elseif ($_POST['genero'] == 0) {
            $genero = false;
        }

        if (isset($_FILES["foto"])) {
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                    $nombre1 = "foto" . "_" . $_POST['usuario'].'.jpg';
                    $ruta1 = "../recursos/fotografias/" . $nombre1;
                    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta1);
                    $imagen = $nombre1;
            }
        }
        
        $altura =0.00;
        if (isset($_POST['altura']) && $_POST['altura'] != null  && $_POST['altura'] != "" ) {
            $altura = $_POST['altura'];
        }

        $peso =0.00;
        if (isset($_POST['peso']) && $_POST['peso'] != null  && $_POST['peso'] != "") {
            $peso = $_POST['peso'];
        }
        $arrayMiembro = [
            "tipomembresia" => $_POST['tipomembresia'],
            "primer_nombre" => $_POST['nombre1'],
            "segundo_nombre" => $_POST['nombre2'],
            "primer_apellido" => $_POST['apellido1'],
            "segundo_apellido" => $_POST['apellido2'],
            "usuario" => $_POST['usuario'],
            "foto" =>  $imagen,
            "identificador" => $identificador,
            "correo" => $_POST['email'],
            "genero" => $genero,
            "telefono" => $_POST['telefono'],
            "altura" => $altura,
            "peso" => $peso,
            "activo" => true,
            "fecha" => $_POST['fecha']
        ];

              if ($miembro->agregarMiembro($arrayMiembro)) {
                if (isset($_SESSION['AE'])) {
                    $_SESSION['AM'] = '1';
                    echo "<script language='javascript'>window.location='../view/miembros.php?'</script>;";
                    exit();
                } else {
                    $_SESSION['AM'] = '1';
                    echo "<script language='javascript'>window.location='../view/miembros.php'</script>;";
                    exit();
                }
            } else {
                if (isset($_SESSION['AE'])) {
                    $_SESSION['AM'] = '2';
                    echo "<script language='javascript'>window.location='../view/miembros.php'</script>;";
                } else {
                    $_SESSION['AM'] = '2';
                    echo "<script language='javascript'>window.location='../view/miembros.php'</script>;";
                    exit();
                }
            }
}

if (isset($_POST['getMiembro'])) {
    if (isset($_POST['id'])  && $_POST['id'] != "") {
        $user = $miembro->getMiembrobyId($_POST['id']);
        if ($user != null) {
            exit(json_encode($user));
        } else {
            exit(json_encode(null));
        }
    } else {
        exit(json_encode(null));
    }

   
}

if (isset($_GET['filtrar']) && $_GET['filtrar']) {
    $json = file_get_contents('php://input');
    $txt = (json_decode($json))->txt;
    $id_empleado = (json_decode($json))->id_empleado;
    $empleado = (object) $empleado->getUserbyId($id_empleado);    
    //code 1=Ok, 2=Bad, 3=Warning
    $response = array('message' => 'Mensaje', 'code' => 1);
    //Verificar si es administrador el que solicita
    if(isset($empleado) && $empleado->id_tipo_empleado == 1){
        //Verificar si esta vacio txt
        if($txt == ''){
            //Buscar todos si es vacio
            $miembros = $miembro->getAllActiveMiembros();
        }else{
            //Buscar coincidencia mas cercana
            $miembros = $miembro->getFilterNameId($txt);
        }
        echo json_encode($miembros);
        exit();
    }else{
        $response['code'] = 2;
        $response['message'] = 'No tiene permisos de administrador';        
    }
    echo json_encode($response);
    exit();
}


header('Location: /view/index.php');
exit();
?>