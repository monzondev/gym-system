<?php
//clase  para la entidad Empleado
include_once 'conection.php';
class miembro extends conector_pg
{
    private $conexion = null;

    //consultas sql para la entidad miembro
    private $Querys  = array(
        "create" => "INSERT INTO miembro(id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18)",
        "delete" => "DELETE FROM miembro WHERE id_miembro = $1",
        "update"  => "UPDATE miembro SET  id_estado = $1, id_tipo_membresia = $2, primer_nombre = $3, segundo_nombre = $4, primer_apellido = $5,  segundo_apellido = $6, usuario = $7, foto = $8, correo = $9, genero = $10, telefono = $11,altura=$12, peso =$13 activo= $14, fecha_nacimiento= $15, fecha_inicio= $16, inicio_membresia= $17, fin_membresia= $18 WHERE id_empleado = $19",
        "findAll" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia FROM miembro",
        "findById" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia FROM miembro WHERE id_miembro= $1 ",
        "count" => "SELECT COUNT(id_miembro) FROM miembro",
        "miembrosSinPagos" => "SELECT m.id_miembro, m.id_estado, m.id_tipo_membresia, m.primer_nombre, m.segundo_nombre, m.primer_apellido, m.segundo_apellido, m.usuario, m.foto, m.correo, m.genero, m.telefono, m.altura, m.peso, m.activo, m.fecha_nacimiento, m.fecha_inicio, m.inicio_membresia, m.fin_membresia FROM miembro as m WHERE (SELECT count(p.monto) FROM pago as p WHERE p.id_miembro = m.id_miembro)=0",
        "proximosPagar" => "SELECT m.id_miembro, m.id_estado, m.id_tipo_membresia, m.primer_nombre, m.segundo_nombre, m.primer_apellido, m.segundo_apellido, m.usuario, m.foto, m.correo, m.genero, m.telefono, m.altura, m.peso, m.activo, m.fecha_nacimiento, m.fecha_inicio, m.inicio_membresia, m.fin_membresia FROM miembro as m WHERE m.fin_membresia IS NULL OR (EXTRACT(DAY FROM (CURRENT_TIMESTAMP)-(m.fin_membresia::timestamp))) BETWEEN 0 AND 3",
        "findByUser" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia FROM miembro  WHERE usuario = $1",
        "findByEstado" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia FROM miembro  WHERE activo = true AND id_estado = $1 ORDER BY id_miembro ASC",
        "findAllActive" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia FROM miembro  WHERE activo=true ORDER BY id_miembro ASC",
        "findLikeNameOrID" => "SELECT id_miembro, id_estado, id_tipo_membresia, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, foto, correo, genero, telefono, altura, peso, activo, fecha_nacimiento, fecha_inicio, inicio_membresia, fin_membresia FROM miembro AS m  WHERE CONCAT(m.primer_nombre, ' ', m.segundo_nombre, ' ', m.primer_apellido, ' ', m.segundo_apellido, ' - ', m.usuario) ~* $1 AND m.activo=true ORDER BY m.id_miembro ASC LIMIT 3"
    );
    public function __construct()
    {
        $this->conexion = parent::__construct();
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
        
        $query = $this->Querys['create'];
        $result = pg_query_params($this->conexion, $query, array(
            $array['id_estado'], $array['id_tipo_membresia'], $array['primer_nombre'],
            $array['segundo_nombre'], $array['primer_apellido'], $array['segundo_apellido'],
            $array['usuario'], $array['foto'], $array['correo'], $array['genero'],
            $array['telefono'], $array['altura'], $array['peso'], $array['activo'],
            $array['fecha_nacimiento'], $array['fecha_inicio'], $array['inicio_membresia'], $array['fin_membresia']
        ));

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
        $query = $this->Querys['proximosPagar'];
        $result = pg_query($this->conexion, $query);
        if ($result) {
            $allRows = pg_fetch_all($result);
        } else {
            $allRows = null;
        }
        //devuelve todos los miembros
        return $allRows;
    }

}
