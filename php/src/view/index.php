<?php
session_start();
include_once '../boundary/empleado.php';
include_once '../boundary/tipo_membresia.php';
$tipoMembresia = new tipo_membresia();
$tipos = $tipoMembresia->getAllTipoMembresia();
$login = new empleado();
$login->ValidateSession();
?>
<!DOCTYPE html>
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
                    <a class="nav-link" id="tab-pagos-en-proceso" data-toggle="tab" href="#pagos-en-proceso" role="tab" aria-controls="pagos-en-proceso" aria-selected="false">Pagos en Proceso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-miembros-inactivos" data-toggle="tab" href="#miembros-inactivos" role="tab" aria-controls="miembros-inactivos" aria-selected="false">Miembros Inactivos</a>
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
                                <th scope="col">Foto</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Membres&iacute;a</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha de Pago</th>
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
                                <th scope="col">Foto</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Membres&iacute;a</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha Pago</th>
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
                <div class="tab-pane fade" id="miembros-inactivos" role="tabpanel" aria-labelledby="tab-miembros-inactivos">
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <h3>Miembros Inactivos por Pagar:</h3>
                            <input id="buscador_miembros_inactivos" class="form-control basicAutoSelect" style="width: 85%; float: left;" placeholder="Ingrese nombre del miembro..." onkeypress="return lettersOnly(event);" autocomplete="off" />
                            <button id="btn_buscar_miembros_inactivos" style="float: left;" class="btn btn-primary">Filtrar</button>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br>
                    <table id="tablaMiembrosInactivos" class="table" style="widht: 50%" class="table text-center table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Membres&iacute;a</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha Pago</th>
                            </tr>
                        </thead>
                        <tbody id="table_body_miembros_inactivos">
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

    <!-- Modal para realizar el pago -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Registrar Pago</h5>
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
                                <h5 id="texto" class="text-center" ></h5>
                        </strong>

                        <p id="titulo"></p>
                        <p id="descripcion"></p>
                        <p id="monto"></p>
                        <p id="duracion"></p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reiniciarModal();">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="botonPagar" onclick="confirmarPago();">Realizar pago</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmacion de pago -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="confirmacionP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="  background-color: #f2f4f4; height: 250px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmacion para realizar el pago</h5>
                </div>
                <div class="modal-body">
                    <p id="montoPagar" class="text-center" ></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancelarPago();">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="realizarPago();">Aceptar</button>
                </div>
            </div>
        </div>
    </div>





    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <script src="js/bootstrap-autocomplete.min.js"></script>
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
            var txt = $('#buscador_proximos_pagos').val();
            updateTableProximosPagos(txt);
        });
        $('#buscador_proximos_pagos').autoComplete({
            minLength: 1,
            events: {
                searchPost: function(resultFromServer) {
                    var txt = $('#buscador_proximos_pagos').val();
                    var list = getProximosPagar(txt);
                    var formatList = [];
                    $.each(list, function(key, value) {
                        var text = value.primer_nombre + " " + value.segundo_nombre + " " + value.primer_apellido + " " + value.segundo_apellido + " - " + value.usuario;
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
        $('#buscador_proximos_pagos').on('autocomplete.select', function(evt, item) {
            updateTableProximosPagos(item.text);
        });

        $('#btn_buscar_pagos_proceso').click(function() {
            var txt = $('#buscador_pagos_proceso').val();
            updateTablePagosEnProceso(txt);
        });
        $('#buscador_pagos_proceso').autoComplete({
            minLength: 1,
            events: {
                searchPost: function(resultFromServer) {
                    var txt = $('#buscador_pagos_proceso').val();
                    var list = getPagosProceso(txt);
                    var formatList = [];
                    $.each(list, function(key, value) {
                        var text = value.primer_nombre + " " + value.segundo_nombre + " " + value.primer_apellido + " " + value.segundo_apellido + " - " + value.usuario;
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
        $('#buscador_pagos_proceso').on('autocomplete.select', function(evt, item) {
            updateTablePagosEnProceso(item.text);
        });

        $('#btn_buscar_miembros_inactivos').click(function() {
            var txt = $('#buscador_miembros_inactivos').val();
            updateTableMiembrosInactivos(txt);
        });
        $('#buscador_miembros_inactivos').autoComplete({
            minLength: 1,
            events: {
                searchPost: function(resultFromServer) {
                    var txt = $('#buscador_miembros_inactivos').val();
                    var list = getMiembrosInactivos(txt);
                    var formatList = [];
                    $.each(list, function(key, value) {
                        var text = value.primer_nombre + " " + value.segundo_nombre + " " + value.primer_apellido + " " + value.segundo_apellido + " - " + value.usuario;
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
        $('#buscador_miembros_inactivos').on('autocomplete.select', function(evt, item) {
            updateTableMiembrosInactivos(item.text);
        });

        function getProximosPagar(txt) {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?proximosPagos=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado, "txt": txt
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

        function getPagosProceso(txt) {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?pagosEnProceso=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado, "txt": txt
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

        function getMiembrosInactivos(txt) {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?miembrosInactivos=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado, "txt": txt
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
                $("#modalPago").modal('show');
                $('#modalPago').attr('data-id', id_empleado);
            });
        }

        function eventoSeleccionarMiembrosInactivos() {
            $('#table_body_miembros_inactivos .filas').click(function() {
                var id_empleado = $(this).attr('id');
                $("#modalPago").modal('show');
                $('#modalPago').attr('data-id', id_empleado);
            });
        }

        function updateTableProximosPagos(txt) {
            var listTable = getProximosPagar(txt);
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
                //toastr.warning('No se han encontrado miembros proximos a pagar');
            }
        }

        function updateTablePagosEnProceso(txt) {
            var listTable = getPagosProceso(txt);
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
                //toastr.warning('No se han encontrado miembros con pagos pendiente');
            }
        }

        function updateTableMiembrosInactivos(txt) {
            var listTable = getMiembrosInactivos(txt);
            if (listTable.length > 0) {
                //Vaciar la tabla
                var tabla = $("#table_body_miembros_inactivos");
                tabla.html("");
                //Llenar la tabla
                $.each(listTable, function(key, value) {
                    var tr = createTableRowWith(value);
                    tabla.append(tr);
                });
                eventoSeleccionarMiembrosInactivos();
            } else if (listTable == false) {
                //toastr.warning('No se han encontrado miembros con pagos pendiente');
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
            td2.innerText = value.usuario;
            td3.setAttribute("style", "padding-top: 17px;");
            td3.innerText = value.primer_nombre + " " + value.segundo_nombre;
            td4.setAttribute("style", "padding-top: 17px;");
            var tm = findTipoMebresia(value.id_tipo_membresia);
            if (typeof tm === 'undefined') {
                td4.innerText = "Ninguna";
            } else {
                td4.innerText = tm.nombre;
            }            
            td5.setAttribute("style", "padding-top: 17px;");
            var estado = findEstado(value.id_estado);
            td5.innerText = estado.nombre;
            td6.setAttribute("style", "padding-top: 17px;");
            if(typeof value.fin_membresia === 'undefined'){
                td6.innerText = "No definida";
            }else{
                td6.innerText = value.fin_membresia;
            }
            
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
            updateTableProximosPagos("");
            updateTablePagosEnProceso("");
            updateTableMiembrosInactivos("");
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

                    } else {
                        $("#texto").html('No se encontr&oacute; la membresia');
                        $("#titulo").html('');
                        $("#descripcion").html('');
                        $("#monto").html('');
                        $("#duracion").html('');
                    }

                }
            });
        });


        function realizarPago() {
            var type = document.getElementById("tipomembresia");
            var error1 = document.getElementById("error1");
            var requerido = "<img src='img/errorr.png'width='22' alt='Error'>     Selecciona una membresia";
            //VALIDACION TIPO DE MEMBRESIA
            if (type.value == 0) {
                type.focus();
                error1.innerHTML = requerido;
            } else {
                error1.innerHTML = "";
                var precio = document.getElementById("precio").innerText;
                var f = new Date();
                var dataString = {
                    'miembro': $('#modalPago').attr('data-id'),
                    'membresia': $('#tipomembresia').val(),
                    'monto': precio,
                    'fecha': (f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate())
                }



                $("#confirmacionP").modal('toggle');
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
                                updateTablePagosEnProceso("");
                                updateTableMiembrosInactivos("");
                                break;

                            case '2':
                                toastr.error(responses.message);
                                reiniciarModal();
                                updateTablePagosEnProceso("");
                                updateTableMiembrosInactivos("");
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
            $("#montoPagar").html('');


        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        function confirmarPago() {
            var type = document.getElementById("tipomembresia");
            var error1 = document.getElementById("error1");
            var requerido = "<img src='img/errorr.png'width='22' alt='Error' >     Selecciona una membresia";

            //VALIDACION TIPO DE MEMBRESIA
            if (type.value == 0) {
                type.focus();
                error1.innerHTML = requerido;
            } else {
                var precio = document.getElementById("precio").innerText;
                error1.innerHTML = "";
                $('#modalPago').modal('toggle');
                $("#confirmacionP").modal('show');
                $("#montoPagar").html('<strong>Precio de la membres&iacute;a: </strong> $<span id="precioPagar">' + precio + '</span>');
            }
        }

        function cancelarPago() {
            $("#montoPagar").html('');
            $("#confirmacionP").modal('toggle');
            $('#modalPago').modal('show');
        }

        $('#buscador_proximos_pagos').keypress(function(e) {
            if (e.which == 13) {
                $('#btn_buscar_proximos_pagos').click();
            }
        });

        $('#buscador_pagos_proceso').keypress(function(e) {
            if (e.which == 13) {
                $('#btn_buscar_pagos_proceso').click();
            }
            
        });
        $('#buscador_miembros_inactivos').keypress(function(e) {
            if (e.which == 13) {
                $('#btn_buscar_miembros_inactivos').click();
            }
            
        });




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