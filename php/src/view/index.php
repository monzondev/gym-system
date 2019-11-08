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
    <title>Gym System</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h3>Miembros Proximos a Pagar:</h3>
                    <input type="text" class="form-control" placeholder="Nombre del miembro">
                </div>
                <div class="col-md-1"></div>
            </div>
            <br><br>
            <table class="table" style="widht: 50%">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo mensualidad</th>
                        <th scope="col">Fecha de Incio</th>
                        <th scope="col">Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan Pleitez</td>
                        <td>quicenal</td>
                        <td>2000-01-01</td>
                        <td>2000-01-01</td>
                    </tr>
                    <tr>
                        <td>Roberto Carlos</td>
                        <td>mensual</td>
                        <td>2000-01-01</td>
                        <td>2000-01-01</td>
                    </tr>
                    <tr>
                        <td>Alexander Monzon</td>
                        <td>semanal</td>
                        <td>2000-01-01</td>
                        <td>2000-01-01</td>
                    </tr>
                    <tr>
                        <td>Diana Magaña</td>
                        <td>mensual</td>
                        <td>2000-01-01</td>
                        <td>2000-01-01</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $('#miembrosOptions').hover(function() {
            $('#navbarDropdownMiembros').trigger('click')
        })

        $('#cuentaOptions').hover(function() {
            $('#navbarDropdownCuenta').trigger('click')
        })
        $('#empleadosOptions').hover(function() {
            $('#empleados').trigger('click')
        })
    </script>
</body>

</html>