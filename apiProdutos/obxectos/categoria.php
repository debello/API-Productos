<?php

class Categoria{
    // conexión coa táboa da base de datos
    private $conn;
    private $taboa = "categorias";
    // propiedades do obxecto
    public $id;
    public $nome;
    public $descricion;
    public $prezo;
    public $idCategoria;
    public $nomeCategoria;
    public $creado;
    public $oldId;
    public $modificado;

    // constructor con $db como conexión coa base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    function consultarID() {
        $query = "SELECT * FROM " .$this->taboa. " WHERE id = " .$this->id;
        $stmt = $this->conn->query($query);
        $num = $stmt->num_rows;

        if ($num != 0) {
            return true;
        }
        else {
            return false;
        }
    }
    // lectura de produtos
    function ler() {
        // consulta select all
            $query = "SELECT
            p.id as ID, c.id as idCategoria, c.nome, c.descricion, c.creada, c.modificada
        FROM
            produtos p
            LEFT JOIN
                categorias c
                    ON p.idCategoria = c.id
        ORDER BY
            p.creado DESC";

        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        return $stmt;
    }

    function crear() {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->taboa . "
        (nome, descricion, creada, modificada) 
        VALUES ( ?, ?, ?, ? )");

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricion = htmlspecialchars(strip_tags($this->descricion));
        $this->creado = htmlspecialchars(strip_tags($this->creado));
        $this->modificado = htmlspecialchars(strip_tags($this->modificado));

        $stmt->bind_param("ssss", $this->nome, $this->descricion, $this->creado, $this->modificado);
        $stmt->execute();
        return $stmt;
    }

    function ler1() {
        $stmt = $this->conn->prepare(
           "SELECT * FROM ".$this->taboa." WHERE id = ? ");
           
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $res = $stmt->get_result(); 
        return $res;  
    }

    function actualizar() {
        $existeID = $this->consultarID();
            if ($existeID) {
                $stmt = $this->conn->prepare("UPDATE ".$this->taboa." SET 
                nome = ?, 
                descricion = ?, 
                modificada = ?  
                WHERE id = ?");

                $this->nome=htmlspecialchars(strip_tags($this->nome));
                $this->descricion=htmlspecialchars(strip_tags($this->descricion));
                $this->id=htmlspecialchars(strip_tags($this->id));
                $this->modificado = date("Y-m-d H:i:s");

                $stmt->bind_param("sssi", $this->nome, $this->descricion, $this->modificado, $this->id);
                $stmt->execute();
                return $stmt;
            }
    }

    function borrar() {   
        $existeID = $this->consultarID();
        if ($existeID) {   
            $stmt = $this->conn->prepare("DELETE FROM ".$this->taboa." 
            WHERE id = ?");

            $this->id=htmlspecialchars(strip_tags($this->id));
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            return $stmt;
        }
    }

    function buscar() {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->taboa."
         WHERE nome LIKE ? ");

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $thisNome = "%{$this->nome}%";
        $stmt->bind_param("s", $thisNome);
        $stmt->execute();
        $res = $stmt->get_result(); 
        return $res;  
    }
}

?>