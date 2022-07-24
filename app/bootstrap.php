<?php

/**
 * Entrada al sistema
 *
 */

// Depurar errores en tiempo de ejecución

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carga automática de librerías cuando se llama la clase
// El nombre de la clase debe ser idéntico al nombre
// del archivo que la contiene para que funcione.

require_once 'config/config.php';

spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});

?>
