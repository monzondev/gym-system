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
            <button id="btn_editar" type="button" data-target="#editarModal" data-toggle="modal" class="btn btn-info float-right" title="Seleccione un Empleado" disabled="true">Editar Empleado</button>
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

    <!-- Modal -->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Trabajador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tipoEmpleado" class="col-sm-4 col-form-label">Tipo Empleado:</label>
                        <div class="col-sm-8">
                            <select id="tipoEmpleado" class="form-control">
                                <!--option>EJEMPLO</option-->
                                <?php
                                    include_once '../boundary/tipo_empleado.php';
                                    $te = new tipo_empleado();
                                    $tiposEmpleados = $te->getAllTipoEmpleado();
                                    if(!is_null($tiposEmpleados)){
                                        foreach($tiposEmpleados as $tipoEmpleado){
                                            echo "<option value='".$tipoEmpleado["id_tipo_empleado"]."'>".$tipoEmpleado["nombre"]."</option>";
                                        }
                                    }else{
                                        echo "<option disabled>No se encontraron resultados</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="usuario" class="col-sm-4 col-form-label">Usuario:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="usuario" placeholder="Usuario...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombres" class="col-sm-4 col-form-label">Nombres:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombres" placeholder="Nombres...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellidos" class="col-sm-4 col-form-label">Apellidos:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="apellidos" placeholder="Apellidos...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-4 col-form-label">Correo:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="correo" placeholder="Correo...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="Contraseña...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-4 col-form-label">Telefono:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telefono" placeholder="Telefono...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha_nacimiento" class="col-sm-4 col-form-label">Fecha Nacimiendo:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="fecha_nacimiento" placeholder="Fecha Nacimiendo...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("#table_body tr").click(function(){
            $(this).addClass('table-info').siblings().removeClass('table-info');    
            var idEmpleado=$(this).attr("data-id_empleado");
            //alert("La referencia del empleado es id_empleado="+idEmpleado);
            $("#btn_editar").prop('disabled', false);
        });
        
    </script>
</body>
</html>