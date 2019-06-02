<?php
// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// incluir os ficheiros de base de datos e de obxecto
//include_once './baseDatos.php';
include_once './premios-actrices.php';
 

echo "Santiago V \nAlumno 57 \n";
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
    //var_dump($premios_arr,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    
    echo "\nLa actriz con id 57 es: " . json_encode($premios_arr["rexistros"][56], true);
    echo "\nLa actriz con id 57 es " . json_encode($premios_arr["rexistros"][56]["nomeActriz"], true). "\nGanadora de ".json_encode($premios_arr["rexistros"][56]["cantOscar"]).' premios oscar';
    echo "\nAs actrices que teñen dous ou máis premios oscar son:\n";

    $cantidadeOscar = 0;
    for ($i = 0 ; $i < $num ; $i++){
        // var_dump(json_encode($premios_arr["rexistros"][0]["cantOscar"]));
        // echo json_encode($premios_arr["rexistros"][$i]["cantOscar"]);
        if (($premios_arr["rexistros"][$i]["cantOscar"]) > 1) {
            
            echo json_encode($premios_arr["rexistros"][$i]["nomeActriz"]) . "\n";
        }
        $cantidadeOscar += $premios_arr["rexistros"][$i]["cantOscar"];
    }
    //echo json_encode($premios_arr,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    echo "\nA cantidade de Oscar otorgados son: " .$cantidadeOscar; 
    echo "\nA media de Oscar otorgados son " .$cantidadeOscar / $num;
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