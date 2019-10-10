<?php
session_start();
include_once '../Model/Boundary/empleado.php';
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
    <link rel='stylesheet' type='text/css' media='screen' href='Style/css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='Style/css/simple-grid.css'>
</head>
<body>
    <?php include_once("navbar.php");?>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10" style="height:100vh;">
            <h1>En Desarrollo</h1>
        </div>
        <div class="col-1"></div>
    </div>
    
</body>
</html>