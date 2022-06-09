<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET,POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Conecta a la base de datos  con usuario, contraseña y nombre de la BD
    $servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "manchesterpitifc";
    $conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);



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

?>