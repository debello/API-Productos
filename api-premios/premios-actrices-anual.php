<?php

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
$stmt = $premio->premiosActricesAnual();
$num = $stmt->num_rows;

if($num>0){
    // array de produtos
    $premios_arr=array();
    $premios_arr["rexistros"]=array();
	while ($item=$stmt->fetch_assoc()){
        //echo "nome produto:".$item["nome"];
        // Calcular colectivo idade
        //var_dump((int)$item["idadeActriz"]);
        $intColectivo = (int)$item["idadeActriz"];
        if ($intColectivo < 20) {
            $Colectivo = 'menor de 20 anos';
        }
        else if ($intColectivo > 20 && $intColectivo <= 29 ) {
            $Colectivo =  "na vintena";
        }
        else if ($intColectivo >= 30 && $intColectivo <= 39){
            $Colectivo =  "na trintena";
        }
        else if ($intColectivo > 40) {
          $Colectivo =  "corenta ou mais anos";  
        }

        if ($item["idOscar"] && $item["ano"] && $item["pelicula"] && $item["idActriz"] && $item["nomeActriz"] && $item["idadeActriz"]){

		$item_premio=array(
            "idOscar" => $item["idOscar"],
            "ano" => $item["ano"],
            "pelicula" => $item["pelicula"],
            "idActriz" => $item["idActriz"],
            "nomeActriz" => $item["nomeActriz"],
            "idadeActriz" => $item["idadeActriz"],
            "Colectivo" => $Colectivo
        );
        array_push($premios_arr["rexistros"],$item_premio);
        }
        else {
            http_response_code(500);
            // informar ao usuario de que non se atoparon premios
            echo json_encode(
                array("mensaxe" => "se produciu un
                problema no servidor ao consultar os datos.", JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)
            );
        }

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