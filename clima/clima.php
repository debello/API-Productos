<!DOCTYPE html>
<html>
    <head>
        <style>
            :root {
                --main-box-color: hsla(0, 59%, 60%, 0.5);
                --box-temp-color: hsl(172, 91%, 45%);
                --border-temp-color: hsl(172, 91%, 30%);
            }

            #bigbox {
                display: grid;
                grid-template-columns: 16vw 16vw 16vw 16vw;
                grid-template-rows: auto auto auto ;
                grid-template-areas:
                " temp . . . "
                " max . . . "
                " min . . . ";                          
                place-self: center;
                
                background-color: var(--main-box-color);
                width: auto;
                height: 200px;
                border-radius: 10px;
            }

            #bigbox div p, #bigbox div {
                display: grid;
                /* place-self: center; */
                align-items: center;
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
            }
            #bigbox div:nth-child(1) { /* Primera casilla vertical */
                border-radius: 5px 5px 0px 0px;
            }
            #bigbox div:nth-child(3) { /* Ultima casilla vertical */
                border-radius: 0px 0px 5px 5px;
            }

                /* #box-dia {
                    grid-area: dia;
                }
                #box-ciudad {
                    grid-area: ciudad;
                } */

                #box-temp {
                    grid-area: temp;
                }
                #box-temp-max {
                    grid-area: max;
                }
                #box-temp-min {
                    grid-area: min;
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
    
    /* Saber qué número de día de la semana es Hoy */ 
    function saber_dia($nombredia) {
        $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
        $fecha = $dias[date('N', strtotime($nombredia))];
        $fechaKey = array_search($fecha, $dias);
        return $fechaKey;
        }
    // Ejecutamos la función pasándole la fecha que queremos
    $numDiaHoy = saber_dia($dataDecoded[0]->elaborado);
    
    ?>

    <div class="sb1">Testing sb1</div>
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
            <p>Máx. <span class='font-bold'><?php echo $dataDecoded[0]->prediccion->dia[$numDiaHoy]->temperatura->maxima . "</span>"; ?></p>
        </div>  
        <div id='box-temp-min'>
            <p>Mín. <span class='font-bold'><?php echo $dataDecoded[0]->prediccion->dia[$numDiaHoy]->temperatura->minima . "</span>"; ?></p>
        </div>  
    </div>
    
    <?php curl_close($cliente2); ?>

</body>
</html>