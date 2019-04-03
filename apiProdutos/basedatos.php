<?php
class BaseDatos{
    // especificar as credencias da base de datos
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
        echo "Conexión coa base de datos realizada";
        return $this->conn;
    }
    //pechar a conexión coa base de datos
    public function cerrarConexion(){
        $this->conn->close();
    }
}

// Creando una nueva conexión (opciona, se puede hacer en el fichero de destino)
//$conexion2 = new BaseDatos;
//$conexion2->getConexion();


?>