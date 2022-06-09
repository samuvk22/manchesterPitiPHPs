<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "manchesterpitifc";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $correo=$data->correo;
    $posicion=$data->posicion;


    $para      = 'gilsamuel685@gmail.com';
    $asunto    = 'El asunto del correo';
    $descripcion   = 'Este es el cuerpo del correo';
    $de = 'gilsamuel685@gmail.com';

    mail($para, $asunto, $descripcion, $de);
    


    echo json_encode(["success"=>1]);

    exit();
        // El mensaje




?>