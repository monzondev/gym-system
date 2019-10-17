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
    <title>Empleados</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
</head>
<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tipo Empleado</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $empleados = $login->getAllEmpleados();
                        if(!is_null($empleados)){
                            foreach($empleados as $empleado){
                                echo "
                                    <tr>
                                        <td>".$empleado["id_tipo_empleado"]."</td>
                                        <td>".$empleado["nombres"]."</td>
                                        <td>".$empleado["apellidos"]."</td>
                                        <td>".$empleado["usuario"]."</td>
                                    </tr>
                                ";
                            }
                        }else{
                            echo "<tr><td>No se encontraron Empleados</td></tr>";
                        }                        
                    ?>                    
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
</body>
</html>