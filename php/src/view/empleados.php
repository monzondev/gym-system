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
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tipo Empleado</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Usuario</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php
                        $empleados = $login->getAllEmpleados();
                        if(!is_null($empleados)){
                            foreach($empleados as $empleado){
                                echo "
                                    <tr data-id_empleado='".$empleado["id_empleado"]."'>
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
    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("#table_body tr").click(function(){
            $(this).addClass('table-info').siblings().removeClass('table-info');    
            var idEmpleado=$(this).attr("data-id_empleado");
            alert("La referencia del empleado es id_empleado="+idEmpleado);
        });
        
    </script>
</body>
</html>