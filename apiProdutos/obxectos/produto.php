<?php

// echo $err_messages[http_response_code()];

class Produto{
    // conexión coa táboa da base de datos
    private $conn;
    private $taboa = "produtos";
    // propiedades do obxecto
    public $id;
    public $nome;
    public $descricion;
    public $prezo;
    public $idCategoria;
    public $nomeCategoria;
    //public $creado;
    //public $oldId;

    // constructor con $db como conexión coa base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // lectura de produtos
    function ler() {
        // consulta select all
        $query = "SELECT
                    c.nome as nomeCategoria, p.id, p.nome, p.descricion, p.prezo, p.idCategoria, p.creado, p.modificado
                FROM
                    " . $this->taboa . " p
                    LEFT JOIN
                        categorias c
                            ON p.idCategoria = c.id
                ORDER BY
                    p.creado DESC";
        // prepara a consulta
        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        return $stmt;
    }

    function crear() {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->taboa . "
        (nome, descricion, prezo) 
        VALUES (?, ?, ?)");

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->prezo=htmlspecialchars(strip_tags($this->prezo));
        $this->descricion=htmlspecialchars(strip_tags($this->descricion));

        $stmt->bind_param("sss", $this->nome, $this->descricion, $this->prezo);
        $stmt->execute();
        return $stmt;
    }

    function ler1() {
        // $query = "SELECT * FROM ".$this->taboa." WHERE id = ".$this->id;
        // $stmt = $this->conn->query($query);

        $stmt = $this->conn->prepare(
            "SELECT
            c.nome as nomeCategoria, p.id, p.nome, p.descricion, p.prezo, p.idCategoria, p.creado, p.modificado
        FROM
            " . $this->taboa . " p
            LEFT JOIN
                categorias c
                    ON p.idCategoria = c.id
            WHERE p.id = ?
            ORDER BY p.creado DESC");
              
           
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $res = $stmt->get_result(); 
        return $res;  
    }

    function actualizar() {
        // $query = "UPDATE ".$this->taboa." SET 
        //     nome ='".$this->nome."', 
        //     prezo =".$this->prezo.", 
        //     descricion='".$this->descricion."', 
        //     idCategoria=".$this->idCategoria." 
        //     WHERE id = ".$this->id;
        // $stmt = $this->conn->query($query);

        $stmt = $this->conn->prepare("UPDATE ".$this->taboa." SET 
        nome = ?, 
        descricion= ?, 
        prezo = ?, 
        idCategoria= ? 
        WHERE id = ?");

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->prezo=htmlspecialchars(strip_tags($this->prezo));
        $this->descricion=htmlspecialchars(strip_tags($this->descricion));
        $this->idCategoria=htmlspecialchars(strip_tags($this->idCategoria));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("ssiii", $this->nome, $this->descricion, 
            $this->prezo, $this->idCategoria, $this->id);
        $stmt->execute();
        return $stmt;
    }

    function borrar() {
        // $query = "DELETE FROM ".$this->taboa." 
        //     WHERE id = ".$this->id;
        // $stmt = $this->conn->query($query);
        
        $stmt = $this->conn->prepare("DELETE FROM ".$this->taboa." 
        WHERE id = ?");

        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        return $stmt;
    }

    function buscar() {
        // $query = "SELECT * FROM ".$this->taboa."
        // WHERE nome LIKE '%".$this->nome."%'";
        // $stmt = $this->conn->query($query);
        // var_dump($this->nome);

        $stmt = $this->conn->prepare("SELECT
        c.nome as nomeCategoria, p.id, p.nome, p.descricion, p.prezo, p.idCategoria, p.creado, p.modificado
    FROM
        " . $this->taboa . " p
        LEFT JOIN
            categorias c
                ON p.idCategoria = c.id
        WHERE p.nome LIKE ?
        ORDER BY p.creado DESC");

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $thisNome = "%{$this->nome}%";
        $stmt->bind_param("s", $thisNome);
        $stmt->execute();
        $res = $stmt->get_result(); 
        return $res;  
    }
}

?>