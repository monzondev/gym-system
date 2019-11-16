<?php
include_once '../boundary/tipo_membresia.php';
$tipoMembresia = new tipo_membresia();


if (isset($_POST['obtenerMembresias'])) {
    if (isset($_POST['id_tipo_membresia'])  && $_POST['id_tipo_membresia'] != "") {

       $membresia =  $tipoMembresia->getTipoMembresia($_POST['id_tipo_membresia']);

       if ($membresia != null) {
            exit(json_encode($membresia));
        } else {
            exit(json_encode(null));
        }
    } else {
        exit(json_encode(null));
    }
}


?>
