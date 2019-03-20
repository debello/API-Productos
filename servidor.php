<?php
class Servidor {
    /* The array key works as id and is used in the URL
       to identify the resource.
    */
    private $contactos = array('zaira' => array('address' => 'Rua do Home Santo, 45', 'url' => '/clientes/zaira'),
                              'xoan' => array('address' => 'Rua da Rosa, 33', 'url'=> '/clientes/xoan')
);

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
    
    private function display_contact($name) {
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