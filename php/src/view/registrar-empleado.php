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
    <link rel="icon" type="image/png" href="img/favicon.png">
    <style>
    .error {
        font-size: 15px;
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
            <form class="needs-validation" novalidate id="form" method="post"
                action="../controller/empleadoController.php">
                <div class="form-row text-center tab-content">

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Primer Nombre</label>
                            <input id="nombre1" name="nombre1" onCopy="return false" autocomplete="off"
                                onDrag="return false" onDrop="return false" onPaste="return false"
                                onkeypress="return notNumbers(event);" maxlength="15" placeholder="Primer nombre" required
                                class="form-control">
                            <p id="error1" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Segundo Nombre</label>
                            <input id="nombre2" name="nombre2" onCopy="return false" autocomplete="off"
                                onDrag="return false" onDrop="return false" onPaste="return false"
                                onkeypress="return notNumbers(event);" maxlength="15" placeholder="Segundo nombre" required
                                class="form-control">
                            <p id="error10" class="text-danger error"> </p>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Primer Apellido</label>
                            <input class="form-control" onCopy="return false" autocomplete="off" onDrag="return false"
                                onDrop="return false" onPaste="return false" name="apellido1"
                                onkeypress="return notNumbers(event);" required id="apellido1" maxlength="15"
                                placeholder="Primer apellido" value="">
                            <p id="error2" class="text-danger error2"> </p>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Segundo Apellido</label>
                            <input class="form-control" onCopy="return false" autocomplete="off" onDrag="return false"
                                onDrop="return false" onPaste="return false" name="apellido2"
                                onkeypress="return notNumbers(event);" required id="apellido2" maxlength="15"
                                placeholder="Segundo apellido" value="">
                            <p id="error11" class="text-danger error11"> </p>
                        </div>
                    </div>
                </div>
                <div class="form-row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input class="form-control" onCopy="return false" autocomplete="off" onDrag="return false"
                                onDrop="return false" onPaste="return false" name="usuario" required id="usuario"
                                maxlength="15" onkeypress="return username(event);" placeholder="Nombre de usuario">
                            <p id="error3" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" autocomplete="off" onCopy="return false"
                                onDrag="return false" onDrop="return false" onPaste="return false" name="password"
                                required id="password" maxlength="15" placeholder="Contraseña">
                            <p id="error4" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" class="form-control" name="email" autocomplete="off"
                                onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"
                                required id="email" maxlength="50" placeholder="Correo Electronico">
                            <p id="error5" class="text-danger error"> </p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="tel" class="form-control" autocomplete="off" required id="telefono"
                                onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false"
                                name="telefono" onkeypress="return justNumbers(event);" minlength="8" maxlength="8"
                                placeholder="Telefono">
                            <p id="error6" class="text-danger error"> </p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fecha" required id="fecha">
                            <p id="error7" class="text-danger error"> </p>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
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
                                <input type="radio" id="R1M" value="1" name="genero" required>
                                <label class="control-label">Masculino</label>
                            </div>
                            <div class=" col-md-6 ">
                                <input type="radio" class="form-control-input" id="R1F" value="0" name="genero"
                                    required>
                                <label class="form-label">Femenino</label>
                            </div>
                        </div>
                        <p id="error9" class="text-danger error"> </p>
                    </div>
                    <input type="text" name="agregarEmpleado" hidden>
                </div>
                <br>
                <center>
                    <input class="btn btn-info btn-lg" style="width: 150px; height: 45px;" name="agregarEmpleado"
                        id="registrarE" type="button" value="Registrar">
                    <input class="btn btn-secondary btn-lg" style="width: 150px; height: 45px;" type="button"
                        onclick=" location.href='index.php'" value="Cancelar" />
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
    <script src="js/validacionesEmpleado.js"></script>


    <script>
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
        var patt = new RegExp(/^[A-Za-záéíóúñ\s]+$/g);
        return patt.test(String.fromCharCode(keynum));
    }

    function username(e) {        
        if (String.fromCharCode(e.which).match(/^[A-Za-z0-9\x08]$/)) {
            return true;
        }
        return false;
    }
    </script>
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