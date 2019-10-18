<?php
session_start();
include_once '../boundary/empleado.php';
include_once '../boundary/tipo_empleado.php';
$tipoEmpleado =  new tipo_empleado();
$login = new empleado();
$login->ValidateSession();
$tipos =  $tipoEmpleado->getAllTipoEmpleado();
?>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registrar Empleado</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/toastr.css">
    <style>
    .error{
        font-size: 17px;
    }
    </style>
</head>

<body>

    <?php include_once("navbar.php"); ?>
    <div class="container card">
        <div class="card-header d-flex justify-content-center">
            <h2>Registro de Empleados</h2>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate id="form" method="post" action="../controller/empleadoController.php">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input id="nombres" name="nombres" onkeypress="return notNumbers(event);" maxlength="30" placeholder="Nombre" required class="form-control">
                            <p id="error1" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input class="form-control" name="apellidos" onkeypress="return notNumbers(event);" required id="apellidos" maxlength="30" placeholder="Apellidos" value="">
                            <p id="error2" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input class="form-control" name="usuario" required id="usuario" maxlength="15" placeholder="Nombre de usuario">
                            <p id="error3" class="text-danger error"> </p>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="password" required id="password" maxlength="15" placeholder="Contraseña">
                            <p id="error4" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" class="form-control" name="email" required id="email" maxlength="50" placeholder="Correo Electronico">
                            <p id="error5" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="tel" class="form-control" required id="telefono" name="telefono" onkeypress="return justNumbers(event);" minlength="8" maxlength="8" placeholder="Telefono">
                            <p id="error6" class="text-danger error"> </p>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fecha" required id="fecha">
                            <p id="error7" class="text-danger error"> </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="control-label">Tipo de empleado:</label>
                            <select class="form-control" name="tipoempleado" id="tipoempleado" required>
                                < <option value="0" disabled selected="selected">Seleccione un tipo...</option>
                                    <?php
                                    foreach ($tipos as $valores) {
                                        echo '<option value="' . $valores['id_tipo_empleado'] . '">' . $valores['nombre'] . '</option>';
                                    }
                                    ?>

                            </select>

                            <p id="error8" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3  " style="padding-left: 30px;">
                    
                        <label class="control-label">Genero:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="radio"  id="R1M" value="1" name="genero" required>
                                <label class="control-label" >Masculino</label>
                            </div>
                            <div class=" col-md-6 ">
                                <input type="radio" class="form-control-input" id="R1F" value="0" name="genero" required>
                                <label class="form-label" >Femenino</label>
                            </div>
                        </div>
                        <p id="error9" class="text-danger error"> </p>
                    
                    </div>
                </div>
                <br>
                <center>
                    <input class="btn btn-info btn-lg" style="width: 150px; height: 45px;" name="agregarEmpleado" id="registrarE" type="button"  value ="Registrar" >
                    <input class="btn btn-secondary btn-lg" style="width: 150px; height: 45px;" type="button" onclick=" location.href='index.php'" value="Cancelar" />
                </center>
            </form>
        </div>
        <div class="card-footer">
        </div>

    </div>

    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-validate.js"></script>
    <script src="js/toastr.js"></script>
    <script src="js/validaciones.js"></script>
    <script>
    </script>
    <script>
         
         //valueDefecto()

        function valueDefecto(){
        $("#nombres").val('Alexander');
        $("#apellidos").val('Monzon');
        $("#usuario").val('alex');
        $("#password").val('monzon');
        $("#email").val('alexandermm2011@gmail.com');
        $("#telefono").val('75523179');
        $("#fecha").val('2018-01-01');
        $("#tipoempleado").val('1');
        $("#R1M").prop('checked',true);

        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        function notNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            var keyCode = document.all ? e.which : e.keyCode;
            if ((keynum == 8) || (keynum == 46) || (keyCode == 37) || (keyCode == 39)) {
                return true;
            }
            var patt = new RegExp(/^[A-Za-z\s]+$/g);
            return patt.test(String.fromCharCode(keynum));
        }
    </script>
</body>

</html>