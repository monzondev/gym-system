<?php
session_start();

include_once '../boundary/pago.php';
include_once '../boundary/miembro.php';
include_once '../boundary/tipo_membresia.php';

$pago = new pago();
$miembro = new miembro();
$membresia = new tipo_membresia();

if (isset($_GET['realizarPago'])) {

    //Obteniendo datos para la realizacion del pago
    $arrayPago = [
        "id_miembro" => $_POST['miembro'],
        "id_empleado" => $_SESSION['idEmpleado'],
        "id_tipo_membresia" => $_POST['membresia'],
        "fecha" => $_POST['fecha'],
        "monto" => $_POST['monto']

    ];

    $resultadoPago = $pago->agregarPago($arrayPago);
     //verificando que se haya realizado el pago
    if ($resultadoPago) {

        //Cambiando el estado del miembro a activo

        $resultadoCambioEstado = $miembro->CambiarEstadoMiembro($arrayPago['id_miembro'], 1);

        //verificando que se haya cambiado el estado
        if ($resultadoCambioEstado) {

            //Obteniendo datos para el cambio de membresia
            $arrayMembresia = [
                "id_tipo_membresia" => $arrayPago['id_tipo_membresia'],
                "fin_membresia" => "",
                "inicio_membresia" => $arrayPago['fecha'],
                "id_miembro" => $arrayPago['id_miembro']
            ];

            //Obteniendo el numero de dias que dura la membresia
            $diasMembresia = $membresia->getDaysByMembresia($arrayPago['id_tipo_membresia']);

            //Obteniendo fecha actual
            $FechaActual = date("Y-m-d");

             //Relizando calculos para obtener la fecha final de la membresia
            $fechaFinal = strtotime($FechaActual . "+ ".$diasMembresia['dias']." days");
            //Asignando la fecha de finalizacion
            $arrayMembresia['fin_membresia'] = date('Y-m-d', $fechaFinal);

            $resustadoAgregarMembresia = $miembro->CambiarMembresia($arrayMembresia);
            //verificando que se haya agregado la membresia
            if ($resustadoAgregarMembresia) {
                $response['tipo'] = '1';
                $response['message'] = 'El pago se realizo con exito';
            } else {

                $response['tipo'] = '2';
                $response['message'] = 'Error al inciar la membresia';
            }
        } else {

            $response['tipo'] = '2';
            $response['message'] = 'Error al reactivar el miembro';
        }
    } else {

        $response['tipo'] = '2';
        $response['message'] = 'Error al procesar el pago';
    }




    exit(json_encode($response));
}
