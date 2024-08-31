<?php 
namespace Controllers;

use Clases\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesControllers{

    public static function index (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        //del curso 
        // $pagina_actual = $_GET['page'];
        // if (!$pagina_actual || $pagina_actual < 1) {
        //     header("Location: /admin/ponentes?page=1");
        // }
        // $pagina_actual = filter_var($pagina_actual , FILTER_VALIDATE_INT);
        // $registro_por_pagina = 8;
        // $total_registros = Ponente::total();

        // $paginacion = new Paginacion($pagina_actual, $registro_por_pagina , $total_registros);

        // if ($paginacion->total_paginas() < $pagina_actual) {
        //     header("Location: /admin/ponentes?page=1");
        // }

        // $ponentes = Ponente::paginar($registro_por_pagina , $paginacion->offset()); //solo descomentar para usar paginacion del curso y no datatables

        //del curso
        $ponentes = Ponente::all(); //comentar si se usa en el curso pero no en el datatables
        $router->render("admin/ponentes/index",[
            "titulo" => "Ponenetes / Conferencistas",
            "ponentes" => $ponentes,
            //"paginacion" => $paginacion->paginacion() //solo descomentar para usar paginacion del curso y no datatables
        ]);
    }
    
    public static function crear (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        $alertas = [];
        $ponente = new Ponente();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ponente->sincronizar($_POST);

            if (!empty($_FILES['Imagen']['tmp_name'])) {
                //Crear la carpeta si no existe
                if(!is_dir(CARPETA_SPEAKERS)){
                    mkdir(CARPETA_SPEAKERS, 0777, true); //0777
                }
                $imagenPNG = Image::make($_FILES['Imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagenWEBP = Image::make($_FILES['Imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombreImagen = md5(uniqid(rand(), true));
                $ponente->SetFiles($nombreImagen);
            }
            $ponente->StringRedes();
            $alertas=$ponente->validar();

            if(empty($alertas)){
                $imagenPNG->save(CARPETA_SPEAKERS.'/'.$nombreImagen.'.png');
                $imagenWEBP->save(CARPETA_SPEAKERS.'/'.$nombreImagen.'.webp');
                //Guardamos en la base de datos
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header("Location: /admin/ponentes");
                }
            }

        }
        $redes = json_decode($ponente->Redes);
        

        $router->render("admin/ponentes/crear",[
            "titulo" => "Registrar Ponente",
            "alertas" => $alertas,
            "ponente" => $ponente,
            "redes" => $redes
        ]);
    }

    public static function editar (Router $router){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        $alertas = [];
        $Id = $_GET['Id'];
        validarRedireccionar("/admin/ponentes");
        $ponente = Ponente::find($Id);
        ExisteDato($ponente,"/admin/ponentes");

        $redes = json_decode($ponente->Redes);
        $imagen_actual = $ponente->Imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['Imagen']['tmp_name'])) {
                //Crear la carpeta si no existe
                if(!is_dir(CARPETA_SPEAKERS)){
                    mkdir(CARPETA_SPEAKERS, 0777, true); //0777
                }

                $imagenPNG = Image::make($_FILES['Imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagenWEBP = Image::make($_FILES['Imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombreImagen = md5(uniqid(rand(), true));
                $ponente->SetFiles($nombreImagen);
            }else{
                $ponente->Imagen = $imagen_actual;
            }
            
            $ponente->sincronizar($_POST);
            $ponente->StringRedes();
            
            $alertas = $ponente->validar();

            if (empty($alertas)) {
                if (isset($nombreImagen)) {
                    $imagenPNG->save(CARPETA_SPEAKERS.$nombreImagen.'.png');
                    $imagenWEBP->save(CARPETA_SPEAKERS.$nombreImagen.'.webp');
                }
                $resultado = $ponente->guardar();
                
                if ($resultado) {
                    header("Location: /admin/ponentes");
                }
            }
        }

        $router->render("admin/ponentes/editar",[
            "titulo" => "Actualizar Ponente",
            "alertas" => $alertas,  
            "ponente" => $ponente,
            "redes" => $redes,
            "imagen_actual" => $imagen_actual
        ]);
    }

    public static function eliminar(){
        $log = is_Admin();
        if(!$log){
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ponente = Ponente::find($_POST['Id']);
            ExisteDato($ponente,"/admin/ponentes");
            $ponente->BorrarImagen();
            $ponente->eliminar();
            header("Location: /admin/ponentes");
        }
    }
}

?>