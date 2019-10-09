<?php
    //clase para conectarse con la base de datos postgreSQL
    class conector_pg
    {
        //direccion ip del host donde nos conectamos a la bd
        var $host = '172.23.0.2'; //direccion ip del contenedor de postgresql en docker
        //nombre de la base de datos
        var $bd='gym';
        //usuario de conexion
        var $usuario='admin';
        //clave del usuario de conexion
        var $password='admin';
        //almacenamos el link para luego destruirlo
        var $link;

        //constructor en el constructor colocamos los datos por defecto
        function __construct(){
            //emsamblamos el string de conexion
            $datos_bd="host='$this->host' dbname='$this->bd' user='$this->usuario' password='$this->password'";
            //establecemos el link
            $this->link=pg_connect($datos_bd);
            return $this->link;
        }

        //funcion que ejecuta una consulta en la base de datos sin parametros
        function execute($sql){
            //ejecutamos la consulta
            $query = pg_query($this->link,$sql);
            if(!$query) echo $sql;//si no ejecuta la consulta imprimo el sql que llega solo cuando hacemos pruebas
            return $query;
        }

        //destructor: aca elimino la conexion con postgres
        function __destruct(){
            //pg_close($this->link);
        }
        //funcion que devuelve el estado de la conexion
        function comprobar(){
            $stat = pg_connection_status($this->link);
            if ($stat === PGSQL_CONNECTION_OK) {
                echo 'Estado de la conexión correcta';
            } else {
                echo 'No se ha podido conectar';
            }
        }
    }
    ?>