<?php
define('CARPETA_SPEAKERS', $_SERVER['DOCUMENT_ROOT'] . '/img/speakers/'); 


function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function esUltimo (string $actual, string $proximo): bool{

    if ($actual !== $proximo) {
        return true;
    }else{
        return false;
    }
}

function is_Auth() : bool{
    return isset($_SESSION['Nombre']) && !empty($_SESSION);
}
function is_Admin() : bool{
    return isset($_SESSION['Admin']) && !empty($_SESSION['Admin']);
}

function validarRedireccionar($URL)
{
    //validar la URL po ID valido
    $Id = $_GET['Id'];
    $Id = filter_var($Id, FILTER_VALIDATE_INT);

    if (!$Id) {
        header("Location: $URL");
    }

    return $Id;
}

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function pagina_Actual($path = '') {
    // Verifica si $_SERVER['PATH_INFO'] está definido y no es null
    $currentPath = $_SERVER['PATH_INFO'] ?? '';
    
    // Si $currentPath no es una cadena vacía, verifica si contiene $path
    if ($currentPath !== '') {
        return str_contains($currentPath, $path);
    }
    
    // Si $currentPath es una cadena vacía, simplemente retorna false
    return false;
}


function ExisteDato($Id , $URL){//verificar si existe del $_GET['Id']
    if (!$Id) {
        header("Location: $URL");
    }
}

function aos_animation(){
    $efectos = ["fade-up", "fade-down", "fade-right", "fade-left", "flip-left", "flip-right", "zoom-in", "zoom-in-up"];
    $indice_aleatorio = array_rand($efectos); // Obtiene un índice aleatorio del array $efectos
    $efecto = $efectos[$indice_aleatorio]; // Selecciona el efecto correspondiente al índice aleatorio
    echo ' data-aos="' . $efecto . '" ';
}
