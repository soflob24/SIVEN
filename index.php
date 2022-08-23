<?php
//Configuración de los controladores, métodos y parámetros
require_once 'Config/Config.php';
// Se almacena en la variable lo que se le pase por la URL
$ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
// Pasar la variable ruta a un arreglo
$array = explode("/", $ruta);
$controller = $array[0]; // Indice 0
$metodo = "index"; // Indice 1
$parametro = ""; // Indice 2
// Verificar si existe el método
if (!empty($array[1])) {  
    if (!empty($array[1] != "")) {
        $metodo = $array[1];
    }
}
// Verificar si existe el parámetro
if (!empty($array[2])) { 
    if (!empty($array[2] != "")) {
        for ($i = 2; $i < count($array); $i++) { 
            $parametro .= $array[$i] . ","; 
        }
        $parametro = trim($parametro, ",");
    }
}
require_once 'Config/App/autoload.php';
// validaciones para indicarle a la ruta donde se encuentran los controladores, luego hacer la instancia de la clase.
$dirControllers = "Controllers/" . $controller . ".php";
if (file_exists($dirControllers)) {
    require_once $dirControllers;
    $controller = new $controller();
    if (method_exists($controller, $metodo)) { 
        $controller->$metodo($parametro);
    } else {
        header('Location: '.base_url.'Errors');
    }
} else {
    header('Location: '.base_url.'Errors');
}
?>

