<?php
    include_once '../boundary/miembro.php';
    $miembro = new miembro();
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
            "altura" => $_POST['altura'],
            "peso" => $_POST['peso'],
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