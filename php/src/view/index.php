<?php
session_start();
include_once '../boundary/empleado.php';
include_once '../boundary/tipo_membresia.php';
$tipoMembresia = new tipo_membresia();
$tipos = $tipoMembresia->getAllTipoMembresia();
$login = new empleado();
$login->ValidateSession();
?>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Gym System</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/toastr.css">
    <!--style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
                    box-shadow:  0px 0px 0px 0px #000;
        }
        legend.scheduler-border {
            width:inherit; /* Or auto */
            padding:0 10px; /* To give a bit of padding on the left and right */
            border-bottom:none;
        }
    </style-->
    <style>
        .filas:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-proximos-a-pagar" data-toggle="tab" href="#proximos-a-pagar" role="tab" aria-controls="proximos-a-pagar" aria-selected="true">Proximos a Pagar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-pagos-en-proceso" data-toggle="tab" href="#pagos-en-proceso" role="tab" aria-controls="pagos-en-proceso" aria-selected="false">Gestionar Pagos</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="proximos-a-pagar" role="tabpanel" aria-labelledby="tab-proximos-a-pagar">
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <h3>Miembros Proximos a Pagar:</h3>
                            <input id="buscador_proximos_pagos" class="form-control basicAutoSelect" style="width: 85%; float: left;" placeholder="Ingrese nombre del miembro..." onkeypress="return lettersOnly(event);" autocomplete="off" />
                            <button id="btn_buscar_proximos_pagos" style="float: left;" class="btn btn-primary">Filtrar</button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br>
                    <table id="tablaProximosPagos" class="table" style="widht: 50%" class="table text-center table-striped table-hover">
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
                        <tbody id="table_body_proximos_pagos">
                            <tr>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pagos-en-proceso" role="tabpanel" aria-labelledby="tab-pagos-en-proceso">
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <h3>Miembros en Proceso de pago:</h3>
                            <input id="buscador_pagos_proceso" class="form-control basicAutoSelect" style="width: 85%; float: left;" placeholder="Ingrese nombre del miembro..." onkeypress="return lettersOnly(event);" autocomplete="off" />
                            <button id="btn_buscar_pagos_proceso" style="float: left;" class="btn btn-primary">Filtrar</button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br>
                    <table id="tablaPagosProceso" class="table" style="widht: 50%" class="table text-center table-striped table-hover">
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
                        <tbody id="table_body_pagos_proceso">
                            <tr>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                                <td>No disponible</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Registrar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="col-md-12 mb-12 ">
                        <div class="form-group text-center ">
                            <label class="control-label">Seleccione el tipo de membresia a pagar:</label>
                            <select class="form-control" name="tipomembresia" id="tipomembresia" required>
                                <option value="0" disabled selected="selected">Seleccione un tipo...</option>
                                <?php
                                foreach ($tipos as $valores) {
                                    echo '<option value="' . $valores['id_tipo_membresia'] . '">' . $valores['nombre'] . '</option>';
                                }
                                ?>
                            </select>

                            <p id="error1" class="text-danger error"> </p>
                        </div>
                        <strong>
                            <center>
                                <h5 id="texto"></h5>
                            </center>
                        </strong>

                        <p id="titulo"></p>
                        <p id="descripcion"></p>
                        <p id="monto"></p>
                        <p id="duracion"></p>
                        <p style="display:none;" id="nuevaCuota"><strong>Nuevo monton a cobrar: $<span id="cuota"></span> </strong> </p>
                    </div>

                    <button type="button" style="display: none;" class="btn btn-info" id="editarMonto" onclick="editarMonto();">Editar Monto a pagar</button>
                    <div class="" style="display: none;" id="form-monto">
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-6 text-center">

                                <label>Ingresa el monto</label>
                                <input id="nuevoMonto" name="nuevoMonto" onCopy="return false" autocomplete="off" onDrag="return false" onDrop="return false" onPaste="return false" onkeypress="return justNumbers(event);" maxlength="5" placeholder="Precio a cobrar" required class="form-control">
                                <p id="error2" class="text-danger error"> </p>
                            </div>
                            <div class=" col-md-6 mb-6 text-center">
                                <br>
                                <button type="button" class="btn btn-secondary" onclick="cancelarEditarMonto();">Cancelar</button>
                                <button type="button" class="btn btn-info" onclick="cambiarCuota();">Aceptar</button>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reiniciarModal();">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="botonPagar" onclick="realizarPago();">Realizar pago</button>
                </div>
            </div>
        </div>
    </div>




    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <script>
        <?php
        include_once '../boundary/estado.php';
        include_once '../boundary/tipo_membresia.php';
        $facadeEstado = new estado;
        $facadeTipoMembrecia = new tipo_membresia;
        ?>
        var estados = <?php echo json_encode($facadeEstado->findAll()); ?>;
        var tipoMembrecias = <?php echo json_encode($facadeTipoMembrecia->getAllTipoMembresia()); ?>;

        function findEstado(idEstado) {
            for (e of estados) {
                if (e.id_estado == idEstado) {
                    return e;
                }
            }
        }

        function findTipoMebresia(idTipoMebrecia) {
            for (tm of tipoMembrecias) {
                if (tm.id_tipo_membresia == idTipoMebrecia) {
                    return tm;
                }
            }
        }

       
        $('#btn_buscar_proximos_pagos').click(function() {
            alert("En Desarrollo");
            //var txt = $('#buscador').val();
            //updateTable(txt, 0);
        })

        function getProximosPagar() {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            //var txt = $('#buscador').val();
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?proximosPagos=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado
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

        function getPagosProceso() {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            //var txt = $('#buscador').val();
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?pagosEnProceso=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado
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

        function eventoSeleccionar() {
            $('#table_body_pagos_proceso .filas').click(function() {
                var id_empleado = $(this).attr('id');
                //alert("Modal en Desarrollo con id_empleado="+id_empleado);
                $("#modalPago").modal('show');
                $('#modalPago').attr('data-id', id_empleado);
                //cargarModal(id_empleado);
            });
        }

        function updateTableProximosPagos() {
            var listTable = getProximosPagar();
            if (listTable.length > 0) {
                //Vaciar la tabla
                var tabla = $("#table_body_proximos_pagos");
                tabla.html("");
                //Llenar la tabla
                $.each(listTable, function(key, value) {
                    var tr = createTableRowWith(value);
                    tabla.append(tr);
                });
                //eventoSeleccionar();
            } else if (listTable == false) {
                toastr.warning('No se han encontrado miembros proximos a pagar');
            }
        }

        function updateTablePagosEnProceso() {
            var listTable = getPagosProceso();
            if (listTable.length > 0) {
                //Vaciar la tabla
                var tabla = $("#table_body_pagos_proceso");
                tabla.html("");
                //Llenar la tabla
                $.each(listTable, function(key, value) {
                    var tr = createTableRowWith(value);
                    tabla.append(tr);
                });
                eventoSeleccionar();
            } else if (listTable == false) {
                toastr.warning('No se han encontrado miembros con pagos pendiente');
            }
        }

        function createTableRowWith(value) {
            var tr = document.createElement("tr");
            tr.id = value.id_miembro;
            tr.classList.add("filas");
            var td1 = document.createElement("th");
            var img = document.createElement("img");
            var td2 = document.createElement("td");
            var td3 = document.createElement("td");
            var td4 = document.createElement("td");
            var td5 = document.createElement("td");
            var td6 = document.createElement("td");
            td1.setAttribute("scope", "row");
            td1.setAttribute("style", "padding-top: 5px; padding-bottom: 5px;");
            img.setAttribute("src", "../recursos/fotografias/" + value.foto);
            img.setAttribute("class", "rounded-circle");
            img.setAttribute("width", "50");
            img.setAttribute("alt", value.usuario);
            img.setAttribute("title", value.usuario);
            td1.append(img);
            td2.setAttribute("style", "padding-top: 17px;");
            td2.innerText = value.primer_nombre + " " + value.segundo_nombre;
            td3.setAttribute("style", "padding-top: 17px;");
            td3.innerText = value.telefono;
            td4.setAttribute("style", "padding-top: 17px;");
            var tm = findTipoMebresia(value.id_tipo_membresia);
            if (typeof tm === 'undefined') {
                td4.innerText = "Ninguna";
            } else {
                td4.innerText = tm.nombre;
            }
            td5.setAttribute("style", "padding-top: 17px;");
            td5.innerText = value.fecha_inicio;
            td6.setAttribute("style", "padding-top: 17px;");
            var estado = findEstado(value.id_estado);
            td6.innerText = estado.nombre;
            tr.append(td1, td2, td3, td4, td5, td6);
            return tr;
        }

        function lettersOnly(e) {
            if (String.fromCharCode(e.which).match(/^[A-Za-z0-9 \x08]$/)) {
                return true;
            }
            return false;
        }
        $(document).ready(function() {
            //Cuando cargue la pagina buscar todos
            updateTableProximosPagos();
            updateTablePagosEnProceso();
        });

        $('select#tipomembresia').on('change', function() {
            var valor = $(this).val();
            error1.innerHTML = "";
            var dataString = 'id_tipo_membresia=' + valor + '&obtenerMembresias=1';
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/membresiaController.php",
                data: dataString,
                success: function(response) {
                    if (response != null) {
                        selected = jQuery.parseJSON(response)
                        $("#texto").html('Detalles');
                        $("#titulo").html('<strong>Membresia:</strong> ' + selected.nombre);
                        $("#descripcion").html('<strong>Descripci&oacute;n:</strong> ' + selected.descripcion);
                        $("#monto").html('<strong>Precio:</strong> $<span id="precio">' + selected.precio + '</span>');
                        $("#duracion").html('<strong>Duracion:</strong> ' + selected.dias + ' d&iacute;as');
                        $("#editarMonto").css("display", "block");

                    } else {
                        $("#texto").html('No se encontr&oacute; la membresia');
                        $("#titulo").html('');
                        $("#descripcion").html('');
                        $("#monto").html('');
                        $("#duracion").html('');
                        $("#editarMonto").css("display", "none");
                        $("#form-monto").css("display", "none");
                    }

                }
            });
        });


        function realizarPago() {
            var type = document.getElementById("tipomembresia");
            var error1 = document.getElementById("error1");
            var requerido = "<img src='img/errorr.png'width='22' >     Selecciona una membresia";
            //VALIDACION TIPO DE MEMBRESIA
            if (type.value == 0) {
                type.focus();
                error1.innerHTML = requerido;
            } else {
                error1.innerHTML = "";
                var precioFinal;
                var precioInicial = document.getElementById("precio").innerText;
                var precioModificado = document.getElementById("cuota").innerText;
                if (precioModificado != "") {
                    precioFinal = precioModificado;
                } else {
                    precioFinal = precioInicial;
                }

                var f = new Date();
                var dataString = {'miembro': $('#modalPago').attr('data-id'), 
                        'membresia': $('#tipomembresia').val(),
                        'monto': precioFinal,
                        'fecha': (f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate())}


                $("#modalPago").modal('toggle');
                $.ajax({
                    type: "POST",
                    url: "../controller/pagoController.php?realizarPago=true",
                    data: dataString,
                    success: function(data) {
                        console.log(data);
                        var responses = jQuery.parseJSON(data);
                        var tipo = responses.tipo
                        switch (tipo) {
                            case '1':
                                toastr.success(responses.message);
                                reiniciarModal();
                                updateTablePagosEnProceso();
                                break;

                            case '2':
                                toastr.error(responses.message);
                                reiniciarModal();
                                updateTablePagosEnProceso();
                                break;
                        }
                    }
                });

            }

        }

        function reiniciarModal() {
            var type = document.getElementById("tipomembresia");
            type.value = 0;
            document.getElementById("error1").innerHTML = "";
            $("#texto").html('');
            $("#titulo").html('');
            $("#descripcion").html('');
            $("#monto").html('');
            $("#duracion").html('');
            $("#editarMonto").css("display", "none");
            $("#form-monto").css("display", "none");
            $("#nuevoMonto").val('');
            $('#botonPagar').attr("disabled", false);
            $("#nuevaCuota").css("display", "none");
            error2.innerHTML = "";

        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        function editarMonto() {
            $("#editarMonto").css("display", "none")
            $("#form-monto").css("display", "block");
            $("#nuevoMonto").focus();
            $('#botonPagar').attr("disabled", true);
            $("#cuota").html('');
            $("#nuevaCuota").css("display", "none");
        }

        function cancelarEditarMonto() {
            $("#editarMonto").css("display", "block");
            $("#form-monto").css("display", "none");
            $("#nuevoMonto").val('');
            $('#botonPagar').attr("disabled", false);
            $("#cuota").html('');

            error2.innerHTML = "";
        }

        function cambiarCuota() {
            var necesario = "<img src='img/errorr.png'width='22' >     Proporcione el nuevo monto";

            //VALIDACION NUEVO MONTO
            if ($("#nuevoMonto").val() == "") {
                $("#nuevoMonto").focus();
                error2.innerHTML = necesario;
            } else {
                error2.innerHTML = "";
                $("#nuevaCuota").css("display", "block");
                $("#cuota").html($("#nuevoMonto").val())
                $("#form-monto").css("display", "none");
                $("#nuevoMonto").val('');
                $('#botonPagar').attr("disabled", false);
                $("#editarMonto").css("display", "block");

            }




        }
        /*
        $('#miembrosOptions').hover(function() {
            $('#navbarDropdownMiembros').trigger('click')
        })

        $('#cuentaOptions').hover(function() {
            $('#navbarDropdownCuenta').trigger('click')
        })
        $('#empleadosOptions').hover(function() {
            $('#empleados').trigger('click')
        })
        */
    </script>
</body>

</html>