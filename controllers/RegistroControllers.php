<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Regalos;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;

class RegistroControllers
{

    public static function crear(Router $router)
    {
        $log = is_Auth();
        if (!$log) {
            header("Location: /");
            return;
        }
        $registro = Registro::where('Usuario_id', $_SESSION['Id']);

        if (isset($registro) && $registro->Paquete_id === '3' || isset($registro) && $registro->Paquete_id === '2') {
            header("Location: /boleto?Id=" . urlencode($registro->Token));
            return;
        }

        if (isset($registro) && $registro->Paquete_id === '1'){
            header("Location: /finalizar-registro/conferencia");
            return;
        }

        $router->render("registro/crear", [
            "titulo" => "Finalizar Registro"
        ]);
    }

    public static function gratis(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $log = is_Auth();
            if (!$log) {
                header("Location: /login");
            }
            $registro = Registro::where('Usuario_id', $_SESSION['Id']);
            if (isset($registro) && $registro->Paquete_id === '3') {
                header("Location: /boleto?Id=" . urlencode($registro->Token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos = array(
                "Paquete_id" => 3,
                "Pago_id" => '',
                "Token" => $token,
                "Usuario_id" => $_SESSION['Id']
            );
            //creamos los datos ya que no lo estamos solicitando
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            if ($resultado) {
                header("Location: /boleto?Id=" . urlencode($registro->Token)); //para evitar caracteres especiales
                return;
            }
        }
    }

    public static function pagar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $log = is_Auth();
            if (!$log) {
                header("Location: /login");
                return;
            }

            //VALIDAR que POST no venga vacio
            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }
            //crear registro
            $datos = $_POST;
            $datos['Token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['Usuario_id'] = $_SESSION['Id'];
            //Debuguear
            // echo json_encode([
            //     "mensaje" => "el json",
            //     "post" => $datos,
            // ]);
            // exit;

            //creamos los datos ya que no lo estamos solicitando
            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            if ($resultado) {
                echo json_encode([
                    "mensaje" => "Pago Correcto",
                    "resultado" => $resultado,
                ]);
            }
        }
    }

    public static function boleto(Router $router)
    {
        $Id = $_GET['Id'];
        if (!$Id || strlen($Id) !== 8) {
            header("Location: /");
            return;
        }
        $registro = Registro::where('Token', $Id);
        if (is_null($registro)) {
            header("Location: /");
            return;
        }
        $registro->Usuario = Usuario::find($registro->Usuario_id);
        $registro->Paquete = Paquete::find($registro->Paquete_id);


        $router->render("registro/boleto", [
            "titulo" => "Asistencia a DevWebCamp",
            "registro" => $registro
        ]);
    }

    public static function conferencia(Router $router)
    {
        $log = is_Auth();
        if (!$log) {
            header("Location: /login");
            return;
        }

        // Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['Id'];
        $registro = Registro::where('Usuario_id', $usuario_id);

        if(isset($registro) && $registro->Paquete_id === "2") {
            header('Location: /boleto?Id=' . urlencode($registro->Token));
            return;
        } 

        // Aqui validas si el registro se ha completado o no
        $registroFinalizado = EventosRegistros::where('Registro_id', $registro->Id);

        // Aqui validas si el registro se ha completado o no
        if(isset($registroFinalizado)) {
            header('Location: /boleto?Id=' . urlencode($registro->Token));
            return;
        }
        //Aceptamos solo paquete presencial
        if($registro->Paquete_id !== "1") {
            header('Location: /');
            return;
        }

        $eventos_formateados = [ //en caso de que no tenga agendado en un dia para que este inicializado
            'conferencias_L' => [],
            'conferencias_M' => [],
            'conferencias_Mi' => [],
            'workshops_L' => [],
            'workshops_M' => [],
            'workshops_Mi' => [],
        ];

        $eventos = Evento::ordernar('Hora_id', 'ASC');

        foreach ($eventos as $evento) {
            $evento->Categoria = Categoria::find($evento->Categoria_id);
            $evento->Dia = Dia::find($evento->Dia_id);
            $evento->Hora = Hora::find($evento->Hora_id);
            $evento->Ponente = Ponente::find($evento->Ponente_id);

            if ($evento->Dia_id === '3' & $evento->Categoria_id === '3') {
                $eventos_formateados['conferencias_L'][] = $evento;
            }
            if ($evento->Dia_id === '4' & $evento->Categoria_id === '3') {
                $eventos_formateados['conferencias_M'][] = $evento;
            }
            if ($evento->Dia_id === '5' & $evento->Categoria_id === '3') {
                $eventos_formateados['conferencias_Mi'][] = $evento;
            }
            if ($evento->Dia_id === '3' & $evento->Categoria_id === '4') {
                $eventos_formateados['workshops_L'][] = $evento;
            }
            if ($evento->Dia_id === '4' & $evento->Categoria_id === '4') {
                $eventos_formateados['workshops_M'][] = $evento;
            }
            if ($evento->Dia_id === '5' & $evento->Categoria_id === '4') {
                $eventos_formateados['workshops_Mi'][] = $evento;
            }
        }

        //debuguear($eventos_formateados);
        $regalos = Regalos::all('Id', 'ASC');

        $router->render("registro/conferencias", [
            "titulo" => "Elige WorkShop o Conferencias",
            "eventos" => $eventos_formateados,
            "regalos" => $regalos
        ]);
    }

    public static function registro(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validacion de logeo
            $log = is_Auth();
            if (!$log) {
                header("Location: /login");
                return;
            }
            //conseguimos los datos de FormData Js
            $eventos = explode(',', $_POST['eventos']);
            $regaloId = $_POST['regalo_id'];
            //validamos el array
            if(empty($eventos)){
                echo json_encode([
                    "resultado" => false
                ]);
                return;
            }
            //validamos el registro
            $registro = Registro::where('Usuario_id', $_SESSION['Id']);

            if(!isset($registro) || $registro->Paquete_id !== "1"){
                echo json_encode([
                    "resultado" => false
                ]);
                return;
            }
            //verificamos si tenemos sitios disponibles si no cancelamos (disponibilidad)
            $eventos_array = [];

            foreach ($eventos as $evento_id){
                $evento = Evento::find($evento_id);

                if(!isset($evento)|| $evento->Disponibles === '0'){
                    echo json_encode([
                        "resultado" => false
                    ]);
                    return;
                }
                $eventos_array[] =  $evento;
            }
            // altermos la base de datos reduciendo 1 cupo por evento escogido
            foreach ($eventos_array as $evento){
                $evento->Disponibles -= 1;
                $evento->guardar();

                //Almacenar Registro
                $datos = [
                    'Evento_id' => $evento->Id,
                    'Registro_id' => $registro->Id
                ];
                
                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            //Guardamos el regalo
            $registro->sincronizar(['Regalos_id' => $regaloId]);
            $resultado = $registro->guardar();
            if($resultado){
                echo json_encode([
                    "resultado" => $resultado,
                    "token" => $registro->Token
                ]);
            }

        }
    }
}
