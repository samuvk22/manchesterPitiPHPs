<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "manchesterpitifc";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);



if (isset($_GET["obtener"])){

    $sqlCampos = mysqli_query($conexionBD,"SELECT * from noticia where USUARIO='".$_GET["obtener"]."' ORDER BY ID_NOTICIA DESC");
    //$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=1");
    if(mysqli_num_rows($sqlCampos) > 0){
        $campos = mysqli_fetch_all($sqlCampos,MYSQLI_ASSOC);
        echo json_encode($campos);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlNoticias = mysqli_query($conexionBD,"SELECT * FROM noticia WHERE ID_NOTICIA=".$_GET["consultar"]);
    //$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=1");
    if(mysqli_num_rows($sqlNoticias) > 0){
        $noticias = mysqli_fetch_all($sqlNoticias,MYSQLI_ASSOC);
        echo json_encode($noticias);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
 if (isset($_GET["borrar"])){
    $sqlNoticias = mysqli_query($conexionBD,"DELETE FROM noticia WHERE ID_NOTICIA=".$_GET["borrar"]);
    if($sqlNoticias){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
} 
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $titulo=$data->titulo;
    $descripcion=$data->descripcion;
    $usuario=$data->usuario;
    $imagen=$data->imagen;
    $imagen = substr($imagen,11);
    $imagen = "./assets/" . $imagen;
    
        if(($titulo!="")&&($descripcion!="")&&($usuario!="")){
            
    $sqlNoticias = mysqli_query($conexionBD,"INSERT INTO noticia(TITULO,DESCRIPCION,USUARIO,imagen) VALUES('$titulo','$descripcion','$usuario','$imagen') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $titulo=$data->titulo;
    $descripcion=$data->descripcion;
    
    
    $sqlNoticias = mysqli_query($conexionBD,"UPDATE noticia SET TITULO='$titulo',DESCRIPCION='$descripcion' WHERE ID_NOTICIA='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

// Consulta todos los registros de la tabla empleados
$sqlNoticias = mysqli_query($conexionBD,"SELECT * FROM noticia order by ID_NOTICIA DESC");
if(mysqli_num_rows($sqlNoticias) > 0){
    $noticias = mysqli_fetch_all($sqlNoticias,MYSQLI_ASSOC);
    echo json_encode($noticias);
}
else{ echo json_encode([["success"=>0]]); }


?>