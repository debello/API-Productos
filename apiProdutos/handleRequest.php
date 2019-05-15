<?php
    class Servidor {
        public function serve() {
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];
            $this->handle_name($method);

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
    }

$handle = new Servidor;
$conec = $handle->serve();
        
?>