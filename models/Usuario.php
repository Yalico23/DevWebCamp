<?php 
namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['Id' , 'Nombre' , 'Apellido' , 'Email' , 'Password' , 'Confirmado' , 'Token' , 'Admin'];

    public $Id;
    public $Nombre;
    public $Apellido;
    public $Email;
    public $Password;
    public $Confirmado;
    public $Token;
    public $Admin;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Apellido = $args['Apellido'] ?? '';
        $this->Email = $args['Email'] ?? '';
        $this->Password = $args['Password'] ?? '';
        $this->Confirmado = $args['Confirmado'] ?? '0';
        $this->Token = $args['Token'] ?? '';
        $this->Admin = $args['Admin'] ?? '0';
    }

    public function validar(){
        $this->Nombre = trim($this->Nombre);
        $this->Apellido = trim($this->Apellido);
        $this->Email = trim($this->Email);
        $this->Password = trim($this->Password);
    
        // Validación de campos
        if(empty($this->Nombre)) {
            self::$alertas['error'][] = 'Nombre is required';
        }
        if(empty($this->Apellido)) {
            self::$alertas['error'][] = 'Apellido is required';
        }
        if(empty($this->Email) || !filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email is required and must be valid';
        }
        if(empty($this->Password)) {
            self::$alertas['error'][] = 'Password is required';
        } elseif(strlen($this->Password) < 6) {
            self::$alertas['error'][] = 'Password must be at least 6 characters long';
        } elseif(preg_match('/[\'"\/\\\<\>\%\;\(\)]/', $this->Password)) {
            self::$alertas['error'][] = 'Password contains invalid characters';
        }
    
        return self::$alertas;
    }

    public function validarEmail(){
        !$this->Email ? self::$alertas['error'][] = 'Email is required' : '';
                
        return self::$alertas;
    }
    public function validarPassword(){
        if (!$this->Password) {
            self::$alertas['error'][] = "Password is required";
        } else {
            if (strlen($this->Password) < 6) {
                self::$alertas['error'][] = "Password is too short";
            }
        }        
        return self::$alertas;
    }

    public function validarLogin(){
        $this->Email = trim($this->Email);
        $this->Password = trim($this->Password);

        if(empty($this->Email) || !filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email is required and must be valid';
        }
        if(empty($this->Password)) {
            self::$alertas['error'][] = 'Password is required';
        } elseif(strlen($this->Password) < 6) {
            self::$alertas['error'][] = 'Password must be at least 6 characters long';
        } elseif(preg_match('/[\'"\/\\\<\>\%\;\(\)]/', $this->Password)) {
            self::$alertas['error'][] = 'Password contains invalid characters';
        }
    
        return self::$alertas;
    }
    //Revisa si el user existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE Email = '". $this->Email ."' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][]='El usuario ya esta registrado';
        }
        return $resultado;
    }
    public function checkPassword($Password){
        $resultado = password_verify($Password,$this->Password);
        if (!$resultado || !$this->Confirmado) {
            self::$alertas['error'][]="Password incorrect or couldn't be verified";
        }else{
            return true;
        }
    }

    public function hashearPassword() : void{
        $this->Password = password_hash($this->Password, PASSWORD_BCRYPT);
    }
    public function crearToken() : void{
        $this->Token = uniqid();
    }
    public function confirmarUsuario() : void{
        $this->Confirmado = 1;
        $this->Token = '';
    }
    
}
?>