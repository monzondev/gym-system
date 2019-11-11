<?php
//clase  para la entidad Empleado
include_once 'conection.php';
class miembro extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad miembro
    private $Querys  = array(
        "create" => "INSERT INTO miembro(id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento, fecha_inicio) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17)",
        "delete" => "DELETE FROM miembro WHERE id_miembro = $1",
        "update"  => "UPDATE miembro SET  id_tipo_membresia = $1, primer_nombre =$2, segundo_nombre =$3, primer_apellido = $4,  segundo_apellido= $5, usuario = $6, identificador = $7, foto=$8, correo = $9, genero = $10, telefono = $11,altura=$12, peso =$13 activo= $14, fecha_nacimiento= $15, fecha_inicio= $16 WHERE id_empleado = $17",
        "findAll" => "SELECT id_miembro, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento, fecha_inicio FROM miembro",
        "findById" => "SELECT id_miembro, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento,fecha_inicio FROM miembro  WHERE id_miembro= $1 ",
        "count" => "SELECT COUNT(id_miembro) FROM miembro",
        "miembrosSinPagos" => "SELECT m.id_miembro, m.id_estado, m.id_tipo_membresia, m.primer_nombre, m.segundo_nombre, m.primer_apellido, m.segundo_apellido, m.usuario, m.identificador, m.foto, m.correo, m.genero, m.telefono,m.altura,m.peso, m.activo, m.fecha_nacimiento,m.fecha_inicio FROM miembro as m WHERE (SELECT count(p.monto) FROM pago as p WHERE p.id_miembro=m.id_miembro)=0",
        "findByIdentifier" => "SELECT id_miembro, identificador FROM miembro wHERE identificador   LIKE $1",
        "findByUser" => "SELECT id_miembro, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento,fecha_inicio FROM miembro  WHERE usuario=  $1 ",
        "findByEstado" => "SELECT id_miembro, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento, fecha_inicio, id_estado FROM miembro  WHERE activo=true AND id_estado=$1 ORDER BY id_miembro ASC",
        "findAllActive" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento, fecha_inicio FROM miembro  WHERE activo=true ORDER BY id_miembro ASC",
        "findLikeNameOrID" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento,fecha_inicio FROM miembro AS m  WHERE CONCAT(m.primer_nombre, ' ', m.segundo_nombre, ' ', m.primer_apellido, ' ', m.segundo_apellido, ' - ', m.identificador) ~* $1 AND m.activo=true ORDER BY m.id_miembro ASC LIMIT 3"
    );
    public function __construct()
    {
        $this->conexion = parent::__construct();
    }



    /*********************************************************************/
    //Metodo para generar el identificador de un miembro
    public function generateCode($apellido1, $apellido2, $anio)
    {
        $identificador = "";
        $buscado = "";
        if ($apellido1 != null && $apellido1 != "") {
            //agrega primera letra del primer apellido
            $identificador .= strtoupper(substr($apellido1, 0, 1));



            if ($apellido2 != null && $apellido2 != "") {
                //agrega primera letra del segundo apellido
                $identificador .= strtoupper(substr($apellido2, 0, 1));
            } else {
                //duplica primera letra de el primer apellido
                $identificador .= strtoupper(substr($apellido1, 0, 1));
            }

            $buscado = $identificador;

            if ($anio != null && $anio != 0  && strlen($anio) > 3) {
                //agrega ultimos dos digitos del año
                $identificador .= substr($anio, -2, 2);
            } else {
                $identificador = null;
            }


            if ($identificador != null) {
                //busca si el identidicador se repite los primeros 4 digitos
                $resultado = $this->findByIdentifier($buscado);
                if ($resultado != null && count($resultado) > 0) {
                    $numeroConCeros = str_pad((count($resultado) + 1), 3, "0", STR_PAD_LEFT);
                    $identificador .= $numeroConCeros;
                } else {
                    $numeroConCeros = str_pad((1), 3, "0", STR_PAD_LEFT);
                    $identificador .= $numeroConCeros;
                }
            }
        } else {
            $identificador = null;
        }
        return $identificador;
    }

    /*********************************************************************/
    //Metodo para filtrar miembros por su identificador
    public function findByIdentifier($identifier)
    {
        $query = $this->Querys['findByIdentifier'];
        $result = pg_query_params($this->conexion, $query, array("%" . $identifier . "%"));
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los miembros con ese identificador
        return $allRows;
    }

     //Metodo para validar que el usuario este o no este en la base de datos
     public function validateUser($name)
     {
         $query = $this->Querys['findByUser'];
         $result = pg_query_params($this->conexion, $query, array($name));
         if (pg_num_rows($result)) {
             $userFound = true;
         } else {
             $userFound = false;
         }
         //devuelve el estado de la busqueda
         return $userFound;
     }


    /*********************************************************************/
    //Metodo que crea un nuevo miembro  al sistema
    public function agregarMiembro($array){
        $fecha =date("Y-m-d");
        if (is_bool($array['genero'])){
            $array['genero'] = ($array['genero']) ? 'true':'false';
        }
        $query = $this->Querys['create'];
        $result = pg_query_params($this->conexion, $query, array($array['id_estado'], $array['tipomembresia'],$array['primer_nombre'], $array['segundo_nombre'],
                                                                $array['primer_apellido'], $array['segundo_apellido'], $array['usuario'],
                                                                $array['identificador'], $array['foto'],$array['correo'], $array['genero'],
                                                                $array['telefono'], $array['altura'], $array['peso'], $array['activo'],$array['fecha'],$fecha));
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;
    }

     /*********************************************************************/
    //Metodos que devuelve a todos los empleados activos
    public function getAllActiveMiembros()
    {
        $query = $this->Querys['findAllActive'];
        $result = pg_query($this->conexion, $query);
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los empleados
        return $allRows;
    }

    /*********************************************************************/
    //Metodo para obtener un miembto por id_miembro este en la base de datos
    public function getMiembrobyId($idmiembro)
    {
        $query = $this->Querys['findById'];
        $result = pg_query_params($this->conexion, $query, array($idmiembro));
        if (pg_num_rows($result)) {
            $row = pg_fetch_assoc($result);
        } else {
            $row = null;
        }
        return $row;
    }

    /*********************************************************************/
    //Metodo para obtener un miembto por Name o ID este en la base de datos
    public function getFilterNameId($txt)
    {
        $query = $this->Querys['findLikeNameOrID'];
        $result = pg_query_params($this->conexion, $query, array($txt));
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los empleados
        return $allRows;
    }

    /*********************************************************************/
    //Metodo para obtener los miembros por el id del estado
    public function getFilterByEstado($estado)
    {
        $query = $this->Querys['findByEstado'];
        $result = pg_query_params($this->conexion, $query, array($estado));
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los miembros
        return $allRows;
    }


    /*********************************************************************/
    //Metodo para obtener los miembros que tengan proximos pagos
    public function getMiembrosProximosPagos()
    {
        $fecha = "".date("Y")."-".date("m")."-".date("d")."";
        $query = $this->Querys['miembrosSinPagos'];
        $result = pg_query($this->conexion, $query);
        $result2 = pg_query($this->conexion, "SELECT m.id_miembro, m.id_estado, m.id_tipo_membresia, m.primer_nombre, m.segundo_nombre, m.primer_apellido, m.segundo_apellido, m.usuario, m.identificador, m.foto, m.correo, m.genero, m.telefono,m.altura,m.peso, m.activo, m.fecha_nacimiento,m.fecha_inicio FROM miembro as m JOIN pago as p ON m.id_miembro=p.id_miembro WHERE m.id_tipo_membresia=3 AND ((timestamp '{$fecha}')- p.date_time)>=interval '5 days'");
        $result3 = pg_query($this->conexion, "SELECT m.id_miembro, m.id_estado, m.id_tipo_membresia, m.primer_nombre, m.segundo_nombre, m.primer_apellido, m.segundo_apellido, m.usuario, m.identificador, m.foto, m.correo, m.genero, m.telefono,m.altura,m.peso, m.activo, m.fecha_nacimiento,m.fecha_inicio FROM miembro as m JOIN pago as p ON m.id_miembro=p.id_miembro WHERE m.id_tipo_membresia=2 AND ((timestamp '{$fecha}')- p.date_time)>=interval '13 days'");
        $result4 = pg_query($this->conexion, "SELECT m.id_miembro, m.id_estado, m.id_tipo_membresia, m.primer_nombre, m.segundo_nombre, m.primer_apellido, m.segundo_apellido, m.usuario, m.identificador, m.foto, m.correo, m.genero, m.telefono,m.altura,m.peso, m.activo, m.fecha_nacimiento,m.fecha_inicio FROM miembro as m JOIN pago as p ON m.id_miembro=p.id_miembro WHERE m.id_tipo_membresia=1 AND ((timestamp '{$fecha}')- p.date_time)>=interval '28 days'");

        //$miembros = array();
        if ($result) {
            $allRows = pg_fetch_all($result);
            if (!empty($allRows)) {
                if($result2){
                    $allRows2 = pg_fetch_all($result2);
                    if(!empty($allRows2)){
                        $allRows = array_merge($allRows, $allRows2);
                    }
                }
                if($result3){
                    $allRows3 = pg_fetch_all($result3);
                    if(!empty($allRows3)){
                        $allRows = array_merge($allRows, $allRows3);
                    }
                }
                if($result4){
                    $allRows4 = pg_fetch_all($result4);
                    if (!empty($allRows4)) {
                        $allRows = array_merge($allRows, $allRows4);
                    }
                }
            }
        } else {
            $allRows = null;
        }
        return $allRows;
    }

}
