<?php
    class Servidor {
        
        public function serve() {
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];
            $this->handle_name($method);

        }
        
        // private function handle_base($method) {
        //     var_dump($id);
        //     switch($method) {
        //         case 'GET':
        //         include 'produto/lectura.php';
        //             break;
        //         default:
        //             header('HTTP/1.1 405 Method Not Allowed');
        //             header('Allow: GET');
        //             break;
        //     }
        // }

        private function handle_name($method) {
            switch($method) {
                
                case 'GET':
                    include 'produto/lectura.php';
                    break;

                case 'POST':
                    include 'produto/creacion.php';
                    break;

                default:
                    header('HTTP/1.1 405 Method Not Allowed');
                    header('Allow: POST, GET, PUT, DELETE');
                    break;
            }
        }
    }

    $handle = new Servidor;
    $conec2 = $handle->serve();
            
?>