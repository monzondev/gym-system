<?php
    include_once '/var/www/html/boundary/miembro.php';
    $miembroFacade = new miembro();

    $miembros = $miembroFacade->getAllActiveMiembros();
    $date = new DateTime("now", new DateTimeZone('America/El_Salvador'));

    $counter = 0;
    $response = array('message' => 'uptodate', 'counter' => 0, 'code' => 1);

    if($miembros != null){
        foreach ($miembros as $m){
            $m = (object) $m;
            $memberChange = false;
            # Si esta activo estado=1 y su fin_membresia!=null 
            # si la diferencia de dias es 0 dias o dias negativos
            # Cambiar estado a Pendiente
            if($m->id_estado == 1){
                $fin_membresia = new DateTime($m->fin_membresia);
                $diffInDays = $date->diff($fin_membresia)->format("%r%a");
                if($diffInDays >= 0){
                    $m->id_estado = 2;  //2 es estado Pendiente
                    $memberChange = true;
                }
            }
            # Verificar si es necesario Actualizar al miembro
            if($memberChange){
                $miembroFacade->editMiembro($m);
                $counter += 1;
            }
        }
    }

    $response['counter'] = $counter;
    echo json_encode($response);
    echo "\r\n";
    exit();
?>