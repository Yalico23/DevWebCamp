<?php 
namespace Model;

class Evento extends ActiveRecord{
    protected static $tabla = 'eventos';
    protected static $columnasDB = ['Id' , 'Nombre', 'Descripcion', 'Disponibles', 'Categoria_id', 'Dia_id', 'Hora_id', 'Ponente_id'];

    public $Id;
    public $Nombre;
    public $Descripcion;
    public $Disponibles;
    public $Categoria_id;
    public $Dia_id;
    public $Hora_id;
    public $Ponente_id;
    //para el listado con nombres
    public $Categoria;
    public $Dia;
    public $Hora;
    public $Ponente;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Descripcion = $args['Descripcion'] ?? '';
        $this->Disponibles = $args['Disponibles'] ?? '';
        $this->Categoria_id = $args['Categoria_id'] ?? '';
        $this->Dia_id = $args['Dia_id'] ?? '';
        $this->Hora_id = $args['Hora_id'] ?? '';
        $this->Ponente_id = $args['Ponente_id'] ?? '';
    }
    // Mensajes de validación para la creación de un evento
public function validar() {
    if(!$this->Nombre) {
        self::$alertas['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->Descripcion) {
        self::$alertas['error'][] = 'La descripción es Obligatoria';
    }
    if(!$this->Categoria_id  || !filter_var($this->Categoria_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige una Categoría';
    }
    if(!$this->Dia_id  || !filter_var($this->Dia_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige el Día del evento';
    }
    if(!$this->Hora_id  || !filter_var($this->Hora_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige la hora del evento';
    }
    if(!$this->Disponibles  || !filter_var($this->Disponibles, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Añade una cantidad de Lugares Disponibles';
    }
    if(!$this->Ponente_id || !filter_var($this->Ponente_id, FILTER_VALIDATE_INT) ) {
        self::$alertas['error'][] = 'Selecciona la persona encargada del evento';
    }

    return self::$alertas;
}
}
?>