<?php


/* $contraseña = "";
$usuario = "root";
$nombre_base_de_datos = "manchesterpitifc";
try {
    return new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
} catch (Exception $e) {
    echo "Ocurrió algo con la base de datos: " . $e->getMessage(); */


    global $enlace;


    function conexion(){


        $enlace = mysqli_connect('localhost','root','','manchesterpitifc');


        if(!$enlace){

            echo "ERROR!! No se puede conectar MySQL" . PHP_EOL;
            echo "ERROR de depuracion:" . mysqli_connect_errno(). PHP_EOL;
            echo "ERROR de depuracion:" . mysqli_connect_error(). PHP_EOL;

            exit;
        }

        return $enlace;
    }


?>