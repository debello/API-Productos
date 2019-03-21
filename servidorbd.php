<?php

        // Turn to JSON & output
        //echo json_encode($cat_arr);
 
class Servidor {
    /* The array key works as id and is used in the URL
       to identify the resource.
    */


    private $contactos;
    


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
            die("<p>Not connected: " . $conn -> connect_error) ."</p><br>";
        }
        else {
            echo "<p>Connected successfully. </p><br>";
        }
    
        $query = " SELECT * FROM clientes";
    
        $result = $conn -> query("$query");
    
    
        $cat_arr = array();
        $cat_arr['data'] = array();
        $cat_id = 0;
        $cat_name = '';
    
        while($row = mysqli_fetch_array($result)){
            extract($row);
    
            $cat_item = array(
                $row['auto_id'] => $cat_id,
                $row['nome'] => $cat_name
            );
            // Push to "data"
            array_push($cat_arr['data'], $cat_item);
            } // $cat_arr = $contactos
            
            $this->contactos = $cat_arr;
            var_dump($this->contactos);
        echo var_dump($cat_arr['data']  );
        echo "<br>" . json_encode($cat_arr); /// catarr data imprime nombres y auto_ids !
        ///////////////////////////////////////////////////////////////////////////////////////////// 
        

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
        if (isset($this->contactos[$name])) {
            unset($this->contactos[$name]);
            $this->result();
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
$server->serve();

?>