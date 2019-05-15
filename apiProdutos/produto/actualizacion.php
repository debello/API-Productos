<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include 'basedatos.php';
    include 'obxectos/produto.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $produto = new Produto($conn);

    $dataJSON = json_decode(file_get_contents('php://input'));
    $dataid = $_GET['id'];
    var_dump($dataid);

    if (empty($dataid) || empty($dataJSON->nome) || 
        empty($dataJSON->descricion) || empty($dataJSON->prezo) || 
        empty($dataJSON->idCategoria)) {
            http_response_code(503);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
    }
    else {
        $produto->id = $dataid;
        $produto->nome = $dataJSON->nome;
        $produto->descricion = $dataJSON->descricion;
        $produto->prezo = $dataJSON->prezo;
        $produto->idCategoria = $dataJSON->idCategoria;
        
        $stmt = $produto->actualizar();
        var_dump($dataJSON);
        
        if ($stmt) {
            http_response_code(200);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
        }
        else {
            http_response_code(404);
            echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
        }
    }

?>

