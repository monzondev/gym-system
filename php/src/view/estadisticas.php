<?php
session_start();
include_once '../boundary/empleado.php';
$login = new empleado();
$login->ValidateSession();
if ($_SESSION['tipoEmpleado']!=1) {
    header("Location: index.php");
    exit();
}
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Estadisticas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
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
    <script>
        /*
        $('#miembrosOptions').hover(function() {
            $('#navbarDropdownMiembros').trigger('click')
        })

        $('#cuentaOptions').hover(function() {
            $('#navbarDropdownCuenta').trigger('click')
        })
        $('#empleadosOptions').hover(function() {
            $('#empleados').trigger('click')
        })
        */
    </script>
</body>
</html>