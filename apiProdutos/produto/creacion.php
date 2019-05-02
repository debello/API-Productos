<?php

// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/produto.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
// inicializar o obxecto produto
$produto = new Produto($conn);

$data = json_decode(file_get_contents('php://input'));

// En forma de Objeto
if (!empty($data->nome) && !empty($data->descricion) && !empty($data->prezo)) {

    $produto->nome = $data->nome;
    $produto->descricion = $data->descricion;
    $produto->prezo = $data->prezo;
}
else {
    http_response_code(503);
    echo json_encode(["mensaje" => "Datos insuficientes."]);
}

$stmt = $produto->crear();

if ($stmt){
     http_response_code(201);
     echo json_encode(["mensaje" => "Datos insertados con exito"]);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Non se atoparon produtos.")
    );
}

?>