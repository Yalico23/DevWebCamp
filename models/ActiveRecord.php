<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'Id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->Id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Todos los registros
    public static function all($variable = 'Id' ,$tipo = 'ASC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY $variable $tipo";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($Id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE Id = '$Id'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    // Busca un registro por variable
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE $columna = '$valor'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    //Where Array
    public static function whereArray($array = []){
        $query = "SELECT * FROM " . static::$tabla . " WHERE ";
        $and = "";
        foreach ($array as $key => $value){
            $query .= $and . " $key = '$value'";
            $and .= " AND";
        }
        //echo $query;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // Busca un registro por variable
    public static function whereAll($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE $columna = '$valor'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //ordenar
    public static function ordernar($columna, $orden){
        $query = "SELECT * FROM " . static::$tabla  ." ORDER BY $columna  $orden";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //ordenar y limitar 
    public static function ordernarLimite($columna, $orden, $limite){
        $query = "SELECT * FROM " . static::$tabla  ." ORDER BY $columna  $orden LIMIT $limite";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //PAGINACION
    public static function total($columna = '' , $valor = ''){
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        if($columna){
            $query.= " WHERE $columna = '$valor' ";
        }
        $resultado = self::$db->query($query);
        $total = $resultado->fetch_array();
        return array_shift($total);
    }
    //PAGINACION
    public static function paginar($porPagina , $offset){
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY Id DESC LIMIT $porPagina OFFSET $offset";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    
    // Busca un registro por variable
    public static function SQL($consulta) {
        $query = "$consulta";
        $resultado = self::consultarSQL($query);
        return $resultado ;
    }

    // Busca un registro por variable
    public static function SQLEliminar($consulta) {
        $query = "$consulta";
        self::$db->query($query);
        $resultado = self::$db->affected_rows;
    
        return $resultado > 0;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $limite";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'Id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE Id = '" . self::$db->escape_string($this->Id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE Id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    /******************************************** */
    //Subida de archivos
    public function SetFiles($Imagen)
    {
        //Elimina la imagen previa
        //Leemos el Id ya que cuando creamos una propiedad aun no se crea el Id pero al actualizar el Id existe en la BD
        if (!is_null($this->Id)) {
            $this->BorrarImagen();
        }
        //Luego agregamos el nuevo nombre de la Imagen
        if ($Imagen) {
            $this->Imagen = $Imagen;
        }
    }
    public function BorrarImagen()
    {
        //Comprobar si existe el archivo
        $existeimagenPNG = file_exists(trim(CARPETA_SPEAKERS . $this->Imagen . ".png"));//trim para quitar espacion en blanco
        $existeimagenWEBP = file_exists(trim(CARPETA_SPEAKERS . $this->Imagen . ".webp"));//trim para quitar espacion en blanco
        if ($existeimagenPNG) {
            unlink(trim(CARPETA_SPEAKERS . $this->Imagen . ".png"));
        }
        if ($existeimagenWEBP) {
            unlink(trim(CARPETA_SPEAKERS . $this->Imagen . ".webp"));
        }
    }
    /******************************************** */

}