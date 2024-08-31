<?php 
namespace Controllers;

use MVC\Router;

class RegalosControllers{

    public static function index (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        $router->render("admin/regalos/index",[
            "titulo" => "Regalos"
        ]);
    }
}

?>