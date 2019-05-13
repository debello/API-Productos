<?php
/* Funciona
curl -v GET "http://localhost:8080/servizoweb/apiProdutos/handleRequest.php?id=2"
*/

    class Servidor {

        public function serve() {
            
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];
            //$paths = explode('/', $this->paths($uri));            array_shift($paths); // Hack; get rid of initials empty string
            //$resource = array_shift($paths);

            // if ($resource == 'produtos') {
            //     $name = array_shift($paths);
                
            //     if (empty($name)) {
            //         $this->handle_base($method);
            //     } 
            //     else {
                    $this->handle_name($method);
            //     }  
            // } 
            // else {
            //     // S? se aceptan recursos desde 'clientes'
            //     header('HTTP/1.1 404 Not Found');
            // }
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

        private function handle_name($method) {
            switch($method) {
            case 'PUT':
                include 'produto/actualizacion.php';
                break;

            case 'DELETE':
                include 'produto/borrado.php';
                break;

            case 'GET':
                include 'produto/lectura1.php';
                break;

            default:
                header('HTTP/1.1 405 Method Not Allowed');
                header('Allow: GET, PUT, DELETE');
                break;
            }
        }
    //}
            // if ($name && $method) {
            //     handle_name($method, $name);
            // }
            // else if ($method) {
            //     handle_base($method);
            // }
            // else {
            //     echo 'ERROR con el HandleRequest';
            // }


    }

$handle = new Servidor;
$conec = $handle->serve();


// $conexion = new BaseDatos;
// $conn = $conexion->getConexion();
// $produto = new Produto($conn);




        
?>