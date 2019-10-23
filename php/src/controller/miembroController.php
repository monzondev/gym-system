<?php
    /*********************************************************************************************************** */
    //CODFIGO DE EJEMPLO PARA AGREGAR UN MIEMBRO AL SISTEMA
    include_once '../boundary/miembro.php';
    $miembro = new miembro();

    $_POST['genero'] = 1;
    $_POST['tipomembresia'] = 1;
    $_POST['primer_nombre'] = "Victor";
    $_POST['segundo_nombre'] = "Jose";
    $_POST['primer_apellido'] = "Umaña";
    $_POST['segundo_apellido'] = "Gomez";
    $_POST['usuario'] = "Jvictor";
    $_POST['foto']="ruta_foto";
    $_POST['correo'] = "test123@gmail.com";
    $_POST['telefono'] = '75645323';
    $_POST['altura'] = 1.70;
    $_POST['peso'] = 150.50;
    $_POST['fecha'] = '2019-10-10';


    $identificador = $miembro->generateCode($_POST['primer_apellido'], $_POST['segundo_apellido'], date("Y"));
    if ($usuario != null) {
        echo "<center><h2>Codigo generado: " . $identificador . '</h2></center><br>';

        if ($_POST['genero'] == 1) {
            $genero = true;
        } else  if ($_POST['genero'] == 0) {
            $genero = false;
        }
        $arrayMiembro = [
            "tipomembresia" => $_POST['tipomembresia'],
            "primer_nombre" => $_POST['primer_nombre'],
            "segundo_nombre" => $_POST['segundo_nombre'],
            "primer_apellido" => $_POST['primer_apellido'],
            "segundo_apellido" => $_POST['segundo_apellido'],
            "usuario" => $_POST['usuario'],
            "foto" =>  $_POST['foto'],
            "identificador" => $identificador,
            "correo" => $_POST['correo'],
            "genero" => $genero,
            "telefono" => $_POST['telefono'],
            "altura" => $_POST['altura'],
            "peso" => $_POST['peso'],
            "activo" => true,
            "fecha" => $_POST['fecha']
        ];

  /*      if ($miembro->agregarMiembro($arrayMiembro)) {
            echo '<center><h1>Miembro agregado con exito</h1></center>';
        } else {
            echo '<center><h1>Hubo un error al guardar el miembro</h1></center>';
        }*/
    }
    ?>