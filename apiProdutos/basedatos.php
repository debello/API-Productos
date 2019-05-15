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
        200 => 'A solicitude tramitouse con exito',    
        203 => 'Peticion realizada con exito',
        404 => 'O produto non existe na base de datos', 
        503 => 'Erro no procesamento da peticion' ];

?>