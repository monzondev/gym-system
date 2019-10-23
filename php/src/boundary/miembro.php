<?php
//clase  para la entidad Empleado
include_once 'conection.php';
class miembro extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad miembro
    private $Querys  = array(
        "create" => "INSERT INTO miembro(id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimiento) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15)",
        "delete" => "DELETE FROM miembro WHERE id_miembro = $1",
        "update"  => "UPDATE miembro SET  id_tipo_membresia = $1, primer_nombre =$2, segundo_nombre =$3, primer_apellido = $4,  segundo_apellido= $5, usuario = $6, identificador = $7, foto=$8, correo = $9, genero = $10, telefono = $11,altura=$12, peso =$13 activo= $14, fecha_nacimiento= $15 WHERE id_empleado = $16",
        "findAll" => "SELECT id_miembro, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimientoFROM miembro",
        "findById" => "SELECT id_miembro, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, identificador, foto, correo, genero, telefono,altura,peso, activo, fecha_nacimientoFROM miembro  WHERE id_miembro= $1 ",
        "count" => "SELECT COUNT(id_miembro) FROM miembro",
        "findByIdentifier" => "SELECT id_miembro, identificador FROM miembro wHERE identificador   LIKE $1"
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


    /*********************************************************************/
    //Metodo que crea un nuevo miembro  al sistema
    public function agregarMiembro($array){
        if (is_bool($array['genero'])){
            $array['genero'] = ($array['genero']) ? 'true':'false';
        }
        $query = $this->Querys['create'];
        $result = pg_query_params($this->conexion, $query, array($array['tipomembresia'],$array['primer_nombre'], $array['segundo_nombre'],
                                                                $array['primer_apellido'], $array['segundo_apellido'], $array['usuario'],
                                                                $array['identificador'], $array['foto'],$array['correo'], $array['genero'],
                                                                $array['telefono'], $array['altura'], $array['peso'], $array['activo'],$array['fecha']));
        if ($result) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        //devuelve resultado
        return $resultado;
    }
}
