<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
/*
    Para ejecutar esta prueba se debe acceder al contenedor y ejecutar:
    phpunit --bootstrap test/autoload.php test/empleadoTest.php
*/
final class empleadoTest extends TestCase
{
    /*
        Prueba para verificar el metodo getUserbyId
        funcione correctamente
    */
    public function testUserbyId(): void
    {
        // Clase empleado con minuscula, porque asi esta en el boundary
        $facadeEmpleado = new empleado();
        $usuario = 'monzon';//Posee el ID=1
        $empleado = $facadeEmpleado->getUserbyId(1);
        $empleado = (object) $empleado;
        /*
            Esta prueba da error porque dentro boundary/empleado.php
            hay una funcion que provoca que la prueba de ERROR, la funcion es:
            session_start();
        */
        $this->assertEquals($empleado->usuario, $usuario);
    }
}
