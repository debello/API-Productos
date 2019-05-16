<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'basedatos.php';
    include 'obxectos/produto.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $produto = new Produto($conn);

    $data = json_decode(file_get_contents('php://input'));
    

    if (empty($data->nome) || empty($data->descricion) || empty($data->prezo)) { 
        http_response_code(400);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
    }
    else {
        
        $produto->nome = $data->nome;
        $produto->descricion = $data->descricion;
        $produto->prezo = $data->prezo;
        $produto->idCategoria = $data->idCategoria;
        $produto->creado = date('Y-m-d H:i:s');
        $produto->modificado = date("Y-m-d H:i:s");
        // $produto->creado = $data->creado;
        // $produto->modificado = $data->modificado;
        $stmt = $produto->crear();
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