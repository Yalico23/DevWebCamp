<?php 
namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardControllers{

    public static function index (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        
        $registros = Registro::get(5);
        foreach($registros as $registro){
            $registro->Usuario = Usuario::find($registro->Usuario_id);
        }
        //Calcular los ingresos
        $virtuales = Registro::total('Paquete_id', 2);
        $presenciales = Registro::total('Paquete_id', 1);

        $ingresos = ($virtuales * 46.05) + ($presenciales * 187.95);

        //Obtener Eventos con mas y menos lugares disponibles
        $menos_lugares = Evento::ordernarLimite('Disponibles', 'ASC', 5);
        $mas_lugares = Evento::ordernarLimite('Disponibles', 'DESC', 5);

        $router->render("admin/dashboard/index",[
            "titulo" => "Panel de Administración",
            "registros" => $registros,
            "ingresos" => $ingresos,
            "menos_disponibles" => $menos_lugares,
            "mas_disponibles" => $mas_lugares
        ]);
    }
}

?>