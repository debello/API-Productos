<?php
// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/categoria.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$categoria = new categoria($conn);

// Ejemplo que debería funcionar
// curl -v -X POST -d "{\"id\":68}"  "http://localhost:8080/servizoweb/apiprodutos/categorias/borrado.php"
$data = json_decode(file_get_contents('php://input'));

if (empty($data->id)) {
        
        http_response_code(503);
        echo json_encode(["mensaje" => "Datos insuficientes."]);

}
else {

    $categoria->id = $data->id;
    $stmt = $categoria->borrar();
    var_dump($data);
    
    if ($stmt) {
        http_response_code(200);
        echo "Producto Borrado con exito.";
    }
    else {
        http_response_code(404);
        echo "Error. Producto no encontrado.";
    }
}





?>

