<?php
session_start();
include_once '../boundary/empleado.php';
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
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">            
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h3>Miembros Proximos a Pagar:</h3>
                    <input id="buscador" class="form-control basicAutoSelect" style="width: 85%; float: left;" placeholder="Ingrese nombre del miembro..." onkeypress="return lettersOnly(event);" autocomplete="off" />
                    <button id="btn_buscar" style="float: left;" class="btn btn-primary">Filtrar</button>
                </div>
                <div class="col-md-1"></div>
            </div>
            <br><br>
            <!--fieldset class="scheduler-border">
                <legend class="scheduler-border">Start Time</legend>
                <div class="control-group">
                    <label class="control-label input-label" for="startTime">Start :</label>
                    <div class="controls bootstrap-timepicker">
                        <input type="text" class="datetime" id="startTime" name="startTime" placeholder="Start Time" />
                        <i class="icon-time"></i>
                    </div>
                </div>
            </fieldset-->
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
                <tbody id="table_body">
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
        <div class="col-md-1"></div>
    </div>
    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        <?php
            include_once '../boundary/estado.php';            
            include_once '../boundary/tipo_membresia.php';
            $facadeEstado = new estado;
            $facadeTipoMembrecia = new tipo_membresia;
        ?>
        var estados = <?php echo json_encode($facadeEstado->findAll());?>;
        var tipoMembrecias = <?php echo json_encode($facadeTipoMembrecia->getAllTipoMembresia());?>;       

        function findEstado(idEstado){
            for (e of estados) {
                if(e.id_estado == idEstado){
                    return e;
                }
            }
        }

        function findTipoMebresia(idTipoMebrecia){
            for (tm of tipoMembrecias) {
                if(tm.id_tipo_membresia == idTipoMebrecia){
                    return tm;
                }
            }
        }

        $('#miembrosOptions').hover(function() {
            $('#navbarDropdownMiembros').trigger('click')
        })

        $('#cuentaOptions').hover(function() {
            $('#navbarDropdownCuenta').trigger('click')
        })
        $('#empleadosOptions').hover(function() {
            $('#empleados').trigger('click')
        })
        $('#btn_buscar').click(function() {
            alert("En Desarrollo");
            //var txt = $('#buscador').val();
            //updateTable(txt, 0);
        })

        function getList(txt) {
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            //var txt = $('#buscador').val();
            var list = [];
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/miembroController.php?proximosPagos=true",
                data: JSON.stringify({"id_empleado": id_empleado}),
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

        function eventoSeleccionar(){
            $('.filas').click(function() {
                var id_empleado = $(this).attr('id');
                alert("Modal en Desarrollo con id_empleado="+id_empleado);
                //cargarModal(id_empleado);
            });        
        }
        
        function updateTable(txt){
            var listTable = getList(txt);
            if(listTable.length > 0){
                //Vaciar la tabla
                var tabla = $("#table_body");
                tabla.html("");
                //Llenar la tabla
                $.each( listTable, function( key, value ) {                    
                    var tr = createTableRowWith(value);
                    tabla.append(tr);                    
                });
                eventoSeleccionar();
            }else if(listTable == false && txt.length > 0){
                toastr.warning('No se han encontrado resultados');
            }
        }

        function createTableRowWith(value){
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
            img.setAttribute("src", "../recursos/fotografias/"+value.foto);
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
            td4.innerText = tm.nombre;
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
            updateTable("");
        });
    </script>
</body>

</html>