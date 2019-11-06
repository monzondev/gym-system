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
    <style>
        .filas:hover {
            cursor: pointer;
        }

        .opciones:hover {
            cursor: context-menu;
        }

        .item {
            padding: 5px;
        }

        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 90%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }


        .proile-rating {
            font-size: 15px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .actives {
            border: none;
            border-bottom: 2px solid #0062cc;
        }


        .profile-work p {
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }

        .profile-work a {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h3>Buscar Miembro:</h3>
                    <input id="buscador" class="form-control basicAutoSelect" style="width: 85%; float: left;" placeholder="Ingrese nombre del miembro..." onkeypress="return lettersOnly(event);" autocomplete="off" />
                    <button id="btn_buscar" class="btn btn-primary">Filtrar</button>
                </div>
                <div class="col-md-1"></div>
            </div>
            <br>
            <table class="table text-center table-striped table-hover" id="table_body">
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
                <tbody>
                    <?php if (!is_null($activos)) {
                        foreach ($activos as $miembro) {
                            $tipoM = $tipoMiembro->getTipoMembresia($miembro['id_tipo_membresia']);
                            ?>


                            <tr id="<?php echo $miembro['id_miembro']; ?>" class="filas">
                                <th style="padding-top: 5px; padding-bottom: 5px;" scope="row"><img src="../recursos/fotografias/<?php echo $miembro['foto'] ?>" class="rounded-circle" width="50" alt="<?php echo $miembro['usuario'] ?>" title="<?php echo $miembro['usuario'] ?>"></th>
                                <td style="padding-top: 17px;">
                                    <?php echo $miembro['primer_nombre'] . ' ' . $miembro['primer_apellido'] ?></td>
                                <td style="padding-top: 17px;"><?php echo $miembro['telefono'] ?></td>
                                <td style="padding-top: 17px;"><?php
                                                                        if ($tipoM != null) {
                                                                            echo $tipoM['nombre'];
                                                                        }
                                                                        ?></td>
                                <td style="padding-top: 17px;"><?php echo $miembro['fecha_inicio'] ?></td>

                                <td style="padding-top: 17px;"><?php
                                                                        if ($miembro['activo']) {
                                                                            echo 'Activo';
                                                                        } else {
                                                                            echo 'InActivo';
                                                                        }
                                                                        ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td>No hay miembros registrados</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" id="modalDatos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card" style="border: none;">
                    <div class="card-header  text-center" style="background-color: #4B515D; color:white; ">
                        <strong>
                            <p class="lead">Informaci&oacute;n del miembro</p>
                            <button type="button" class="close " style="color:white;" onclick="cerrar();" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </strong>

                    </div>

                    <div class="card-body" id="cargando" style="display:none">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <br><br><br>
                                <img src="img/cargando3.gif" width="230">
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="datos">
                        <div class="container emp-profile">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-img">
                                        <img id="fotografia" class="rounded-circle" />
                                    </div>
                                </div>

                                <div class="col-md-7 text-center">
                                    <div class="profile-head">
                                        <h2 id="nombre">
                                        </h2>
                                        <h3 id="apellidos">

                                        </h3>
                                        <h5 class="proile-rating"><span id="fecha"></span></h5>
                                        <hr>
                                        <div class="row .nav-tabs">
                                            <ul>
                                                <li style="display:inline;  padding-left:10px; padding-right:75px;">
                                                    <a class="opciones" id="link-personal" onclick="mostrarPersonal();">Personal</a>
                                                </li>
                                                <li style="display:inline; ">
                                                    <a class="opciones" id="link-gimnasio" onclick="mostrarExtra();">Gimnasio</a>
                                                </li>

                                            </ul>

                                        </div>
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class=" row justify-content-end">
                            <div class="col-md-7 ">
                                <div id="personal">
                                    <div class="row profile-tab">
                                        <div class="col-md-4">
                                            <label>Usuario:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="user"></p>
                                        </div>
                                    </div>
                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>G&eacute;nero:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="genero"></p>
                                        </div>
                                    </div>
                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Correo:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="correo"></p>
                                        </div>
                                    </div>
                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Tel&eacute;fono:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="telefono"></p>
                                        </div>
                                    </div>
                                </div>
                                <div id="perfil">
                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Identificador:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="identificador"></p>
                                        </div>
                                    </div>
                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Fecha inicio:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="fecha_inicio"></p>
                                        </div>
                                    </div>

                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Altura:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="altura"></p>
                                        </div>
                                    </div>

                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Peso:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="peso"></p>
                                        </div>
                                    </div>
                                    <div class="row profile-tab">
                                        <div class=" col-md-4">
                                            <label>Estado:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="estado"></p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <script>
        function mostrarPersonal() {
            $("#personal").css("display", "block");
            $("#perfil").css("display", "none");

            $("#link-personal").css("color", "#0062cc");
            $("#link-personal").css("font-weight", "bold");
            $("#link-personal").addClass("actives");

            $("#link-gimnasio").css("color", "#000000");
            $("#link-gimnasio").css("font-weight", "normal");
            $("#link-gimnasio").removeClass("actives");
        }

        function mostrarExtra() {
            $("#personal").css("display", "none");
            $("#perfil").css("display", "block");
            $("#link-gimnasio").css("color", "#0062cc");
            $("#link-gimnasio").css("font-weight", "bold");
            $("#link-gimnasio").addClass("actives");

            $("#link-personal").css("color", "#000000");
            $("#link-personal").css("font-weight", "normal");
            $("#link-personal").removeClass("actives");
        }

        function cerrar() {
            $("#modalDatos").modal('toggle');
        }
    </script>
    <script>
        $(document).ready(function() {

            $('.filas').click(function() {
                var id = $(this).attr('id');
                cargarDatos(id);
            });
        });

        function cargarDatos(selectedIdMiembro) {
            $("#modalDatos").modal('show');
            //var dataString = 'id=' + $(this).attr('id') + '&getMiembro=1';
            var dataString = 'id=' + selectedIdMiembro + '&getMiembro=1';
            $.ajax({
                type: "POST",
                url: "../controller/miembroController.php",
                data: dataString,
                beforeSend: function() {
                    $("#datos").css("display", "none");
                    $("#cargando").css("display", "block");
                },
                success: function(response) {
                    $("#datos").css("display", "block");
                    $("#cargando").css("display", "none");

                    $("#personal").css("display", "block");
                    $("#link-personal").css("color", "#0062cc");
                    $("#link-personal").css("font-weight", "bold");
                    $("#link-personal").addClass("actives");

                    $("#perfil").css("display", "none");
                    $("#link-gimnasio").css("color", "#000000");

                    selected = jQuery.parseJSON(response)
                    $("#fotografia").attr("src", "../recursos/fotografias/" +
                        selected.foto);
                    $("#fotografia").attr("alt", selected.user);
                    $("#nombre").html(selected.primer_nombre + " " + selected
                        .segundo_nombre);
                    $("#apellidos").html(selected.primer_apellido + " " + selected
                        .segundo_apellido);
                    $("#user").html(selected.usuario);
                    $("#correo").html(selected.correo);
                    $("#telefono").html(selected.telefono);
                    edad = calcularEdad(selected.fecha_nacimiento)
                    $("#fecha").html(edad + " años");
                    $("#identificador").html(selected.identificador);
                    if (selected.genero == "t") {
                        genero = "Masculino";
                    } else {
                        genero = "Femenino";
                    }
                    $("#genero").html(genero);
                    $("#fecha_inicio").html(selected.fecha_inicio);
                    $("#altura").html(selected.altura + ' m');
                    $("#peso").html(selected.peso) + ' kg';
                    if (selected.activo) {
                        estado = "Activo";
                    } else {
                        estado = "Inactivo";
                    }
                    $("#estado").html(estado);

                }

            });
        }


        function calcularEdad(fecha) {
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();
            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            }
            return edad;
        }
    </script>
    <?php
    $idbuscado =  "<script>document.write(localStorage.getItem('id'));</script>";
    echo $identificador;
    ?>

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
    <script src="js/bootstrap-autocomplete.min.js"></script>
    <script>
        $('#buscador').autoComplete({
            minLength: 1,
            events: {
                searchPost: function(resultFromServer) {
                    var txt = $('#buscador').val();
                    var list = searchList(txt);
                    var formatList = [];
                    $.each(list, function(key, value) {
                        var text = value.primer_nombre + " " + value.segundo_nombre + " " + value.primer_apellido + " " + value.segundo_apellido + " - " + value.identificador;
                        var item = {
                            "value": value.id_miembro,
                            "text": text
                        };
                        formatList.push(item);
                    });
                    return formatList;
                }
            }
        });
        $('#buscador').on('autocomplete.select', function(evt, item) {
            cargarDatos(item.value);
        });

        function searchList(txt) {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            //var txt = $('#buscador').val();
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?filtrar=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado,
                    "txt": txt
                }),
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (typeof response.code !== 'undefined') {
                        toastr.error(response.message);
                    } else {
                        list = response;
                    }
                }
            });
            return list;
        }

        function updateTable() {

        }


        function lettersOnly(e) {
            if (String.fromCharCode(e.which).match(/^[A-Za-z0-9 \x08]$/)) {
                return true;
            }
            return false;
        }
    </script>
</body>

</html>