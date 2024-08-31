<?php 
namespace Model;

class Registro extends ActiveRecord{

    protected static $tabla = 'registros';
    protected static $columnasDB = ['Id', 'Paquete_id', 'Pago_id', 'Token', 'Usuario_id', 'Regalos_id'];

    public $Id;
    public $Paquete_id;
    public $Pago_id;
    public $Token;
    public $Usuario_id;
    public $Regalos_id;
    //variable dinamica find
    public $Usuario;
    public $Paquete;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Paquete_id = $args['Paquete_id'] ?? '';
        $this->Pago_id = $args['Pago_id'] ?? '';
        $this->Token = $args['Token'] ?? '';
        $this->Usuario_id = $args['Usuario_id'] ?? '';
        $this->Regalos_id = $args['Regalos_id'] ?? 1;
    }
}
?>