<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/categoria.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$categoria = new categoria($conn);

// Ejemplo que debería funcionar
// curl -v "http://localhost:8080/servizoweb/apiprodutos/categorias/lectura1.php?id=2"
$categoria->id = isset($_GET['id']) ? $_GET['id'] : die();
$stmt = $categoria->ler1();
$num = $stmt->num_rows;

if($num>0){
    $categorias_arr = array();
    $categorias_arr["records"] = array();

    while ($item=$stmt->fetch_assoc()){
        $item_categoria=array(
            "id" => $item["id"],
            "nome" => utf8_decode($item["nome"]),
            "descricion" => utf8_decode($item["descricion"]),
            "prezo" => $item["prezo"],
            // "idCategoria" => $item["idCategoria"],
            // "nomeCategoria" => utf8_decode($item["nomeCategoria"])
        );
        array_push($categorias_arr["records"],$item_categoria);
    }
    // 200 OK
    http_response_code(200);
    echo json_encode($categorias_arr,JSON_PRETTY_PRINT);
}
else{
  // 404 Not found
  http_response_code(404);
  echo json_encode(
      array("message" => "Non se atoparon categorias.")
  );
}

?>

