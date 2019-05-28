<?php
// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// incluir os ficheiros de base de datos e de obxecto
include_once './baseDatos.php';
include_once './premio.php';
 
// instanciar a base de datos e o obxecto premio
$baseDatos = new BaseDatos();
$db = $baseDatos->getConexion();
 
// inicializar o obxecto produto
$premio = new Premio($db);
 
// consulta de premios
$stmt = $premio->contarPremiosActriz();
$num = $stmt->num_rows;

// comprobar se hai máis de 0 rexistros devoltos
if($num>0){
    // array de produtos
    $premios_arr=array();
    $premios_arr["rexistros"]=array();
	while ($item=$stmt->fetch_assoc()){
		//echo "nome produto:".$item["nome"];
		$item_premio=array(
            "idActriz" => $item["idActriz"],
            "nomeActriz" => $item["nomeActriz"],
            "cantOscar" => $item["numOscar"]
        );
		array_push($premios_arr["rexistros"],$item_premio);
	}
    // indicar o código de resposta - 200 OK
    http_response_code(200);
    // mostrar os produtos no formato json
    echo json_encode($premios_arr,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
else{
    // poñer o código de resposta a - 404 Not found
    http_response_code(404);
    // informar ao usuario de que non se atoparon premios
    echo json_encode(
        array("mensaxe" => "Non se atoparon premios.")
    );
}
?> 