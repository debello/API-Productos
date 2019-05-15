<?php

    // cabeceiras necesarias
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include '../basedatos.php';
    include '../obxectos/categoria.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $categoria = new categoria($conn);

    $data = json_decode(file_get_contents('php://input'));

    if (empty($data->nome) || empty($data->descricion)) {
            
        http_response_code(503);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
    }
    else {
        $categoria->nome = $data->nome;
        $categoria->descricion = $data->descricion;
        $stmt = $categoria->crear();
        var_dump($data);
        
        if ($stmt){
            http_response_code(201);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
        }
        else {
            http_response_code(404);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
        }
    }

?>