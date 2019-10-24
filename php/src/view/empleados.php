<?php
session_start();
include_once '../boundary/empleado.php';
$login = new empleado();
$login->ValidateSession();
if ($_SESSION['tipoEmpleado'] != 1) {
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
    <link rel="stylesheet" href="css/toastr.css">
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <br>
            <button id="btn_editar" type="button" data-target="#editarModal" data-toggle="modal" class="btn btn-info float-right" title="Seleccione un Empleado" disabled="true">Editar Empleado</button>
            <button id="btn_eliminarModal" type="button" data-target="#eliminarModal" data-toggle="modal" class="btn btn-danger float-right mr-2" title="Seleccione un Empleado" disabled="true">Eliminar Empleado</button>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php
                    $empleados = $login->getAllActiveEmpleados();
                    if (!is_null($empleados)) {
                        foreach ($empleados as $empleado) {
                            echo "
                                    <tr data-empleado='" . json_encode($empleado) . "'>                                        
                                        <td id='" . $empleado["id_empleado"] ."'>" . $empleado["usuario"] . "</td>
                                        <td>" . $empleado["primer_nombre"] . " " . $empleado["segundo_nombre"] . "</td>
                                        <td>" . $empleado["primer_apellido"] . " " . $empleado["segundo_apellido"] . "</td>                                        
                                    </tr>
                                ";
                        }
                    } else {
                        echo "<tr><td>No se encontraron Empleados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form id="form_editar" class="needs-validation" autocomplete="off" method="post" action="../controller/empleadoController.php?editEmpleado=true" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Trabajador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="usuario" class="col-sm-4 col-form-label">ID:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="id_empleado" name="id_empleado" placeholder="ID..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" readonly="readonly">
                                <div class="invalid-feedback">
                                    ID no valido
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <label for="tipoEmpleado" class="col-sm-4 col-form-label">Tipo Empleado:</label>
                            <div class="col-sm-8">
                                <select id="id_tipo_empleado" name="id_tipo_empleado" class="form-control" required>
                                    <!--option>EJEMPLO</option-->
                                    <?php
                                    include_once '../boundary/tipo_empleado.php';
                                    $te = new tipo_empleado();
                                    $tiposEmpleados = $te->getAllTipoEmpleado();
                                    if (!is_null($tiposEmpleados)) {
                                        foreach ($tiposEmpleados as $tipoEmpleado) {
                                            echo "<option value='" . $tipoEmpleado["id_tipo_empleado"] . "'>" . $tipoEmpleado["nombre"] . "</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No se encontraron resultados</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="usuario" class="col-sm-4 col-form-label">Usuario:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="usuario" name="usuario" maxlength="32" placeholder="Usuario..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese usuario
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Primer Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" maxlength="64" placeholder="Primer Nombre..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Primer Nombre
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Segundo Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" maxlength="64" placeholder="Segundo Nombre..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Segundo Nombre
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-sm-4 col-form-label">Primer Apellido:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" maxlength="64" placeholder="Primer Apellido..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Primer Apellido
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-sm-4 col-form-label">Apellidos:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" maxlength="64" placeholder="Segundo Apellido..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Segundo Apellido
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="correo" class="col-sm-4 col-form-label">Correo:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="correo" name="correo" maxlength="64" placeholder="Correo..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Correo
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" maxlength="60" placeholder="Contraseña..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Contraseña
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="genero" class="col-sm-4 col-form-label">Genero:</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="genero" value="1">
                                    <label class="form-check-label" for="genero">Hombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="genero2" value="0">
                                    <label class="form-check-label" for="genero2">Mujer</label>
                                </div>
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label for="telefono" class="col-sm-4 col-form-label">Telefono:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" placeholder="Telefono..." oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Telefono
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha_nacimiento" class="col-sm-4 col-form-label">Fecha Nacimiendo:</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="date" value="" id="fecha_nacimiento" name="fecha_nacimiento" oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" required="">
                                <div class="invalid-feedback">
                                    Ingrese Fecha Nacimiento
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btn_guardar" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div id="eliminarInfo" class="modal-body">
                Mensaje
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_cancelar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_eliminar" class="btn btn-primary">Eliminar</button>
            </div>
        </div>
    </div>
    

    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <?php
    if (isset($_SESSION['AE'])) {
        if ($_SESSION['AE'] == 1) { ?>
            <script>
                toastr.options.timeOut = 2000; //1.5s
                toastr.options.closeButton = true;
                toastr.remove();
                toastr.success('El empleado fue registrado con exito!');
            </script>
        <?php
                unset($_SESSION['AE']);
            } else if ($_SESSION['AE'] == 2) { ?>
            <script>
                toastr.options.timeOut = 2000; //1.5s
                toastr.options.closeButton = true;
                toastr.remove();
                toastr.error('Ah ocurrido unError al registrar el empleado');
            </script>
    <?php
            unset($_SESSION['AE']);
        }
    }
    ?>
    <script>
        var selectedEmpleado = null;

        $("#table_body tr").click(function() {
            $(this).addClass('table-info').siblings().removeClass('table-info');
            selectedEmpleado = jQuery.parseJSON($(this).attr("data-empleado"));
            $("#btn_editar").prop('disabled', false);
            $("#btn_eliminarModal").prop('disabled', false);
            if (selectedEmpleado !== null) {                
                $("#id_empleado").val(selectedEmpleado.id_empleado);
                $("#id_tipo_empleado").val(selectedEmpleado.id_tipo_empleado);
                $("#usuario").val(selectedEmpleado.usuario);
                $("#primer_nombre").val(selectedEmpleado.primer_nombre);
                $("#segundo_nombre").val(selectedEmpleado.segundo_nombre);
                $("#primer_apellido").val(selectedEmpleado.primer_apellido);
                $("#segundo_apellido").val(selectedEmpleado.segundo_apellido);
                $("#correo").val(selectedEmpleado.correo);
                $("#password").val("");
                $("#genero").prop('checked', selectedEmpleado.genero=='t');
                $("#genero2").prop('checked', selectedEmpleado.genero=='f');
                $("#telefono").val(selectedEmpleado.telefono);
                $("#fecha_nacimiento").val(selectedEmpleado.fecha_nacimiento);
            }
        });
        $("#btn_guardar").click(function() {
            if (selectedEmpleado !== null) {
                //Validar FORM
            } else {
                alert("No se ha seleccionado un empleado");
            }
        });
        $("#btn_eliminarModal").click(function() {
            if (selectedEmpleado !== null) {
                //Validar FORM
                var name = selectedEmpleado.primer_nombre+" "+selectedEmpleado.segundo_nombre;
                $("#eliminarInfo").text("Desea eliminar a "+ name + " de la base de datos?");
            } else {
                alert("No se ha seleccionado un empleado");
            }
        });
        $("#btn_eliminar").click(function() {
            if (selectedEmpleado !== null && selectedEmpleado.id_empleado != null) {
                //Eliminar
                $.ajax({
                    type: "POST",
                    url: "../controller/empleadoController.php?disableEmpleado=true",
                    data: {id_empleado : selectedEmpleado.id_empleado},
                    success:function (data) {
                        if(data){
                            location.reload();
                        }
                    }
                });                
            } else {
                alert("No se ha seleccionado un empleado");
            }
        });
        
        


        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms,
                function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        }, false);

        // Validaciones con JS
        $(function() {            
            $('#usuario').on('keypress', function(e) {
                if (e.which == 32)
                    return false;
            });
            $('#correo').on('keypress', function(e) {
                if (e.which == 32)
                    return false;
            });
            $('#password').on('keypress', function(e) {
                if (e.which == 32)
                    return false;
            });
            $('#telefono').on('keypress', function(e) {
                var charCode = (e.which) ? e.which : e.keyCode
                if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            });
        });
    </script>
</body>

</html>