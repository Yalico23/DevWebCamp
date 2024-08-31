<?php 
namespace Model;

class EventosRegistros extends ActiveRecord{
    protected static $tabla = 'eventos_registros';
    protected static $columnasDB = ['Id','Evento_id','Registro_id'];

    public $Id;
    public $Evento_id;
    public $Registro_id;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? NULL;
        $this->Evento_id = $args['Evento_id'] ?? '';
        $this->Registro_id = $args['Registro_id'] ?? '';
    }
}
?>