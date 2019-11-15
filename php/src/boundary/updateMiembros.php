<?php
    include_once 'miembro.php';
    $miembroFacade = new miembro();

    $miembros = $miembroFacade->getMiembrosPagosEnProceso();
    $date = new DateTime("now", new DateTimeZone('America/El_Salvador'));

    $counter = 0;
    $response = array('message' => 'uptodate', 'counter' => 0, 'code' => 1);

    if($miembros != null){
        foreach ($miembros as $m){
            $m = (object) $m;
            echo json_encode($m->id_tipo_membresia);
            $fin_membresia = new DateTime($m->fin_membresia);
            $diffInDays = $fin_membresia->diff($date)->days;
            //Si la diferencia de los dias es mayor a 7 dias cambiar Estado a Inactivo miembro
            if($diffInDays >= 7){
                $m->id_estado = 3;  //3 es estado Inactivo
                //Hacer el cambio en la base de datos
                if($miembroFacade->editMiembro($m)){
                    $counter += 1;
                }else{
                    $response['code'] = 2;
                    $response['message'] = 'Error de la conexion';
                }
            }        
        }
    }

    $response['counter'] = $counter;
    echo json_encode($response);
?>