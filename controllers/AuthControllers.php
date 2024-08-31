<?php

namespace Controllers;

use MVC\Router;
use Clases\Email;
use Model\Usuario;

class AuthControllers
{

    public static function login(Router $router)
    {
        
        $titulo = 'Iniciar Sesión';
        // $usuario = new Usuarios();
        $alertas = [];
        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();
            if (empty($alertas)) {
                $auth = Usuario::where('Email', $usuario->Email);
                if (is_null($auth) || $auth->Confirmado === '0') {
                    Usuario::setAlerta('error', 'Usuario no encontrado o no confirmado');
                }else{
                    //verificar Password
                    if (password_verify($usuario->Password, $auth->Password)) {
                        //Iniciar Sesion
                        session_start();
                        $_SESSION['Id'] = $auth->Id;
                        $_SESSION['Nombre'] = $auth->Nombre;
                        $_SESSION['Email'] = $auth->Email;
                        $_SESSION['Login'] = true;
                        $_SESSION['Admin'] = $auth->Admin ?? null;
                        //Redirrecionar
                        if ($auth->Admin) {
                            header("Location: /admin/dashboard");
                        }else{
                            header("Location: /finalizar-registro");
                        }
                    }else{
                        Usuario::setAlerta('error', 'Contraseña incorrecta');
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/login", [
            "titulo" =>$titulo,
            "alertas" =>$alertas,
            "usuario"=>$usuario
        ]);
    }

    public static function logout (){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            session_destroy();
            header("Location: /");
            exit();
        }
    }

    public static function registro(Router $router)
    {
        $usuario = new Usuario();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validar();

            //Revisar si alertas esta vacio
            if (empty($alertas)) {
                //echo "Pasaste la validacion";
                $resultado = $usuario->existeUsuario(); //devuelve el numero de alertas
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas(); //obtnego las alertas que estan en memoria despues de la validacion
                } else {
                    //Hashear el password
                    $usuario->hashearPassword(); //60 caracteres
                    //Generar token unico
                    $usuario->crearToken(); //13 caracteres
                    //Enviar Email
                    $email  = new Email($usuario->Email, $usuario->Nombre, $usuario->Token);
                    $email->EnviarConfirmacion();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render("auth/registro",[
            "titulo"=>"Crea tu Cuenta en DevWebCamps",
            "alertas"=>$alertas,
            "usuario"=>$usuario
        ]);
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas)) {
                $usuario = Usuario::where('Email', $auth->Email);
                if ($usuario && $usuario->Confirmado === '1') {
                    //Generar Token
                    $usuario->crearToken();
                    $usuario->guardar();//usamos el update
                    // Enviar Email
                    $email = new Email($usuario->Email,$usuario->Nombre,$usuario->Token);
                    $email->enviarInstrucciones();
                    //Alerta de Exito
                    Usuario::setAlerta('exito','Check Email');
                }else{
                    Usuario::setAlerta('error','User not found or not confirmed');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/olvide-password", [
            "alertas" => $alertas,
            "titulo" => "Olvide Password"
        ]);
    }

    public static function mensaje(Router $router){
    
        $router->render("auth/mensaje",[
            "titulo" => "Cuenta Creada Correctamente"
        ]);
    }
    
    public static function confirmar(Router $router){
        
        $token = s($_GET['token']);
        $alertas = [];

        if(!$token) header("Location: /");

        //Encontrar usuario
        $usuario = Usuario::where('Token', $token);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            $usuario->confirmarUsuario();
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada Correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar",[
            "titulo" => "Confirma tu cuenta en DevWebCamp",
            "alertas" => $alertas
        ]);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where('Token', $token);
        if (empty($usuario) || $usuario->Token === '') {
            Usuario::setAlerta('error', 'Token no valido o expiro el tiempo');
            $error = true;
        } 
        //no uso el else porque no habria formulario y por ende no existiria el metodo post, entonces si se realiza el post es porque el token es valido
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST);
            $alertas=$password->validarPassword();
            if (empty($alertas)) {
                $usuario->Token = null;
                $usuario->Password=null;
                $usuario->Password=$password->Password;
                $usuario->hashearPassword();
                $resultado=$usuario->guardar();//update
                if ($resultado) {
                    header("Location: /login");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/recuperar", [
            "alertas"=>$alertas,
            "error"=>$error,
            "titulo"=>"Restablecer Contraseña"
        ]);
    }
}
