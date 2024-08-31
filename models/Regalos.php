<?php 
namespace Model;

class Regalos extends ActiveRecord{
    protected static $tabla = 'regalos';
    protected static $columnasDB = ['Id' , 'Nombre'];

    public $Id;
    public $Nombre;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? NULL;
        $this->Nombre = $args['Nombre'] ?? NULL;
    }
    
}
?>