<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "manchesterpitifc";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);




if(isset($_GET['ultimaNoticia'])){

    $sqlUltimo = mysqli_query($conexionBD,"SELECT * FROM noticia order by ID_NOTICIA DESC LIMIT 1");
if(mysqli_num_rows($sqlUltimo) > 0){
    $ultimo = mysqli_fetch_all($sqlUltimo,MYSQLI_ASSOC);
    echo json_encode($ultimo);
}
else{ echo json_encode([["success"=>0]]); }

}

if(isset($_GET['ultimoCampo'])){

    $sqlUltimo = mysqli_query($conexionBD,"SELECT * FROM campo order by ID_CAMPO DESC LIMIT 1");
if(mysqli_num_rows($sqlUltimo) > 0){
    $ultimo = mysqli_fetch_all($sqlUltimo,MYSQLI_ASSOC);
    echo json_encode($ultimo);
}
else{ echo json_encode([["success"=>0]]); }

}




?>