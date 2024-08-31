<?php 
namespace Controllers;

use Model\Dia;
use Model\Evento;
use Model\Ponente;
use Model\EventoHorario;
use Model\Regalos;
use Model\Registro;
use Model\Usuario;

class ApiControllers {
    public static function horarios(){
        $dia_id = $_GET['dia_id'];
        $categoria_id = $_GET['categoria_id'];

        $dia_id = filter_var($dia_id, FILTER_VALIDATE_INT);
        $categoria_id = filter_var($categoria_id, FILTER_VALIDATE_INT);
        if (!$dia_id || !$categoria_id) {
            $array = [
                "mensaje"=> "hubo un error"
            ];
            echo json_encode($array);
            return;
        }
        
        $eventos = EventoHorario::whereArray(["Dia_id"=>$dia_id,"Categoria_id"=>$categoria_id]) ?? ["mensaje"=>"nada"];
        echo json_encode([$eventos]);

    }

    public static function ponentes(){
        $ponentes = Ponente::all();
        //debuguear($ponentes);
        echo json_encode($ponentes);
    }

    public static function ponente(){
        $Id = $_GET['Id'];
        $Id = filter_var($Id, FILTER_VALIDATE_INT);

        if (!$Id || $Id < 0 ) {
            echo json_encode(["msj" => "no hay nd mrd"]);
            return;
        }

        $ponente = Ponente::find($Id);
        echo json_encode($ponente , JSON_UNESCAPED_SLASHES);
    }

    public static function RegalosData(){
        
        $regalos = Regalos::all('Id', 'ASC');
        $array_nombres = [];
        $array_cantidad = [];
        foreach($regalos as $regalo){
            $array_nombres[] = $regalo->Nombre;
            $registro_cantidad = Registro::total('Regalos_id' , $regalo->Id);
            $array_cantidad[] = $registro_cantidad;
        }

        echo json_encode([
            "Nombres" => $array_nombres,
            "Data" => $array_cantidad
        ]);
    }

}
?>