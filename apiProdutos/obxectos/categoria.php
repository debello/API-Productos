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

    // constructor con $db como conexión coa base de datos
    public function __construct($db) {
        $this->conn = $db;
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



        
        //             id as idCategoria, nome, descricion, creada, modificada
        //         FROM
        //             " . $this->taboa . " 
        //         ORDER BY
        //             creada DESC";

                //     "SELECT
                //     c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                // FROM
                //     " . $this->table_name . " p
                //     LEFT JOIN
                //         categories c
                //             ON p.category_id = c.id
                // ORDER BY
                //     p.created DESC";
        // prepara a consulta
        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        return $stmt;
    }

    function crear() {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->taboa . "
        (nome, descricion) 
        VALUES (?, ?)");

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricion = htmlspecialchars(strip_tags($this->descricion));

        $stmt->bind_param("ss", $this->nome, $this->descricion);
        $stmt->execute();
        return $stmt;
    }

    function ler1() {
        // $query = "SELECT * FROM ".$this->taboa." WHERE id = ".$this->id;
        // $stmt = $this->conn->query($query);

        $stmt = $this->conn->prepare(
           "SELECT * FROM ".$this->taboa." WHERE id = ? ");
           
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
        descricion = ? 
        WHERE id = ?");

        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->descricion=htmlspecialchars(strip_tags($this->descricion));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("ssi", $this->nome, $this->descricion, $this->id);
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