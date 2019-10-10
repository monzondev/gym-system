<?php
include_once '../Model/Boundary/tipo_empleado.php';
include_once '../Model/Boundary/empleado.php';
$empleado = new empleado();
$tipoEmpleado =  new tipo_empleado();
$tipo = $tipoEmpleado->getTipoEmpleado($_SESSION['tipoEmpleado']);
?>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#">
            DashBoard
        </a>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            Miembros <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="registrar.php">
                    Registrar
                </a>
            </li>
            <li>
                <a href="miembros.php">
                    Ver Todos
                </a>
            </li>
        </ul>
    </li>
<?php if ($_SESSION['tipoEmpleado'] == 1) {?>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            Empleados <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="registrar.php">
                    Registrar
                </a>
            </li>
            <li>
                <a href="empleados.php">
                    Ver Todos
                </a>
            </li>
        </ul>
    </li>
<?php } ?>    
    <li>
        <a href="estadisticas.php">
            Estadisticas
        </a>
    </li>
    <li class="dropdown" style="float:right; right:5vw;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class=""></i>
                <p>Cuenta<b class="caret"></b></p>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">
                    <?php
                        if (isset($_SESSION['usuario'])) {
                            echo strtoupper($_SESSION['usuario']);
                        }else{
                            echo "Nombre";
                        }
                    ?>
                </a></li>
                <li><a href="#">
                    <?php
                        if (isset($_SESSION['usuario'])) {
                            echo strtoupper($tipo['nombre']);
                        }else{
                            echo "Usuario";
                        }
                    ?>
                </a></li>
                <li class="divider"></li>
                <li><a style="cursor: pointer;" onclick="location.href='../Controller/loginController.php?close=1';">
                    Salir
                </a></li>
            </ul>
    </li>    
</ul>
