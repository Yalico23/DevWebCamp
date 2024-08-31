<?php 
namespace Model;

class Hora extends ActiveRecord{
    protected static $tabla = 'horas';
    protected static $columnasDB = ['Id' , 'Hora'];

    public $Id;
    public $Hora;
    
}
?>