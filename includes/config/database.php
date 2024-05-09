<?php 
function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'wanderlust', 'bienesraices_crud2.0');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}