<?php 
namespace Model;

class EventoHorario extends ActiveRecord{
    protected static $tabla = 'eventos';
    protected static $columnasDB = ['Id' , 'Categoria_id' , 'Dia_id' , 'Hora_id'];

    public $Id;
    public $Categoria_id;
    public $Dia_id;
    public $Hora_id;

    
}
?>