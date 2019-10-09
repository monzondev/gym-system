<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Gym System</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Style/css/reset.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='Style/css/simple-grid.css'>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10" style="height:100vh;">
            <h1>En Desarrollo</h1>
            <h2> <?php
                    include_once '../Model/Boundary/conection.php';
                    $conexion = new conector_pg();
                    $conexion->comprobar();
                    ?>
            </h2>
        </div>
        <div class="col-1"></div>
    </div>
</body>

</html>