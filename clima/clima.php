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
echo $decoded->datos . "<br>"; // Direccion HTTP que buscamos
$secondURL = $decoded->datos;
curl_close($cliente);


$cliente2 = curl_init();
$url2="$secondURL";
// //establecer as opcións. Hai moitas opcións. Neste caso defínese a URL
curl_setopt($cliente2, CURLOPT_URL, $url2);
curl_setopt($cliente2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cliente2,CURLOPT_HTTPHEADER,array('Accept:application/json',
'Content-type:application/json'));
//executar con curl_exec()
$data = curl_exec($cliente2);

$dataDecoded = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data), true );
echo "Hoy: <br>";
echo $dataDecoded[0]["elaborado"] . "<br>";
echo $dataDecoded[0]["provincia"] . "<br>";
echo $dataDecoded[0]["prediccion"]["dia"][0]["temperatura"]["maxima"] . "<br>";
echo $dataDecoded[0]["prediccion"]["dia"][0]["temperatura"]["minima"] . "<br>";
//print_r($dataDecoded[0]["origen"]["productor"]);  // !! Agencia Estatal de Metereologia

curl_close($cliente2);

?>