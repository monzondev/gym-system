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
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container card">
        <div class="card-header d-flex justify-content-center">
            <h2>Registro de Empleados</h2>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate id="test" method="post" action="../controller/empleadoController.php">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Nombre</label>
                        <input type="text" class="form-control" name="nombres" required id="nombres" onkeypress="return notSpaces(event);" maxlength="30" placeholder="Nombre" value="">

                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Apellido</label>
                        <input type="text" class="form-control" name="apellidos" onkeypress="return notSpaces(event);" required id="apellidos" maxlength="30" placeholder="Apellido" value="">
                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Usuario</label>
                        <div class="input-group">
                            <input type="text" class="form-control" onkeypress="return notSpaces(event);" name="usuario" required id="usuario" maxlength="15" placeholder="Nombre de usuario" aria-describedby="inputGroupPrepend">
                            <div class="invalid-feedback">
                                Campo Requerido
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom03">Contraseña</label>
                        <input type="password" class="form-control" name="password"onkeypress="return notSpaces(event);"  required id="password" maxlength="15" placeholder="Contraseña">

                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom04">Correo</label>
                        <input type="email" class="form-control" name="email" required id="email" maxlength="50" placeholder="Correo Electronico">

                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom05">Telefono</label>
                        <input type="tel" class="form-control" required id="telefono" name="telefono" onkeypress="return justNumbers(event);" minlength="8" maxlength="8" placeholder="Telefono">

                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fecha" required id="fecha">

                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                    <br>
                    <div class="col-md-4 mb-3">
                        <label class="control-label">Tipo de empleado:</label>
                        <select class="form-control" name="tipoempleado" required>
                            < <option value="" disabled selected="selected">Seleccione un tipo...</option>
                                <?php
                                foreach ($tipos as $valores) {
                                    echo '<option value="' . $valores['id_tipo_empleado'] . '">' . $valores['nombre'] . '</option>';
                                }
                                ?>

                        </select>

                        <div class="invalid-feedback">
                            Campo Requerido
                        </div>
                    </div>
                    <div class="col-md-4 mb-3  " style="padding-left: 30px;">
                        <label class="control-label">Genero:</label>
                        <div class="row">
                            <div class="custom-control custom-radio col-md-6">
                                <input type="radio" class="custom-control-input" id="customControlValidation2" value="1" name="radio-stacked" required>
                                <label class="custom-control-label" for="customControlValidation2">Masculino</label>
                                <br>
                                <div class="invalid-feedback">Campo Requerido</div>
                            </div>
                            <div class="custom-control custom-radio mb-3  col-md-6 ">
                                <input type="radio" class="custom-control-input" id="customControlValidation3" value="0" name="radio-stacked" required>
                                <label class="custom-control-label" for="customControlValidation3">Femenino</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <center>
                    <button class="btn btn-info btn-lg" style="width: 150px; height: 45px;" name="agregarempleado" type="submit">Registrar</button>
                    <input class="btn btn-secondary btn-lg" style="width: 150px; height: 45px;" type="button" onclick=" location.href='index.php'" value="Cancelar" />
                </center>
            </form>
        </div>
        <div class="card-footer">
        </div>

    </div>



    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        function notSpaces(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46) || (keynum == 37) || (keynum == 39))
                return true;

            return /\w/.test(String.fromCharCode(keynum));
        }
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

  
            $('nombres').on('keypress', function(e) {
                if (e.which == 32)
                    return false;
            });

    </script>
</body>

</html>