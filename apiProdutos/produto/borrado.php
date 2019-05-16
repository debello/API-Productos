<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'basedatos.php';
    include 'obxectos/produto.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $produto = new Produto($conn);
    $data->id = $_GET['id'];

    if (empty($data->id)) {   
        http_response_code(400);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);

    }
    else {
        $produto->id = $data->id;
        $stmt = $produto->borrar();
        var_dump($data);
        
        if ($stmt) {
            http_response_code(201);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
        }
        else {
            http_response_code(503);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
        }
    }

?>

