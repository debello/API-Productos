<?php
class testclass {
}

$test = new testclass;
$test->a = 'uno';
$test->b = 'dos';
$test->c = 'tres';

var_dump($test);
echo "<br>";
$testJSON = json_encode($test);
echo "<br>";
var_dump($testJSON);

?>