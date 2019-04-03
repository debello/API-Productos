<?php
// cabeceiras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../basedatos.php';
include '../obxectos/produto.php';

// instanciar a base de datos e o obxecto produto
// $baseDatos = new BaseDatos();
// $db = $baseDatos->getConexion();
$conexion = new BaseDatos;
$conn = $conexion->getConexion();

// inicializar o obxecto produto
$produto = new Produto($conn);

//print_r($produto);
var_dump($produto->ler());


/*
 
   }
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

