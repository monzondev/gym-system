<?php
session_start();
include_once '../boundary/empleado.php';
include_once '../boundary/miembro.php';
include_once '../boundary/tipo_membresia.php';
$tipoMiembro = new tipo_membresia;
$miembro = new miembro();
$activos = $miembro->getAllActiveMiembros();
$login = new empleado();
$login->ValidateSession();
?>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Miembros</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/toastr.css">
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row text-center">
        <h1></h1>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table class="table text-center table-striped table-hover" >
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Membres&iacute;a</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Estado</th>

                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($activos as $miembro) { 
                        $tipoM = $tipoMiembro->getTipoMembresia($miembro['id_tipo_membresia']);
                        ?>
                        <tr>
                            <th style="padding-top: 5px; padding-bottom: 5px;" scope="row"><img src="../recursos/fotografias/<?php echo $miembro['foto']?>" class="rounded-circle" width="50" alt="<?php echo $miembro['usuario']?>" title="<?php echo $miembro['usuario']?>"></th>
                            <td style="padding-top: 17px;"><?php echo $miembro['primer_nombre'].' '.$miembro['primer_apellido'] ?></td>
                            <td style="padding-top: 17px;"><?php echo $miembro['telefono'] ?></td>
                            <td style="padding-top: 17px;"><?php 
                            if ($tipoM != null) {
                                echo $tipoM['nombre'];
                            }
                           ?></td>
                            <td style="padding-top: 17px;"><?php echo $miembro['fecha_inicio']?></td>

                        <td style="padding-top: 17px;"><?php 
                            if ($miembro['fecha_inicio']) {
                                echo 'Activo';
                            }else{
                                echo 'InActivo';
                            }
                           ?></td>
                           
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>

    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <?php

    if (isset($_SESSION['AM'])) {
        if ($_SESSION['AM'] == 1) { ?>
            <script>
                toastr.options.timeOut = 2000; //1.5s
                toastr.options.closeButton = true;
                toastr.remove();
                toastr.success('El miembro fue registrado con exito!');
            </script>
        <?php
                unset($_SESSION['AM']);
            } else if ($_SESSION['AM'] == 2) { ?>
            <script>
                toastr.options.timeOut = 2000; //1.5s
                toastr.options.closeButton = true;
                toastr.remove();
                toastr.error('Ah ocurrido un Error al registrar el miembro');
            </script>
    <?php
            unset($_SESSION['AM']);
        }
    }
    ?>
</body>

</html>