<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include '../basedatos.php';
    include '../obxectos/categoria.php';

    $conexion = new BaseDatos;
    $conn = $conexion->getConexion();
    $categoria = new categoria($conn);

    $categoria->id = isset($_GET['id']) ? $_GET['id'] : die();
    $stmt = $categoria->ler1();
    $num = $stmt->num_rows;

    if($num>0){
        $categorias_arr = array();
        $categorias_arr["records"] = array();

        while ($item=$stmt->fetch_assoc()){
            $item_categoria=array(
                "id" => $item["id"],
                "nome" => utf8_encode($item["nome"]),
                "descricion" => utf8_encode($item["descricion"]),
                "creada" => $item["creada"],
                "modificada" => $item["modificada"],
            );
            array_push($categorias_arr["records"],$item_categoria);
        }
        http_response_code(200);
        echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
        echo json_encode($categorias_arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    else{
    http_response_code(404);
    echo json_encode($err_messages[http_response_code()], JSON_UNESCAPED_UNICODE);
    }

?>

