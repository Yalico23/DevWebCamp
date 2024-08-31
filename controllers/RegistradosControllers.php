<?php 
namespace Controllers;

use Clases\Paginacion;
use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistradosControllers{

    public static function index (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }

        $pagina_actual = $_GET['page'];
        if (!$pagina_actual || $pagina_actual < 1) {
            header("Location: /admin/registrados?page=1");
        }
        $pagina_actual = filter_var($pagina_actual , FILTER_VALIDATE_INT);
        $registro_por_pagina = 8;
        $total_registros = Registro::total();

        $paginacion = new Paginacion($pagina_actual, $registro_por_pagina , $total_registros);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header("Location: /admin/registrados?page=1");
        }

        $registros = Registro::paginar($registro_por_pagina , $paginacion->offset());

        foreach($registros as $registro){
            $registro->Usuario = Usuario::find($registro->Usuario_id);
            $registro->Paquete = Paquete::find($registro->Paquete_id);
        }

        $router->render("admin/registrados/index",[
            "titulo" => "Usuarios Registrados",
            "registros" => $registros,
            "paginacion" => $paginacion->paginacion()
        ]);
    }
}

?>