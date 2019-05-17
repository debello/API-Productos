<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include '../basedatos.php';
    include '../obxectos/categoria.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $categoria = new categoria($conn);

    $data = json_decode(file_get_contents('php://input'));

    if (empty($data->id)) {
            http_response_code(400);
            echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);

    }
    else {
        $categoria->id = $data->id;
        $stmt = $categoria->borrar();
        var_dump($data);
        
        if ($stmt) {
            http_response_code(200);
            echo "Borrado. ";
            echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
        }
        else {
            http_response_code(503);
            echo json_encode(array("message" => "Non se puido borrar a categoría. A ID seleccionada non existe."), JSON_UNESCAPED_UNICODE);
        }
    }

?>

