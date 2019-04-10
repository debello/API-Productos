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
$produto->nome = $data->nome;
$produto->descricion = $data->descricion;
$produto->prezo = $data->prezo;

$stmt = $produto->crear();
$num = $stmt->num_rows;


// comprobar se hai máis de 0 rexistros devoltos
 if($num>0){
//     // indicar o código de resposta - 200 OK
     http_response_code(200);
//     // mostrar os produtos no formato json
//     echo json_encode($produtos_arr,JSON_PRETTY_PRINT);
}
 else{
//   // poñer o código de resposta a - 404 Not found
   http_response_code(404);
//   // informar ao usuario de que non se atoparon produtos
//   echo json_encode(
//       array("message" => "Non se atoparon produtos.")
//   );
}

// [O] Funciona CURL
// curl -v -X POST -d "{\"nome\":\"Almofada\",\"descricion\":\"A mellor almofada para deportistas\",\"prezo\":\"199\"}" "http://localhost:8080/servizoweb/apiprodutos/produto/creacion.php"
?>