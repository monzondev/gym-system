<?php
include_once '../Model/Boundary/tipo_empleado.php';
$tipoEmpleado =  new tipo_empleado();
$tipo = $tipoEmpleado->getTipoEmpleado($_SESSION['tipoEmpleado']);
if ($_SESSION['tipoEmpleado'] == 1) {
    ?>
    <div class="row" style="background-color: #aab7b8;">
        <div class="col-2" style="cursor: pointer;" onclick="location.href='index.php';">
            DashBoard
        </div>
        <div class="col-2" style="cursor: pointer;" onclick="location.href='miembros.php';">
            Miembros
        </div>
        <div class="col-2" style="cursor: pointer;" onclick="location.href='empleados.php';">
            Empleados
        </div>
        <div class="col-2" style="cursor: pointer;" onclick="location.href='estadisticas.php';">
            Estadisticas
        </div>
        <div class="col-2">
            <strong>
                <?php
                    if (isset($_SESSION['usuario'])) {
                        echo strtoupper($_SESSION['usuario']) . ' - ' . $tipo['nombre'];
                    } ?>
            </strong>
        </div>
        <div class="col-2" style="cursor: pointer;" onclick="location.href='login.php';">
            Cerrar Sessión
        </div>

    </div>
<?php } else { ?>
    <div class="row" style="background-color: #aab7b8;">
        <div class="col-2" style="cursor: pointer;" onclick="location.href='index.php';">
            DashBoard
        </div>
        <div class="col-2" style="cursor: pointer;" onclick="location.href='miembros.php';">
            Miembros
        </div>
        <div class="col-2">
            <strong>
                <?php
                    if (isset($_SESSION['usuario'])) {
                        echo strtoupper($_SESSION['usuario']) . ' - ' . $tipo['nombre'];
                    } ?>
            </strong>
        </div>
        <div class="col-2" style="cursor: pointer;" onclick="location.href='login.php';">
            Cerrar Sessión
        </div>

    </div>
<?php }  ?>