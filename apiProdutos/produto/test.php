<?php
$url = "https://www.google.es";
echo $url . "<br>";
$data = file_get_contents($url);
$data2 = explode("/", $url);
var_dump($data2);
?>