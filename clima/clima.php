<?php

// $cliente = curl_init();
// $url="https://www.php.net/manual/es/";
// //establecer as opcións. Hai moitas opcións. Neste caso defínese a URL
// curl_setopt($cliente, CURLOPT_URL, $url);
// //executar con curl_exec()
// $data = curl_exec($cliente);
// //pechar a sesión
// curl_close($cliente);

$cliente = curl_init();
$url = "https://www.cultura.gal/v1/axenda/eventos?idioma=gl";
// establece a url
curl_setopt($cliente, CURLOPT_URL, $url);
//establece a saída nun string
curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cliente,CURLOPT_HTTPHEADER,array('Accept:application/json',
'Content-type:application/json'));
$output = curl_exec($cliente);
curl_close($cliente);
echo $output; 

?>