<?php
session_start();
include_once '../boundary/empleado.php';
include_once '../boundary/miembro.php';
$miembro = new miembro();
$login = new empleado();
$login->ValidateSession();
?>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Miembros</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/toastr.css">
</head>

<body>
    <?php include_once("navbar.php");


    $m = $miembro->getAllActiveMiembros();
    echo 'Todos los miembros <br>';
    if ($m != null) {
        foreach ($m as $key) {
            echo $key['usuario'];
            echo '<br>';
        }
    } else {
        echo 'no hay miembros activos';
    }

    $mf = $miembro->getMiembrobyId(1);
    echo '<br>';
    echo '<br>';
    echo 'un miembro <br>';

    if ($mf != null) {
        echo 'nombre '.$mf['primer_nombre'];
        echo '<br>';
        echo 'apellido '.$mf['primer_apellido'];
        echo '<br>';
        echo 'Usuario '.$mf['usuario'];
        echo '<br>';
    } else {
        echo 'no se encontro miembro';
    }

    ?>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1>En Desarrrolo</h1>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <?php

    if (isset($_SESSION['AM'])) {
        if ($_SESSION['AM'] == 1) { ?>
            <script>
                toastr.options.timeOut = 2000; //1.5s
                toastr.options.closeButton = true;
                toastr.remove();
                toastr.success('El miembro fue registrado con exito!');
            </script>
        <?php
                unset($_SESSION['AM']);
            } else if ($_SESSION['AM'] == 2) { ?>
            <script>
                toastr.options.timeOut = 2000; //1.5s
                toastr.options.closeButton = true;
                toastr.remove();
                toastr.error('Ah ocurrido un Error al registrar el miembro');
            </script>
    <?php
            unset($_SESSION['AM']);
        }
    }
    ?>
</body>

</html>