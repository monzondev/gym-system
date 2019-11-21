<?php
include_once '../boundary/tipo_empleado.php';
include_once '../boundary/empleado.php';
$empleado = new empleado();
$tipoEmpleado =  new tipo_empleado();
$tipo = $tipoEmpleado->getTipoEmpleado($_SESSION['tipoEmpleado']);
$EmpleadoLogueado = $empleado->getUserbyId($_SESSION['idEmpleado']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php" style="padding-right: 120px;  "><img src="img/logotipo.png" width="70px" style="padding-right: 15px;" alt="Gimnasio ">Body Master Gym</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active" id="miembrosOptions">
                <?php if ($_SESSION['tipoEmpleado'] == 1) { ?>
                    <a class="nav-link dropdown-toggle" href="index.php" id="navbarDropdownMiembros" style="padding-right: 50px; " role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php } else { ?>
                    <a class="nav-link dropdown-toggle" href="index.php" id="miembros" style="padding-right: 750px; " role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php } ?>
                    Miembros
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="newMiembro" href="registrar-miembro.php">Registrar</a>
                    <a class="dropdown-item" id="Allmiembros" href="miembros.php">Ver todos</a>
                </div>
            </li>
            <?php if ($_SESSION['tipoEmpleado'] == 1) { ?>
                <li class="nav-item dropdown active" id="empleadosOptions">
                    <a class="nav-link dropdown-toggle" href="" id="empleados" style="padding-right: 50px; " role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Empleados
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  id="newEmpleado" href="registrar-empleado.php">Registrar</a>
                        <a class="dropdown-item" id="AllEmpleados" href="empleados.php">Ver todos</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="estadisticas.php"  id="estadisticas" style="padding-right: 25vw" ;>Estadisticas</a>
                </li>
            <?php } ?>

            <li class="nav-item dropdown active" style="float: left;" id="cuentaOptions">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownCuenta" style="float: left;"  id="cuenta"" role=" button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cuenta
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"><?php
                    echo $EmpleadoLogueado['primer_nombre'].' '.$EmpleadoLogueado['primer_apellido'];
                    ?></a>
                    <a class="dropdown-item" style="cursor: pointer;" id="logout" onclick="location.href='../controller/loginController.php?close=1';">Cerrar Sesi&oacute;n</a>
                </div>
            </li>
        </ul>

    </div>
</nav>


<br><br>
