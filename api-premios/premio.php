<?php
class Premio{
 
    // conexión coa táboa da base de datos
    private $con;
    private $taboa1 = "actrices";
	private $taboa2="oscar";
	private $taboa3="actrices_oscar";
 
    // propiedades do obxecto
    public $idActriz;
    public $nomeActriz;
    public $idOscar;
    public $ano;
    public $idadeActriz;
    public $pelicula;
 
    // constructor con $db como conexión coa base de datos
    public function __construct($db){
		//echo "entra no construtor de produto con $db:".$db;
        $this->con = $db;
		$this->con->query("SET NAMES 'utf8'");
    }
	// lectura de actrices con cantidade de premios
	function contarPremiosActriz(){
		// consulta select all
		$query ="select actrices.idActriz, actrices.nomeActriz, count(*) as numOscar from ". $this->taboa1.
			" inner join actrices_oscar on actrices_oscar.idActriz=actrices.idActriz
			group by actrices.idActriz";
	 
		$stmt=$this->con->query($query);
		return $stmt;
    }
    function premiosActricesAnual(){
        // Consulta que devolve 
        // idOscar, ano, pelicula, idActriz,
        // nomeActriz e idadeActriz ordenados por idOscar
        $query =
         "SELECT oscar.idOscar, oscar.ano, actrices_oscar.pelicula, actrices.idActriz, actrices.nomeActriz, actrices_oscar.idadeActriz  
            FROM actrices  
            INNER JOIN actrices_oscar ON actrices_oscar.idActriz=actrices.idActriz  
            INNER JOIN oscar ON 
            oscar.idOscar = actrices_oscar.idOscar
            ORDER BY oscar.idOscar";
 
        $stmt=$this->con->query($query);
        return $stmt;
    }
    function  premiosActricesAnualId() {
        /* 
            public $idActriz;
            public $nomeActriz;
            public $idOscar;
            public $ano;
            public $idadeActriz;
            public $pelicula;

         */
        $stmt = $this->con->prepare(
        "SELECT oscar.idOscar, oscar.ano, actrices_oscar.pelicula, actrices.idActriz, actrices.nomeActriz, actrices_oscar.idadeActriz  
           FROM actrices  
           INNER JOIN actrices_oscar ON actrices_oscar.idActriz=actrices.idActriz  
           INNER JOIN oscar ON 
           oscar.idOscar = actrices_oscar.idOscar
           WHERE oscar.idOscar = ? 
           ORDER BY oscar.idOscar");

        $stmt->bind_param("i", $this->idOscar);

        $stmt->execute();
        $res = $stmt->get_result(); 
        return $res;  
       
    }
}
?>
