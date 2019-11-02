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
                    <tr>
                        <td>No disponibles</td>
                        <td>No disponibles</td>
                        <td>No disponibles</td>
                    </tr>                    
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
                                <input type="number" class="form-control" id="id_empleado" name="id_empleado" placeholder="ID..." onDrag="return false" onDrop="return false" onPaste="return false" readonly="readonly" />
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
                                <input type="text" class="form-control" id="usuario" name="usuario" maxlength="32" placeholder="Usuario..." onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return username(event);" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Primer Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" maxlength="32" placeholder="Primer Nombre..." onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return notNumbers(event);" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombres" class="col-sm-4 col-form-label">Segundo Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" maxlength="64" placeholder="Segundo Nombre..." onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return notNumbers(event);" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-sm-4 col-form-label">Primer Apellido:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" maxlength="32" placeholder="Primer Apellido..." onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return notNumbers(event);" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellidos" class="col-sm-4 col-form-label">Apellidos:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" maxlength="32" placeholder="Segundo Apellido..." onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return notNumbers(event);" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="correo" class="col-sm-4 col-form-label">Correo:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="correo" name="correo" maxlength="64" placeholder="Correo..." onDrag="return false" onDrop="return false" onPaste="return false" />
                            </div>
                        </div>
                        <div id="changePassDiv" class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                            <div class="col-sm-8">
                                <button id="btn_password" type="button" class="btn btn-warning" title="Sustituirá la contraseña actual por una nueva">Cambiar Contraseña</button>
                            </div>
                        </div>
                        <div id="passDiv" class="form-group row d-none">
                            <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" maxlength="60" placeholder="Contraseña..." onDrag="return false" onDrop="return false" onPaste="return false" />
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
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" placeholder="Telefono..." onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return justNumbers(event);" />
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
        
        //Funcion para cargar la tabla
        function updateTable() {
            //NOTA BUSCAR FORMA DE OBTENER EL id_empleado de la Session
            $.ajax({
                type: "POST",
                url: "../controller/empleadoController.php?allEmpleados=true",
                data: JSON.stringify({"id_empleado":1}),
                success:function (data) {
                    var response = jQuery.parseJSON(data);
                    if(typeof response.code !== 'undefined'){
                        toastr.error(response.message);
                    }else{
                        //Vaciar la tabla
                        $("#table_body" ).html("");
                        //Lenar la tabla
                        jQuery.each(response, function(i, val) {
                            var tr = "<tr id='"+val.id_empleado+"' data-id_empleado='"+val.id_empleado+"'><td>"+val.usuario+"</td><td>"+val.primer_nombre+"</td><td>"+val.primer_apellido+"</td></tr>";
                            $("#table_body").append(tr);
                        });
                        //Agregar Evento de click por cada item de la tabla
                        eventoSeleccionar();
                    }
                }
            });
        }
        //Funcion para evento de click a una fila
        function eventoSeleccionar(){
            //Evento del click de un tr obteniendo su id_empleado del atributo data-id_empleado
            $("#table_body tr").click(function() {
                //Agregar color hover del mouse a la tabla
                $(this).addClass('table-info').siblings().removeClass('table-info');
                //Variable selectedEmpleado contiene el id_empleado
                selectedEmpleado = jQuery.parseJSON($(this).attr("data-id_empleado"));
                $.ajax({
                    type: "POST",
                    url: "../controller/empleadoController.php?findEmpleado=true",
                    data: JSON.stringify({"id_empleado":1, "find_id_empleado":selectedEmpleado}),
                    success:function (data) {
                        var response = jQuery.parseJSON(data);
                        console.log(response);
                        if(typeof response.code !== 'undefined'){
                            toastr.error(response.message);
                        }else{
                            //selectedEmpleado se convierte en el objeto completo
                            selectedEmpleado = response;
                            //Cargamos el formulario modal con los datos del objeto
                            cargarDatos(selectedEmpleado);
                        }                        
                    }
                });
                
                
            });
        }

        function cargarDatos(selectedEmpleado){
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
            }else{
                alert("Usuario Invalido");
            }
        }

        function restablecerSeleccion(){
            $("#editarModal").modal('hide');
            $("#eliminarModal").modal('hide');
            $("#btn_editar").prop('disabled', true);
            $("#btn_eliminarModal").prop('disabled', true);            
        }

        //Al Carga el documento cargar la tabla
        $(document).ready(function() {
            //Cargar Tabla
            updateTable();
        });        
        
        $("#btn_editar").click(function() {
            $("#passDiv").addClass('d-none');
            $("#changePassDiv").removeClass('d-none');
            $("#password").val("");
            $("#password").prop("disabled", true);
        });
        $("#btn_password").click(function() {
            $("#passDiv").removeClass('d-none');
            $("#changePassDiv").addClass('d-none');
            $("#password").prop("disabled", false);
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
                selectedEmpleado.activo = true;
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
                        console.log(response);
                        if(response.code == 1){
                            toastr.success(response.message);
                            updateTable();
                            restablecerSeleccion();
                        }else if(response.code == 2){
                            toastr.error(response.message);
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
                        console.log(response);
                        if(response.code == 1){
                            toastr.success(response.message);
                            updateTable();
                            restablecerSeleccion();
                        }else if(response.code == 2){
                            toastr.error(response.message);
                        }
                    }
                });
            } else {
                alert("No se ha seleccionado un empleado");
            }
        });        
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
        function username(e) {
            if (String.fromCharCode(e.which).match(/^[A-Za-z0-9 \x08]$/)) {
                return true;
            }
            return false;
        }
    </script>
</body>

</html>