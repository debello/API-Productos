<!DOCTYPE html>
<html>
    <head>
        <style>

            :root {
                --main-box-color: hsla(0, 59%, 60%, 0.5);
                --box-temp-color: hsl(172, 91%, 45%);
                --border-temp-color: hsl(172, 91%, 30%);
            }

            body {
                margin: 20px;
            }
            #bigbox {
                display: grid;
                grid-template-columns: auto auto auto auto 1fr ; /* La última columna debe ser 1fr */
                grid-template-rows: auto auto auto ;
                grid-template-areas:
                " temp preci hume uv "
                " max . hume-max . "
                " min . hume-min . ";                          
                place-self: center;
                
                /* background-color: var(--main-box-color); */
                width: auto;
                height: 220px;
                border-radius: 10px;
                margin: 15px;
            }
            #box-temp {
                    grid-area: temp;
                }
                #box-temp-max {
                    grid-area: max;
                }
                #box-temp-min {
                    grid-area: min;
                }
                #box-preci {
                    grid-area: preci;
                    width: auto;
                }
                #box-humedad {
                    grid-area: hume;
                    
                }
                #box-humedad-max {
                    grid-area: hume-max;
                }
                #box-humedad-min {
                    grid-area: hume-min;
                }
                #box-ultravioleta {
                    grid-area: uv;
                }

            #bigbox div p, #bigbox div {
                display: grid;
                /* place-self: center; */
                align-items: center;
            }
            #bigbox div p {
                padding-left: 5px;
                padding-right: 10px;
            }
            #bigbox div > * {
                display: grid;
                grid-auto-flow: column;
                place-self: center;
            }

            #bigbox div {
                background-color: var(--box-temp-color);
                width: auto;
                height: auto;
                /* border-radius: 5px; */
                padding: 7px;
                margin: 0px 7px 0px 5px;
                border-top: 1.5px var(--border-temp-color) solid;
                border-left: 1.5px var(--border-temp-color) solid;
                border-right: 1.5px var(--border-temp-color) solid;
                font-family: Arial;
                color: hsl(10, 0%, 95%);
                box-shadow: 2px 3px 0px 0px rgba(0,0,0,0.5);
            }
            #bigbox div:nth-child(1), #bigbox div:nth-child(5) { /* Primera casilla vertical, Cuarta */
                border-radius: 5px 5px 0px 0px;
                border-bottom: 0px var(--border-temp-color) solid;
            }
            #bigbox div:nth-child(3), #bigbox div:nth-child(7) { /* Ultima casilla vertical */
                border-radius: 0px 0px 5px 5px;
                border-top: 1.2px var(--border-temp-color) solid;
            }
            #bigbox div:nth-child(4), #bigbox div:nth-child(8) { /* Casillas verticalmente solitarias */
                border-radius: 5px 5px 5px 5px;
            }

            .font-bold {
                font-weight: bold;
            }

        </style>
    </head>
    <body>

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
    echo $decoded->datos . "<br><br>"; // Direccion HTTP que buscamos
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
    $dataDecoded = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data));
    
    // Testing objeto $dataDecoded;
    // echo 'Precipitacion??' .$dataDecoded[0]->prediccion->dia[0]->probPrecipitacion[0]->value;
    // echo 'Humedad Relativa max ??' .$dataDecoded[0]->prediccion->dia[0]->humedadRelativa->maxima;
    // echo 'Humedad Relativa min??' .$dataDecoded[0]->prediccion->dia[0]->humedadRelativa->minima;
    
    /* Saber qué número de día de la semana es Hoy */ 
    // function saber_dia($nombredia) {
    //     $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
    //     $fecha = $dias[date('N', strtotime($nombredia))];
    //     $fechaKey = array_search($fecha, $dias);
    //     return $fechaKey;
    //     }
    // // // Ejecutamos la función pasándole la fecha que queremos
    // $numDiaHoy = saber_dia($dataDecoded[0]->elaborado);
    
    ?>

    <h2>TuClima.com</h2>
    <p><?php echo 'Día: <span class="font-bold">' . $dataDecoded[0]->elaborado . "</span> Ciudad: <span class='font-bold'>" . utf8_encode($dataDecoded[0]->provincia) . "</span><br>"; ?></p>

    <div id='bigbox'>
        <!-- <div id='box-dia'> 
            
        </div>
        <div id='box-ciudad'>
            
        </div>   -->
        <div id='box-temp'>
            <p class='font-bold'>Temperatura</p>
        </div>
        <div id='box-temp-max'>
            <p>Máx. <span class='font-bold'><?php echo '&nbsp;'. $dataDecoded[0]->prediccion->dia[0]->temperatura->maxima . "</span>"; ?></p>
        </div>  
        <div id='box-temp-min'>
            <p>Mín. <span class='font-bold'><?php echo '&nbsp;'. $dataDecoded[0]->prediccion->dia[0]->temperatura->minima . "</span>"; ?></p>
        </div> 
        <div id='box-preci'>
            <p> <span class='font-bold'>Precipitaciones: 
            <?php echo '&nbsp;'. $dataDecoded[0]->prediccion->dia[0]->probPrecipitacion[0]->value . "%</span>"; ?></p>
        </div>  
        <div id='box-humedad'>
            <p class='font-bold'>Humedad Relativa</p>
        </div>
        <div id='box-humedad-max'>
            <p> Max. <span class='font-bold'> <?php echo '&nbsp;'. $dataDecoded[0]->prediccion->dia[0]->humedadRelativa->maxima . "</span>"; ?></p>
        </div>  
        <div id='box-humedad-min'>
            <p> Min. <span class='font-bold'> <?php echo '&nbsp;'. $dataDecoded[0]->prediccion->dia[0]->humedadRelativa->minima . "</span>"; ?></p>
        </div>
        <div id='box-ultravioleta'>
            <p> <span class='font-bold'>Indice Ultravioleta:  <?php echo '&nbsp;'. $dataDecoded[0]->prediccion->dia[0]->uvMax . "</span>"; ?></p>
        </div>      
    </div>
    
    <?php curl_close($cliente2); ?>

</body>
</html>