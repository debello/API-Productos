<?php

$responseCode = [[200 => "Todo OK"],["404" => "Page not found"]];
foreach ($responseCode as $k => $v){
    if ($v === 200) {
        echo json_encode($responseCode[$k][200]);
    }

}

// $jsonCode = json_encode($responseCode[0][200]);
// echo $jsonCode ;

// $url = "https://www.google.es";
// echo $url . "<br>";
// $data = file_get_contents($url);
// $data2 = explode("/", $url);
// var_dump($data2);


?>