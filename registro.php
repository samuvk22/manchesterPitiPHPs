<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "manchesterpitifc";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);




if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $usuario=$data->usuario;
    $contraseña=$data->contraseña;
    
    
        if(($usuario!="")&&($contraseña!="")){
            
    $sqlUsuarios = mysqli_query($conexionBD,"INSERT INTO usuario(USUARIO,CONTRASEÑA,ROL) VALUES('$usuario','$contraseña','usuario') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}




?>