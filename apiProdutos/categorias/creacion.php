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

// Crear
//curl -v -X POST -d "{\"nome\":\"Almofada\",\"descricion\":\"A mellor almofada para deportistas\",\"prezo\":\"199\"}" "http://localhost:8080/servizoweb/apiprodutos/categorias/creacion.php"

// En forma de Objeto

if (empty($data->nome) || empty($data->descricion)) {
        
    http_response_code(503);
    echo json_encode(["mensaje" => "Datos insuficientes."]);
}
else {

    $categoria->nome = $data->nome;
    $categoria->descricion = $data->descricion;
    $stmt = $categoria->crear();
    var_dump($data);
    
    if ($stmt){
        http_response_code(201);
        echo json_encode(["mensaje" => "Datos insertados con exito"]);
    }
    else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Non se atoparon categorias.")
        );
    }
}

?>