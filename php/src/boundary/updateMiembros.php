<?php
    include_once 'miembro.php';
    $miembroFacade = new miembro();

    $miembros = $miembroFacade->getAllActiveMiembros();
    $date = new DateTime("now", new DateTimeZone('America/El_Salvador'));

    $counter = 0;
    $response = array('message' => 'uptodate', 'counter' => 0, 'code' => 1);

    if($miembros != null){
        foreach ($miembros as $m){
            $m = (object) $m;
            $memberChange = false;
            # Recien Creado es id_estado==2 id_membresia=null y fin_membresia=null
            # Si esto entonces verificar si lleva mas de 7 dias desde su fecha_inicio
            # Luego cambiar estado a inactivar
            if($m->id_estado == 2 && $m->id_membresia == null && $m->fin_membresia == null){
                $fecha_inicio = new DateTime($m->fecha_inicio);
                $diffInDays = $date->diff($fecha_inicio)->format("%r%a");
                echo $diffInDays;
                if($diffInDays >= 7){
                    $m->id_estado = 3;  //3 es estado Inactivo
                    $memberChange = true;
                }
            }
            # Si esta activo estado=1 y su fin_membresia!=null 
            # si la diferencia de dias es 0 dias o dias negativos
            # Cambiar estado a Pendiente
            if($m->id_estado == 1 && $m->fin_membresia != null){
                $fin_membresia = new DateTime($m->fin_membresia);
                $diffInDays = $date->diff($fin_membresia)->format("%r%a");
                if($diffInDays >= 0){
                    $m->id_estado = 2;  //2 es estado Pendiente
                    $memberChange = true;
                }
            }
            # Si esta pendiente estado=2 y su fin_membresia!=null se encuentra en el dia de hoy
            # Cambiar estado a Inactivo
            if($m->id_estado == 2 && $m->fin_membresia != null){
                $fin_membresia = new DateTime($m->fin_membresia);
                $diffInDays = $date->diff($fin_membresia)->format("%r%a");
                if($diffInDays >= 7){
                    $m->id_estado = 3;  //3 es estado Inactivo
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
?>