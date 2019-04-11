<?php
// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../basedatos.php';
include '../obxectos/produto.php';

$conexion = new BaseDatos;
$conn = $conexion->getConexion();
$produto = new Produto($conn);

// Ejemplo que debería funcionar
// curl -v "http://localhost:8080/servizoweb/apiprodutos/produto/lectura1.php?id=2"

//$data = file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'));
//$data2 = explode("?", $data);
var_dump($data); // Null o string vacío
//var_dump($data2);
//print_r($data);
//$produto->id = $data['id'];
$stmt = $produto->ler1();
// $num = $stmt->num_rows;

// // comprobar se hai máis de 0 rexistros devoltos
// if($num>0){
//     // array de produtos
//     $produtos_arr = array();
//     $produtos_arr["records"] = array();
//     while ($item=$stmt->fetch_assoc()){
//         //echo "nome produto:".$item["nome"];
//         $item_produto=array(
//             "id" => $item["id"],
//             "nome" => utf8_decode($item["nome"]),
//             "descricion" => utf8_decode($item["descricion"]),
//             "prezo" => $item["prezo"],
//             "idCategoria" => $item["idCategoria"],
//             "nomeCategoria" => utf8_decode($item["nomeCategoria"])
//         );
//         array_push($produtos_arr["records"],$item_produto);
//     }
//     // indicar o código de resposta - 200 OK
//     http_response_code(200);
//     // mostrar os produtos no formato json
//     echo json_encode($produtos_arr,JSON_PRETTY_PRINT);
// }
// else{
//   // poñer o código de resposta a - 404 Not found
//   http_response_code(404);
//   // informar ao usuario de que non se atoparon produtos
//   echo json_encode(
//       array("message" => "Non se atoparon produtos.")
//   );
// }


// [O] Funciona en CURL - lectura.php
// curl -v "http://localhost:8080/servizoweb/apiprodutos/produto/lectura.php"










  /*
 
  ["taboa":"Produto":private]=>
  string(8) "produtos"
  ["id"]=>
  NULL
  ["nome"]=>
  NULL
  ["descricion"]=>
  NULL
  ["prezo"]=>
  NULL
  ["idCategoria"]=>
  NULL
  ["nomeCategoria"]=>
  NULL
  ["creado"]=>
  NULL
  
  */ 

?>

