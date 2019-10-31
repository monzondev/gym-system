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
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Editar Trabajador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_editar">
                        <div class="form-group row">
                            <label for="usuario" class="col-sm-4 col-form-label">ID:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="id_empleado" name="id_empleado" placeholder="ID..." readonly="readonly" />                                
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
                                <input type="text" class="form-control" id="usuario" name="usuario" maxlength="32" placeholder="Usuario..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Primer Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" maxlength="32" placeholder="Primer Nombre..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Segundo Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" maxlength="64" placeholder="Segundo Nombre..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-sm-4 col-form-label">Primer Apellido:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" maxlength="32" placeholder="Primer Apellido..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-sm-4 col-form-label">Apellidos:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" maxlength="32" placeholder="Segundo Apellido..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="correo" class="col-sm-4 col-form-label">Correo:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="correo" name="correo" maxlength="64" placeholder="Correo..." />
                            </div>
                        </div>
                        <div id="changePassDiv" class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                            <div class="col-sm-8">
                                <button id="btn_password" type="button" class="btn btn-warning" title="Cambio de Contraseña">Cambiar Contraseña</button>
                            </div>
                        </div>
                        <div id="passDiv" class="form-group row d-none">
                            <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" maxlength="60" placeholder="Contraseña..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="genero" class="col-sm-4 col-form-label">Genero:</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="genero" value="1" />
                                    <label class="form-check-label" for="genero">Hombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="genero2" value="0" />
                                    <label class="form-check-label" for="genero2">Mujer</label>
                                </div>
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label for="telefono" class="col-sm-4 col-form-label">Telefono:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" placeholder="Telefono..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha_nacimiento" class="col-sm-4 col-form-label">Fecha Nacimiendo:</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="date" value="" id="fecha_nacimiento" name="fecha_nacimiento" />                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn_guardar" type="submit" class="btn btn-primary">Guardar</button>
                </div>
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
    <script>
        var selectedEmpleado = null;

        //Al Carga el documento mostrar las notificaciones pendientes en memoria
        $(document).ready(function() {
            if(localStorage.code != undefined && localStorage.message != undefined){
                switch (localStorage.code) {
                    case '1':
                        toastr.success(localStorage.message);
                        break;
                    case '2':
                        toastr.error(localStorage.message);
                        break;
                    case '3':
                        toastr.warning(localStorage.message);
                        break;
                }
                localStorage.removeItem("code");
                localStorage.removeItem("message");
            }            
        });
        $("#table_body tr").click(function() {
            $("#passDiv").addClass('d-none');
            $("#changePassDiv").removeClass('d-none');
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
                //Validar campos y Enviar Usuario
                selectedEmpleado.id_tipo_empleado = $("#id_tipo_empleado").val();
                selectedEmpleado.usuario = $("#usuario").val();
                selectedEmpleado.primer_nombre = $("#primer_nombre").val();
                selectedEmpleado.segundo_nombre = $("#segundo_nombre").val();
                selectedEmpleado.primer_apellido = $("#primer_apellido").val();
                selectedEmpleado.segundo_apellido = $("#segundo_apellido").val();
                selectedEmpleado.correo = $("#correo").val();
                selectedEmpleado.password = $("#password").val();
                selectedEmpleado.genero = $('#genero').prop('checked');
                selectedEmpleado.telefono = $("#telefono").val();
                selectedEmpleado.fecha_nacimiento =$("#fecha_nacimiento").val();
                $.ajax({
                    type: "POST",
                    url: "../controller/empleadoController.php?editEmpleado=true",
                    data: JSON.stringify(selectedEmpleado),
                    success:function (data) {
                        var response = jQuery.parseJSON(data);
                        if(response){
                            localStorage.setItem("code", response.code);
                            localStorage.setItem("message", response.message);
                            location.reload();
                        }
                    }
                });
            } else {
                alert("No se ha seleccionado un empleado");
            }
        });
        $("#btn_eliminarModal").click(function() {
            if (selectedEmpleado !== null) {
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
                    data: JSON.stringify(selectedEmpleado),
                    success:function (data) {
                        var response = jQuery.parseJSON(data);
                        if(response){
                            localStorage.setItem("code", response.code);
                            localStorage.setItem("message", response.message);
                            location.reload();
                        }
                    }
                });
            } else {
                alert("No se ha seleccionado un empleado");
            }
        });
        $("#btn_password").click(function() {
            $("#passDiv").removeClass('d-none');
            $("#changePassDiv").addClass('d-none');
        });
    </script>
</body>

</html>