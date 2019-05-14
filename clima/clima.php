<?php

$cliente = curl_init();
$url = "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/15030?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzaWV0ZW9jaG84N0Bob3RtYWlsLmNvbSIsImp0aSI6IjdkYzQ0NjM3LTlmZTMtNDgxNC1hNThhLTNiYTQ3MTU3NDkxMCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNTU3NzY3NTYxLCJ1c2VySWQiOiI3ZGM0NDYzNy05ZmUzLTQ4MTQtYTU4YS0zYmE0NzE1NzQ5MTAiLCJyb2xlIjoiIn0.2vhVyvr2t5sqmr1V-EQ2yNap-7F62-jv6HB0HrwCuUU";
// establece a url
curl_setopt($cliente, CURLOPT_URL, $url);
//establece a saída nun string
curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cliente,CURLOPT_HTTPHEADER,array('Accept:application/json',
'Content-type:application/json'));
$output = curl_exec($cliente);
//curl_close($cliente); // JSON
//echo $output; 
$decoded = json_decode($output); // Objeto
echo $decoded->datos; // Direccion HTTP que buscamos


$cliente = curl_init();
$url="$decoded->datos";
//establecer as opcións. Hai moitas opcións. Neste caso defínese a URL
curl_setopt($cliente, CURLOPT_URL, $url);
curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cliente,CURLOPT_HTTPHEADER,array('Accept:application/json',
'Content-type:application/json'));
//executar con curl_exec()
$data = curl_exec($cliente);

$dataDecoded = json_decode($data);
/**  Variables que queremos mostrar **/
var_dump($data);
//var_dump($dataDecoded);
curl_close($cliente);

?>