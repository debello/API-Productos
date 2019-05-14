<!DOCTYPE html>
<html>
    <head>
        <style>
            #bigbox {
                display: grid;
                grid-template-columns: 15vw 15vw 15vw 15vw;
                grid-template-rows: 70px 50px 50px ;
                grid-template-areas:
                " . dia ciudad . "
                " . max max . "
                " . min min . ";
                grid-gap: 10px;
                
                justify-content: space;
                place-self: center;
                
                background-color: hsl(0, 50%, 50%);
                width: auto;
                height: 200px;
                border-radius: 10px;
                
            }

            #bigbox div p, #bigbox div {
                display: grid;
                place-self: center;
                align-items: center;
            }

            #bigbox div {
                background-color: hsl(180, 50%, 50%);
                width: 20vw;
                height: 40px;
                border-radius: 7px;
            }

                #box-dia {
                    grid-area: dia;
                }
                #box-ciudad {
                    grid-area: ciudad;
                }
                #box-temp-max {
                    grid-area: max;
                }
                #box-temp-min {
                    grid-area: min;
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
    ?>

    <div class="sb1">Testing sb1</div>
    <h2>TuClima.com</h2>
    <div id='bigbox'>
        <div id='box-dia'> 
            <p>Día: <?php echo $dataDecoded[0]->elaborado . "<br>"; ?></p>
        </div>
        <div id='box-ciudad'>
            <p>Ciudad: <?php echo utf8_encode($dataDecoded[0]->provincia) . "<br>"; ?></p>
        </div>  
        <div id='box-temp-max'>
            <p>Temperatura Máxima: <?php echo $dataDecoded[0]->prediccion->dia[0]->temperatura->maxima . "<br>"; ?></p>
        </div>  
        <div id='box-temp-min'>
            <p>Temperatura Mínima: <?php echo $dataDecoded[0]->prediccion->dia[0]->temperatura->minima . "<br>"; ?></p>
        </div>  
    </div>
    
    <?php curl_close($cliente2); ?>

</body>
</html>