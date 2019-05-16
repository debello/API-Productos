<?php   

    class BaseDatos{
        private $servidor = "localhost";
        private $nomeBD = "apiProductosBD";
        private $usuario = "root";
        private $contrasinal = "";
        public $conn;
    
        // conectarse coa base de datos
        public function getConexion(){
            $this->conn = new mysqli($this->servidor, $this->usuario, $this->contrasinal,$this->nomeBD);
            // verificar a conexión
            if ($this->conn->connect_error) {
                die("Fallou a conexión coa base de datos: " . $this->conn->connect_error);
            }
            return $this->conn;
        }
        //pechar a conexión coa base de datos
        public function cerrarConexion(){
            $this->conn->close();
        }
    }

    $err_messages = [
        200 => 'Petición tramitada con éxito. Código 200.',    
        503 => 'Produciuse un erro ao crear o produto. Erro 503.',
        400 => 'Non se puido crear o produto. Datos incompletos. Erro 400.',
        404 => 'Solicitud non encontrada. Erro 404.'
        ];

?>