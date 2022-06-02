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
    $sqlPlantilla = mysqli_query($conexionBD,"SELECT * FROM jugador WHERE ID_JUGADOR=".$_GET["consultar"]);
    //$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=1");
    if(mysqli_num_rows($sqlPlantilla) > 0){
        $plantilla = mysqli_fetch_all($sqlPlantilla,MYSQLI_ASSOC);
        echo json_encode($plantilla);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
 if (isset($_GET["borrar"])){
    $sqlPlantilla = mysqli_query($conexionBD,"DELETE FROM jugador WHERE ID_JUGADOR=".$_GET["borrar"]);
    if($sqlPlantilla){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
} 
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $numero=$data->numero;
    
        if(($nombre!="")&&($apellidos!="")&&($dorsal!="")){
            
    $sqlPlantilla = mysqli_query($conexionBD,"INSERT INTO plantilla(NOMBRE,APELLIDOS,NUMERO) VALUES('$nombre','$apellidos','$numero') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $numero=$data->numero;
    
    
    $sqlPlantilla = mysqli_query($conexionBD,"UPDATE plantilla SET NOMBRE='$titulo',APELLIDOS='$descripcion',NUMERO='$numero' WHERE ID_JUGADOR='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

if (isset($_GET["ultimo"])){
    $sqlPlantilla = mysqli_query($conexionBD,"SELECT * from plantilla order by ID_JUGADOR DESC"
    //$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=1");
    if(mysqli_num_rows($sqlPlantilla) > 0){
        $plantilla = mysqli_fetch_all($sqlPlantilla,MYSQLI_ASSOC);
        echo json_encode($plantilla);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
// Consulta todos los registros de la tabla empleados
$sqlPlantilla = mysqli_query($conexionBD,"SELECT * FROM plantilla order by ID_JUGADOR DESC");
if(mysqli_num_rows($sqlPlantilla) > 0){
    $plantilla = mysqli_fetch_all($sqlPlantilla,MYSQLI_ASSOC);
    echo json_encode($plantilla);
}
else{ echo json_encode([["success"=>0]]); }


?>