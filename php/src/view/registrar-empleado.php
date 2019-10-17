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
    <title>Registrar Miembro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container card">
        <form class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustomUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                        </div>
                        <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">City</label>
                    <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom04">State</label>
                    <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                    <div class="invalid-feedback">
                        Please provide a valid state.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom05">Zip</label>
                    <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-sm" type="submit">Submit form</button>
        </form>
    </div>
    <br><br><br><br>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <form class="form-horizontal" name="f1" id="form1" method="post" action="../controller/empleadoController.php">
                        <div class="card card-info">
                            <div class="card-header">
                                <h2 class="card-title">Registrar un nuevo empleado</h2>
                            </div>
                            <br><br>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="nombres">Nombres:</label>
                                            <input type="text" name="nombres" required id="nombrs" maxlength="30" class="form-control" placeholder="Nombres" value="">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="usuario">Usuario:</label>
                                            <input type="text" name="usuario" required id="usuario" maxlength="15" class="form-control" placeholder="Usuario" value="">
                                        </div>
                                        <!-- /.form-group -->

                                        <div class="form-group">
                                            <label for="password">Contraseña:</label>
                                            <input type="password" name="password" required id="password" maxlength="15 " class="form-control">
                                            <input type="checkbox" onclick="mostrarContrasena()">Mostrar Contraseña
                                        </div>
                                        <!-- /.form-group -->

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="row">
                                                    <label>Genero</label>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-md-6">
                                                        <!-- Group of default radios - option 1 -->
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" value='1' id="maleRB" required name="genero">
                                                            <label class="custom-control-label" for="maleRB">Masculino</label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <!-- Group of default radios - option 1 -->
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" value='0' id="femaleRB" name="genero">
                                                            <label class="custom-control-label" for="femaleRB">Femenino</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tipo de empleado:</label>
                                            <select class="form-control" name="tipoempleado">
                                                <option value="" disabled selected="selected">Seleccione un tipo...</option>
                                                <?php
                                                foreach ($tipos as $valores) {
                                                    echo '<option value="' . $valores['id_tipo_empleado'] . '">' . $valores['nombre'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Apellidos:</label>
                                            <input type="text" name="apellidos" required id="apellidos" maxlength="30" class="form-control" placeholder="Apellidos" value="">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Correo electr&oacute;nico:</label>
                                            <input type="email" name="email" required id="email" maxlength="30" class="form-control" placeholder="Correo" value="">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="tel">Tel&eacute;fono</label>
                                            <input type="text" name="telefono" required id="telefono" onkeypress="return justNumbers(event);" minlength="8" maxlength="8" class="form-control" placeholder="Tel." value="">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="fechaN">Fecha de nacimiento</label>
                                            <input type="date" name="fecha" required id="fecha" maxlength="8" class="form-control" value="">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                            <br><br><br>
                            <div class="card-footer">
                                <button class="btn btn-primary mr5" name="agregarempleado" id="saveForm1" type="submit">Guardar</button>
                                <input class="btn btn-default" type="button" onclick=" location.href='index.php'" value="Cancelar" />
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </form>
                    <!-- /form -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
        <div class="col-md-2"></div>
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

        function mostrarContrasena() {
            var tipo = document.getElementById("password");
            if (tipo.type == "password") {
                tipo.type = "text";
            } else {
                tipo.type = "password";
            }
        }
    </script>
    <script>
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
    </script>
</body>

</html>