<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: ORIGIN, x-Requested-With,Content-Type, Accept");

$json = file_get_contents("php://input"); //Recibe el json de angular

$params = json_decode($json);

require("../bd.php");


$conexion = conexion();


mysqli_query($conexion,"INSERT INTO usuario (USUARIO,CONTRASEÑA,ROL)
            VALUES ("$params->usuario","$params->contraseña","$params->rol");");


class Result{}


$response = new Result();
$response -> resultado = "OK";
$response -> mensaje = "El usuario se ha registrado con exito";


header("Content-Type: application/json");


echo json_encode($response);



?>