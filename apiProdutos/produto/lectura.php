<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../basedatos.php';
include '../obxectos/produto.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$produto = new Produto($conn);

// Ejemplo
// curl -v "http://localhost:8080/servizoweb/apiprodutos/produto/lectura.php"
$stmt = $produto->ler();
$num = $stmt->num_rows;

if($num>0) {
    // array de produtos
    $produtos_arr = array();
    $produtos_arr["records"] = array();
    while ($item=$stmt->fetch_assoc()) {
        //echo "nome produto:".$item["nome"];
        $item_produto=array(
            "id" => $item["id"],
            "nome" => utf8_decode($item["nome"]),
            "descricion" => utf8_decode($item["descricion"]),
            "prezo" => $item["prezo"],
            "idCategoria" => $item["idCategoria"],
            "nomeCategoria" => utf8_decode($item["nomeCategoria"])
        );
        array_push($produtos_arr["records"],$item_produto);
    }
    http_response_code(200);
    echo json_encode($produtos_arr,JSON_PRETTY_PRINT);
}
else {
  http_response_code(404);
  echo json_encode(
      array("message" => "Non se atoparon produtos.")
  );
}

?>

