<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include '../basedatos.php';
    include '../obxectos/categoria.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $categoria = new Categoria($conn);

    $stmt = $categoria->ler();
    $num = $stmt->num_rows;

    if($num>0) {
        // array de categorias
        $categorias_arr = array();
        $categorias_arr["records"] = array();
        while ($item=$stmt->fetch_assoc()) {
            //echo "nome categoria:".$item["nome"];
            $item_categoria=array(
                "id" => $item["ID"],
                "nome" => utf8_encode($item["nome"]),
                "idCategoria" => $item["idCategoria"],
                "descricion" => utf8_encode($item["descricion"]),
                "creada" => $item["creada"],
                "modificada" => $item["modificada"],
            );
            array_push($categorias_arr["records"],$item_categoria);
        }
        http_response_code(200);
        echo json_encode($categorias_arr,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
    }
    else {
    http_response_code(404);
    echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
    }

?>

