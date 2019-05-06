<?php

// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/produto.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$produto = new Produto($conn);

$data = json_decode(file_get_contents('php://input'));

// Crear
//curl -v -X POST -d "{\"nome\":\"Almofada\",\"descricion\":\"A mellor almofada para deportistas\",\"prezo\":\"199\"}" "http://localhost:8080/servizoweb/apiprodutos/produto/creacion.php"

// En forma de Objeto
if (empty($data->nome) || empty($data->descricion) || empty($data->prezo)) {
        
    http_response_code(404);
    echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
}
else {

    $produto->nome = $data->nome;
    $produto->descricion = $data->descricion;
    $produto->prezo = $data->prezo;
    $stmt = $produto->crear();
    var_dump($data);
    
    if ($stmt){
        http_response_code(200);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);    
    }
    else {
        http_response_code(404);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);    
    }
}

?>