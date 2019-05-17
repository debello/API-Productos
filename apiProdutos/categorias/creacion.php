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
        http_response_code(400);
        echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
    }
    else {
        $categoria->nome = $data->nome;
        $categoria->descricion = $data->descricion;
        $categoria->creado = date('Y-m-d H:i:s');
        $categoria->modificado = date("Y-m-d H:i:s");
        $stmt = $categoria->crear();

        if ($stmt){
            http_response_code(200);
            echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
        }
        else {
            http_response_code(503);
            echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
        }
    }

?>