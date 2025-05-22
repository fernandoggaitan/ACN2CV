<?php

try{
    $conexion = new PDO(
        'mysql:host=localhost;dbname=acn2cv',
        'root',
        ''
    );
}catch(PDOException $e){
    //echo 'No se pudo conectar a la base de datos, porque: ' . $e->getMessage();
    //Redireccionar a una página de error.
    exit;
}

?>