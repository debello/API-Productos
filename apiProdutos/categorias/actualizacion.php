<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/categoria.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$categoria = new categoria($conn);

// Ejemplo que debería funcionar
// curl -v -X PUT -d "{\"nome\":\"Almofada extra\",\"descricion\":\"A mellor almofada do mercado\",\"prezo\":150,\"idCategoria\":2,\"id\":61}" "http://localhost:8080/servizoweb/apiprodutos/categorias/actualizacion.php"
// [!!!] Especificar una ID que ya exista

$data = json_decode(file_get_contents('php://input'));

if (empty($data->id) || empty($data->nome) || 
    empty($data->descricion)) {
        
    http_response_code(503);
    echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);

}
else {

    $categoria->id = $data->id;
    $categoria->nome = $data->nome;
    $categoria->descricion = $data->descricion;

    
    $stmt = $categoria->actualizar();
    var_dump($data);
    
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

