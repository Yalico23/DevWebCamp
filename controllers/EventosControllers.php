<?php 
namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Categoria;
use Clases\Paginacion;
use Model\Ponente;

class EventosControllers{

    public static function index (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }

        // $pagina_actual = $_GET['page'];
        // if (!$pagina_actual || $pagina_actual < 1) {
        //     header("Location: /admin/eventos?page=1");
        // }
        // $pagina_actual = filter_var($pagina_actual , FILTER_VALIDATE_INT);
        // $registro_por_pagina = 10;
        // $total_registros = Evento::total();

        // $paginacion = new Paginacion($pagina_actual, $registro_por_pagina , $total_registros);

        // if ($paginacion->total_paginas() < $pagina_actual) {
        //     header("Location: /admin/eventos?page=1");
        // }

        $eventos = Evento::ordernar('Id','DESC');
        foreach($eventos as $evento){
            $evento->Categoria = Categoria::find($evento->Categoria_id);//del modelo para modificarlo
            $evento->Dia = Dia::find($evento->Dia_id);//del modelo para modificarlo
            $evento->Hora = Hora::find($evento->Hora_id);//del modelo para modificarlo
            $evento->Ponente = Ponente::find($evento->Ponente_id);//del modelo para modificarlo
        }
        
        //debuguear($eventos);

        $router->render("admin/eventos/index",[
            "titulo" => "Conferencias y Workshops",
            "eventos" => $eventos,
            //"paginacion" => $paginacion->paginacion()
        ]);
    }
    public static function crear (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        $alertas = [];
        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();
        $evento = new Evento();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header("Location: /admin/eventos");
                }
            }
        }
        //debuguear($evento);
        $router->render("admin/eventos/crear",[
            "titulo" => "Registrar Eventos",
            "alertas" => $alertas,
            "categorias" => $categorias,
            "dias"=> $dias,
            "horas"=>$horas,
            "evento"=>$evento
        ]);
    }
    public static function editar (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }

        $alertas = [];
        $Id = $_GET['Id'];
        validarRedireccionar("/admin/eventos");
        $evento = Evento::find($Id);
        $evento->Ponente = Ponente::find($evento->Ponente_id);
        ExisteDato($evento,"/admin/eventos");

        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header("Location: /admin/eventos");
                }
            }
        }

        $router->render("admin/eventos/editar",[
            "titulo" => "Editar Evento",
            "alertas" => $alertas,
            "evento" => $evento,
            "categorias" => $categorias,
            "dias" => $dias,
            "horas" => $horas
        ]);
    }
    public static function eliminar (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Id = $_POST['Id'];
            $evento = Evento::find($Id);
            $evento->eliminar();
            header("Location: /admin/eventos");
        }
    }
}

?>