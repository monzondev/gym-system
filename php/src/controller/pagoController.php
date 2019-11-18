<?php
session_start();
include_once '../boundary/pago.php';
$pago =new pago();

if (isset($_GET['realizarPago']))  {
        $arrayPago= [
            "id_miembro" => $_POST['miembro'],
            "id_empleado" => $_SESSION['idEmpleado'],
            "id_tipo_membresia" => $_POST['membresia'],
            "fecha" => $_POST['fecha'],
            "monto" => $_POST['monto']

        ];

        $reultadoPago = $pago->agregarPago($arrayPago);
        if ($reultadoPago) {
            $response['tipo'] = '1';
            $response['message'] = 'El pago se realizo con exito';
        } else {
            $response['tipo'] = '2';
            $response['message'] = 'Error al procesar el pago';
        }
        
  
      
    
    exit(json_encode($response));
}
?>