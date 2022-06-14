<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "manchesterpitifc";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlCampos = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=".$_GET["consultar"]);
    //$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=1");
    if(mysqli_num_rows($sqlCampos) > 0){
        $campos = mysqli_fetch_all($sqlCampos,MYSQLI_ASSOC);
        echo json_encode($campos);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
 if (isset($_GET["borrar"])){
    $sqlCampos = mysqli_query($conexionBD,"DELETE FROM campo WHERE ID_CAMPO=".$_GET["borrar"]);
    if($sqlCampos){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
} 
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $direccion=$data->direccion;
    $tipo=$data->tipo;
    $imagen=$data->imagen;
    $imagen = substr($imagen,11);
    $imagen = "./assets/" . $imagen;
    
    
        if(($direccion!="")&&($nombre!="")&&($tipo!="")){
            
    $sqlCampos = mysqli_query($conexionBD,"INSERT INTO campo(NOMBRE,DIRECCION,TIPO,imagen) VALUES('$nombre','$direccion','$tipo','$imagen') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $direccion=$data->direccion;
    $tipo=$data->tipo;
    
    $sqlCampos = mysqli_query($conexionBD,"UPDATE campo SET NOMBRE='$nombre',DIRECCION='$direccion',TIPO='$tipo' WHERE ID_CAMPO='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlCampos = mysqli_query($conexionBD,"SELECT * FROM campo ");
if(mysqli_num_rows($sqlCampos) > 0){
    $campos = mysqli_fetch_all($sqlCampos,MYSQLI_ASSOC);
    echo json_encode($campos);
}
else{ echo json_encode([["success"=>0]]); }


?>