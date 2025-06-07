<?php

//variables de entorno

define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? 'root');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'powermode_db');

// Función de conexión con BD
function conectarDB() : mysqli {
    //    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$db){
        echo "Error: No se pudo conectar a la base de datos";
        exit;
    }

    // Asegurar que la conexión use UTF-8
    if(!$db->set_charset("utf8mb4")){
        echo "Error: No se pudo establecer el charset UTF-8";
        exit;
    }

    return $db;
}
