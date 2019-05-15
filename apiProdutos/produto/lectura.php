<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include '../basedatos.php';
    include '../obxectos/produto.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $produto = new Produto($conn);

    $stmt = $produto->ler();
    $num = $stmt->num_rows;

    if($num>0) {
        // array de produtos
        $produtos_arr = array();
        $produtos_arr["records"] = array();
        while ($item=$stmt->fetch_assoc()) {
            $item_produto=array(
                "id" => $item["id"],
                "nome" => utf8_decode($item["nome"]),
                "descricion" => utf8_decode($item["descricion"]),
                "prezo" => $item["prezo"],
                "idCategoria" => $item["idCategoria"],
                "nomeCategoria" => utf8_decode($item["nomeCategoria"]),
                "creado" => $item["creado"],
                "modificado" => $item["modificado"]
                );
            array_push($produtos_arr["records"],$item_produto);
        }
        http_response_code(200);
        echo json_encode($produtos_arr,JSON_PRETTY_PRINT);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
    }

    else {
        http_response_code(404);
        echo json_encode($err_messages[http_response_code()], JSON_PRETTY_PRINT);
    }

?>

