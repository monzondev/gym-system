<?php
include_once '../boundary/pago.php';
include_once '../boundary/miembro.php';
include_once '../boundary/empleado.php';
$pagoFacade = new pago();
$miembroFacade = new miembro();
$empleadoFacade = new empleado();

if (isset($_GET['ingresosPorDia']) && $_GET['ingresosPorDia']) {
    $json = file_get_contents('php://input');
    $fecha = (json_decode($json))->fecha;
    $id_empleado = (json_decode($json))->id_empleado;
    $empleado = (object) $empleadoFacade->getUserbyId($id_empleado);
    if(isset($empleado) && $empleado->id_tipo_empleado == 1){
        $end = new DateTime($fecha);
        $begin = new DateTime($end->format("Y-m-d"));
        $begin->sub(new DateInterval('P7D'));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $ingresos = new stdClass();
        $ingresos->labels = array();
        $ingresos->data = array();
        foreach ($period as $dt) {            
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $dayName = $dias[$dt->format('N')-1];
            $dayName = $dayName . " " . $dt->format("d");
            $income = $miembroFacade->obternerVentas($dt->format("Y-m-d"));
            array_push($ingresos->data, $income);
            array_push($ingresos->labels, $dayName);
        }        
        echo json_encode($ingresos);        
    }else{
        $response = array('message' => 'No tiene permisos de administrador', 'code' => 2);
        echo json_encode($response);
    }
    exit();
}

if (isset($_GET['miembrosPorEstado']) && $_GET['miembrosPorEstado']) {
    $json = file_get_contents('php://input');    
    $id_empleado = (json_decode($json))->id_empleado;
    $empleado = (object) $empleadoFacade->getUserbyId($id_empleado);
    if(isset($empleado) && $empleado->id_tipo_empleado == 1){        
        $miembros = new stdClass();
        $miembros->labels = array("Activos", "Pendientes", "Inactivos");
        $activos = $miembroFacade->countByEstado(1);
        $pendientes = $miembroFacade->countByEstado(2);
        $inactivos = $miembroFacade->countByEstado(3);
        $miembros->data = array($activos, $pendientes, $inactivos);              
        echo json_encode($miembros);        
    }else{
        $response = array('message' => 'No tiene permisos de administrador', 'code' => 2);
        echo json_encode($response);
    }
    exit();
}

if (isset($_GET['totalMiembros']) && $_GET['totalMiembros']) {
    $json = file_get_contents('php://input');    
    $id_empleado = (json_decode($json))->id_empleado;
    $empleado = (object) $empleadoFacade->getUserbyId($id_empleado);
    if(isset($empleado) && $empleado->id_tipo_empleado == 1){        
        $miembros = $miembroFacade->count();
        echo json_encode($miembros);        
    }else{
        $response = array('message' => 'No tiene permisos de administrador', 'code' => 2);
        echo json_encode($response);
    }
    exit();
}

header('Location: /view/index.php');
exit();
?>