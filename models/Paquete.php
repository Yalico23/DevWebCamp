<?php 
namespace Model;

class Paquete extends ActiveRecord{

    protected static $tabla = 'paquetes';
    protected static $columnasDB = ['Id', 'Nombre'];

    public $Id;
    public $Nombre;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
    }
}
?>