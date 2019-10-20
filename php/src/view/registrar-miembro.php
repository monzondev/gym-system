<?php
session_start();
include_once '../boundary/empleado.php';
$login = new empleado();
$login->ValidateSession();
?>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registrar Miembro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1>En Desarrrolo</h1>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php
    /*********************************************************************************************************** */
    //CODFIGO DE EJEMPLO PARA AGREGAR UN MIEMBRO AL SISTEMA
    include_once '../boundary/miembro.php';
    $miembro = new miembro();

    $_POST['genero'] = 1;
    $_POST['tipomembresia'] = 1;
    $_POST['nombres'] = "Victor";
    $_POST['apellidos'] = "Umaña";
    $_POST['correo'] = "test123@gmail.com";
    $_POST['telefono'] = '75645323';
    $_POST['altura'] = 1.70;
    $_POST['peso'] = 150.50;
    $_POST['fecha'] = '2019-10-10';


    $usuario = $miembro->generateCode($_POST['apellidos'], "", date("Y"));
    if ($usuario != null) {
        echo "<center><h2>Codigo generado: " . $usuario . '</h2></center><br>';

        if ($_POST['genero'] == 1) {
            $genero = true;
        } else  if ($_POST['genero'] == 0) {
            $genero = false;
        }
        $arrayMiembro = [
            "tipomembresia" => $_POST['tipomembresia'],
            "nombres" => $_POST['nombres'],
            "apellidos" => $_POST['apellidos'],
            "usuario" => $usuario,
            "correo" => $_POST['correo'],
            "genero" => $genero,
            "telefono" => $_POST['telefono'],
            "altura" => $_POST['altura'],
            "peso" => $_POST['peso'],
            "activo" => true,
            "fecha" => $_POST['fecha']
        ];

        if ($miembro->agregarMiembro($arrayMiembro)) {
            echo '<center><h1>Miembro agregado con exito</h1></center>';
        } else {
            echo '<center><h1>Hubo un error al guardar el miembro</h1></center>';
        }
    }
    ?>
</body>

</html>