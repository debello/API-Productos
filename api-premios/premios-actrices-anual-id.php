<?php
// curl -v "http://localhost:8080/api-premios/anoID/2";
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
echo "Santiago Vázquez Bello \nAlumno 57 \n";
$premio->idOscar = $_GET['idOscar'];

// Se o número é par 
 if ($premio->idOscar % 2 === 0) {
    http_response_code(403);
    echo json_encode(
        array("mensaxe" => "Num par. Non é posible consultar o dato indicado"), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $baseDatos->conn->close();
    die();

 }
$stmt = $premio->premiosActricesAnualId();
$num = $stmt->num_rows;

if($num>0){
    // array de produtos
    $premios_arr=array();
    $premios_arr["rexistros"]=array();
	while ($item=$stmt->fetch_assoc()){
		//echo "nome produto:".$item["nome"];
		$item_premio=array(
            "idOscar" => $item["idOscar"],
            "ano" => $item["ano"],
            "pelicula" => $item["pelicula"],
            "idActriz" => $item["idActriz"],
            "nomeActriz" => $item["nomeActriz"],
            "idadeActriz" => $item["idadeActriz"]
        );
		array_push($premios_arr["rexistros"],$item_premio);
	}
    // indicar o código de resposta - 200 OK
    http_response_code(200);
    // mostrar os produtos no formato json
    echo json_encode($premios_arr,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
else{

    http_response_code(500);
    // informar ao usuario de que non se atoparon premios
    echo json_encode(
        array("mensaxe" => "Houbo un problema no servidor ao consultar os datos solicitados.")
    );
}


?>