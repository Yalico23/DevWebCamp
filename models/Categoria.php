<?php 
namespace Model;

class Categoria extends ActiveRecord{
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['Id' , 'Nombre'];

    public $Id;
    public $Nombre;
    
}
?>