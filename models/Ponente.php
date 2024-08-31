<?php 
namespace Model;

class Ponente extends ActiveRecord{

    protected static $tabla = 'ponentes';
    protected static $columnasDB = ['Id', 'Nombre', 'Apellido', 'Ciudad', 'Pais', 'Imagen', 'Tags', 'Redes'];

    public $Id;
    public $Nombre;
    public $Apellido;
    public $Ciudad;
    public $Pais;
    public $Imagen;
    public $Tags;
    public $Redes;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Apellido = $args['Apellido'] ?? '';
        $this->Ciudad = $args['Ciudad'] ?? '';
        $this->Pais = $args['Pais'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
        $this->Tags = $args['Tags'] ?? '';
        $this->Redes = $args['Redes'] ?? '';
    }

    public function validar() {
        if(!$this->Nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->Apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->Ciudad) {
            self::$alertas['error'][] = 'El Campo Ciudad es Obligatorio';
        }
        if(!$this->Pais) {
            self::$alertas['error'][] = 'El Campo País es Obligatorio';
        }
        if(!$this->Imagen) {
            self::$alertas['error'][] = 'La imagen es obligatoria';
        }
        if(!$this->Tags) {
            self::$alertas['error'][] = 'El Campo áreas es obligatorio';
        }
    
        return self::$alertas;
    }

    public function StringRedes(){
        $this->Redes = json_encode($this->Redes,JSON_UNESCAPED_SLASHES);
    }
}
?>