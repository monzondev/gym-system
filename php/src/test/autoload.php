<?php
/*
Este archivo se encarga de importar alguna clase del boundary
en dado caso no la ENCUENTRE en el test. Se cargaran las 
del boundary porque son las que se quieren PROBAR
*/
spl_autoload_register(function ($class_name) {
    $path = $_SERVER["DOCUMENT_ROOT"];
    include $path . 'boundary/' . $class_name . '.php';
});
?>