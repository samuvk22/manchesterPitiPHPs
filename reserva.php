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
        
        $sqlCampos = mysqli_query($conexionBD,"SELECT * from reserva, campo, usuario where reserva.ID_CAMPO = campo.ID_CAMPO and reserva.USUARIO = usuario.USUARIO and usuario.USUARIO ='".$_GET["obtener"]."'");
        //$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM campo WHERE ID_CAMPO=1");
        if(mysqli_num_rows($sqlCampos) > 0){
            $campos = mysqli_fetch_all($sqlCampos,MYSQLI_ASSOC);
            echo json_encode($campos);
            exit();
        }
        else{  echo json_encode(["success"=>0]); }
    }

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

    if(isset($_GET["reservar"])){
        $data = json_decode(file_get_contents("php://input"));
        $idcampo=$data->idcampo;
        $fecha=$data->fecha;
        $hora=$data->hora;
        $usuario=$data->usuario;

        $horayfecha = $fecha ." " .$hora;
        
            if(($idcampo!="")&&($usuario!="")&&($fecha!="")&&($hora!="")){
                
        $sqlReservas = mysqli_query($conexionBD,"INSERT INTO reserva (`ID_CAMPO`, `USUARIO`, `HORA`) VALUES ('$idcampo', '$usuario', '$horayfecha')");
        echo json_encode(["success"=>1]);
            }
        exit();
    }

    if (isset($_GET["borrar"])){
        $sqlCampos = mysqli_query($conexionBD,"DELETE FROM reserva WHERE ID_RESERVA=".$_GET["borrar"]);
        if($sqlCampos){
            echo json_encode(["success"=>1]);
            exit();
        }
        else{  echo json_encode(["success"=>0]); }
    } 


    $sqlReservas = mysqli_query($conexionBD,"SELECT * FROM reserva ");
    if(mysqli_num_rows($sqlReservas) > 0){
        $reservas = mysqli_fetch_all($sqlReservas,MYSQLI_ASSOC);
        echo json_encode($reservas);
    }
    else{ echo json_encode([["success"=>0]]); }

?>