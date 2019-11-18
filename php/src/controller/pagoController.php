<?php
session_start();
include_once '../boundary/pago.php';
include_once '../boundary/miembro.php';
$pago = new pago();
$miembro = new miembro();

if (isset($_GET['realizarPago'])) {
    $arrayPago = [
        "id_miembro" => $_POST['miembro'],
        "id_empleado" => $_SESSION['idEmpleado'],
        "id_tipo_membresia" => $_POST['membresia'],
        "fecha" => $_POST['fecha'],
        "monto" => $_POST['monto']

    ];

    $resultadoPago = $pago->agregarPago($arrayPago);
    if ($resultadoPago) {
        $resultadoCambioEstado = $miembro->CambiarEstadoMiembro($arrayPago['id_miembro'], 1);
        if ($resultadoCambioEstado) {
            $response['tipo'] = '1';
            $response['message'] = 'El pago se realizo con exito';
        } else {
            $response['tipo'] = '2';
            $response['message'] = 'Error al procesar el pago';
        }
    } else {
        $response['tipo'] = '2';
        $response['message'] = 'Error al procesar el pago';
    }




    exit(json_encode($response));
}
