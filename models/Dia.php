<?php 
namespace Model;

class Dia extends ActiveRecord{
    protected static $tabla = 'dias';
    protected static $columnasDB = ['Id' , 'Nombre'];

    public $Id;
    public $Nombre;
    
}
?>