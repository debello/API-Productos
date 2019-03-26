<?php
/**** TODO ****
 * [DISPLAY] - Conseguir que ejecute 'display' tanto en curl (curl -v http...clientes) como en navegador (http... clientes)
 * [CREATE]
 * [UPDATE]
 * [DELETE] - CONSEGUIDO
 * 
 * [!!!] - contactos empieza por ['data']... arreglarlo
 * 
 * 
 * */




        // Turn to JSON & output
        //echo json_encode($cat_arr);
 
class Servidor {
    /* The array key works as id and is used in the URL
       to identify the resource.
    */


    public $contactos;

    public function getConex(){
        ////////////////////// SELECT ALL & OUTPUT EN JSON //////////////////////////////////////////
        $servername = "localhost";
        // El usuario que uséis (este es el que trae por defecto, administrador)
        $username = "root";
        // Esta contraseña está vacía
        $pass = "";
        // Nombre de mi base de datos
        $database = "apiclase";

        // Create conection
        $conn = new mysqli($servername, $username, $pass, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Not connected: " . $conn -> connect_error);
        }
        else {
            echo "<p>Connected successfully. </p><br>";
        }

        $query = " SELECT * FROM clientes";

        $result = $conn -> query("$query");


        $cat_arr = array();
        //$cat_arr['data'] = array();
        $cat_id = 0;
        $cat_name = '';

        while($row = mysqli_fetch_array($result)){
            //extract($row);

            $cat_item = array(
                $row['nome'] => $cat_name,
                $row['address'] => $cat_id
            );
            // Push to "data"
            array_push($cat_arr, $cat_item);
            } // $cat_arr = $contactos
            
            $this->contactos = $cat_arr;
            return $conn;
            // nuestro $cat_arr se convierte en $contactos
            // echo "antes";
            // var_dump($cat_arr);
            // echo "despois";
            //var_dump($this->contactos);
        //echo var_dump($cat_arr['data']  );
        //echo "<br>" . json_encode($cat_arr); /// catarr data imprime nombres y auto_ids !
        ///////////////////////////////////////////////////////////////////////////////////////////// 


    }
    public function getContactos() {
        return $this->contactos;
    }

    public function serve() {
      
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $paths = explode('/', $this->paths($uri));
        array_shift($paths); // Hack; get rid of initials empty string
        $resource = array_shift($paths);
      
        if ($resource == 'clientes') {
            $name = array_shift($paths);
	
            if (empty($name)) {
                $this->handle_base($method);
            } else {
                $this->handle_name($method, $name);
            }
          
        } else {
            // S? se aceptan recursos desde 'clientes'
            header('HTTP/1.1 404 Not Found');
        }
        

    }
        
    private function handle_base($method) {
        switch($method) {
        case 'GET':
            $this->result();
            break;
        default:
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET');
            break;
        }
    }

    private function handle_name($method, $name) {
        switch($method) {
        case 'PUT':
            $this->create_contact($name);
            break;

        case 'DELETE':
            $this->delete_contact($name);
            break;
      
        case 'GET':
            $this->display_contact($name);
            break;

        default:
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET, PUT, DELETE');
            break;
        }
    }
    /****************** CREATE DISPLAY DELETE *********************/
    private function create_contact($name){
        if (isset($this->contactos[$name])) {
            header('HTTP/1.1 409 Conflict');
            return;
        }
        /* PUT requests need to be handled
         * by reading from standard input.
         */
        $data = json_decode(file_get_contents('php://input'));
        if (is_null($data)) {
            header('HTTP/1.1 400 Bad Request');
            $this->result();
            return;
        }
        $this->contactos[$name] = $data; 
        $this->result();
    }
    
    private function delete_contact($name) {
        // Según la semántica de nuestro array... 
        // $contacts = [0 => xoan..., 1 => zaira...]
        // debería ser
        // $contacts = [xoan => [....], zaira => [...]]
        echo "$name";
        var_dump($this->contactos);
    //Hasta que arreglemos ['data'] no podemos usar $contactos[$name]
        if (isset($this->contactos[2][$name])) {
            $conn = $this->getConex();
            echo 'dentro del if';
            unset($this->contactos[2][$name]);
            //borrar da base de datos

            $query = " DELETE FROM clientes WHERE nome='".$name."'";
            $conn-> query($query);
           
        } else {
            header('HTTP/1.1 404 Not Found');
        }
    }
    
    
    private function display_contact($name) { //////////// DISPLAY
        if (array_key_exists($name, $this->contactos)) {
            echo json_encode($this->contactos[$name]);
        } else {
            header('HTTP/1.1 404 Not Found');
        }
    }
    
    private function paths($url) {
        $uri = parse_url($url);
        return $uri['path'];
    }
    
    /**
     * Mostra unha lista con todos os contactos
     */
    private function result() {
        header('Content-type: application/json');
        echo json_encode($this->contactos);
    }
  }

$server = new Servidor;
$server->getConex();
$server->getContactos();
echo "<br>principio del vardump<br>";
var_dump($server->getContactos());
echo "<br>fin del vardump<br>";
$server->serve();
//var_dump($server->getContactos()) // muestra nuestro json 

/*** Fuentes y Bibliografía ***//*

    PHP Api by Traversy
    https://github.com/bradtraversy/php_rest_myblog/blob/master/api/category/read.php

    PHP contructor
    https://www.phptpoint.com/php-constructor/

    How yo access a class variable inside a function
    https://stackoverflow.com/questions/38984270/how-to-access-a-class-variable-inside-a-function-with-php

*/


?>