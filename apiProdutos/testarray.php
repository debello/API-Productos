<?php
$err_messages = [201 => 'It Dose', 200 => 'Doscientos', 300 => 'Trescientos'];
echo $err_messages[200] . "<br>";
http_response_code(201);
echo $err_messages[http_response_code()];


$err_messages = [203 => 'Actualizacion realizada con exito',
                 404 => 'O produto non existe na base de datos', 
                 503 => 'Erro no procesamento da actualizacion'
                
                ];


?>