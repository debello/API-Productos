<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/produto.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$produto = new Produto($conn);

// Ejemplo que debería funcionar
// curl -v -X PUT -d "{\"nome\":\"Almofada extra\",\"descricion\":\"A mellor almofada do mercado\",\"prezo\":150,\"idCategoria\":2,\"id\":61}" "http://localhost:8080/servizoweb/apiprodutos/produto/actualizacion.php"
// [!!!] Especificar una ID que ya exista

$data = json_decode(file_get_contents('php://input'));

if (empty($data->id) || empty($data->nome) || 
    empty($data->descricion) || empty($data->prezo) || 
    empty($data->idCategoria)) {
        
        http_response_code(503);
        echo json_encode(["mensaje" => "Datos insuficientes."]);

}
else {

    $produto->id = $data->id;
    $produto->nome = $data->nome;
    $produto->descricion = $data->descricion;
    $produto->prezo = $data->prezo;
    $produto->idCategoria = $data->idCategoria;
    
    $stmt = $produto->actualizar();
    var_dump($data);
    
    if ($stmt) {
        http_response_code(200);
        echo "Producto Actualizado con exito.";
    }
    else {
        http_response_code(404);
        echo "Error. Producto no encontrado.";
    }
}

?>

