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
    <title>Estadisticas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/toastr.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>
<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 text-center">            
            <h1>Ingresos de por d&#237;a</h1>
            <input type="date" class="form-control" style="width: 50%; display: inline-block;" id="fecha">
            <input class="btn btn-info" id="btn_fecha" type="button" value="Buscar">
            <br><br>
            <canvas id="grafica-ingresos" style=""></canvas>
            <br><hr><br>
            <h1>Miembros Por Estado</h1>
            <br>
            <canvas id="miembros_por_estado" style=""></canvas>
            <br><hr><br>
            <h1>Total de miembros registrados</h1>
            <h1>0</h1>
            <br><hr><br>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="js/jQuery-3-4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mdb.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.js"></script>
    <script>
        $('#miembrosOptions').hover(function() {
            $('#navbarDropdownMiembros').trigger('click')
        })

        $('#cuentaOptions').hover(function() {
            $('#navbarDropdownCuenta').trigger('click')
        })
        $('#empleadosOptions').hover(function() {
            $('#empleados').trigger('click')
        })
    </script>
    <script>
        <?php
            $date = new DateTime("now", new DateTimeZone('America/El_Salvador'));
        ?>
        var date = "<?php echo $date->format('Y-m-d');?>";

        //Poner fecha de hoy al filto de la fecha
        $('#fecha').val(date);        
        $('#btn_fecha').click(function() {
            var f = $('#fecha').val();
            updateIngresosPorDia(f);
        });

        function updateIngresosPorDia(fecha){
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/estadisticaController.php?ingresosPorDia=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado, "fecha": fecha
                }),
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (typeof response.code !== 'undefined') {
                        toastr.error(response.message);
                    } else {
                        if(typeof myChart !== 'undefined'){
                            myChart.destroy();
                        }
                        llenarGraficaBar("grafica-ingresos", response);
                    }
                }
            });
        }

        function updateMiembroPorEstado(){
            var id_empleado = <?php echo $_SESSION['idEmpleado']; ?>;
            $.ajax({
                type: "POST",
                async: false,
                url: "../controller/estadisticaController.php?miembrosPorEstado=true",
                data: JSON.stringify({
                    "id_empleado": id_empleado
                }),
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (typeof response.code !== 'undefined') {
                        toastr.error(response.message);
                    } else {
                        llenarGraficaPie("miembros_por_estado", response);
                    }
                }
            });
        }

        

        $(document).ready(function() {
            var f = $('#fecha').val();
            updateIngresosPorDia(f);            
            updateMiembroPorEstado();
        });


    </script>
    <script>
        var myChart;
        //llenarGrafica(document.getElementById("myChart").getContext('2d'), d)
        function llenarGraficaBar(id, d){            
            var ctx = document.getElementById(id).getContext('2d');
            //var ctx = document.getElementById("myChart").getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: d.labels,
                    datasets: [{
                        label: 'Ingresos $',
                        data: d.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(45, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(80, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
        function llenarGraficaPie(id, d){
            var ctxP = document.getElementById(id).getContext('2d');
            //var ctx = document.getElementById("myChart").getContext('2d');            
            var myPieChart = new Chart(ctxP, {
                type: 'pie',
                data: {
                    //labels: ["Activos", "Pendientes", "Inactivos"],
                    labels: d.labels,
                    datasets: [{
                        //data: [300, 50, 100],
                        data: d.data,
                        backgroundColor: ["#46BFBD", "#FDB45C", "#F7464A", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#5AD3D1", "#FFC870", "#FF5A5E", "#A8B3C5", "#616774"]
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }
    </script>
</body>
</html>