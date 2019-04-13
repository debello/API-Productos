<?php

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
    public $creado;
    public $oldId;
    // constructor con $db como conexión coa base de datos
    public function __construct($db){
        $this->conn = $db;
    }
    // lectura de produtos
    function ler(){
        // consulta select all
        $query = "SELECT
                    c.nome as nomeCategoria, p.id, p.nome, p.descricion, p.prezo, p.idCategoria, p.creado
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
    function crear(){
        $query = "INSERT INTO ".$this->taboa." (nome, descricion, prezo) 
            VALUES ('".$this->nome."', '".$this->descricion."', ".$this->prezo.")";
        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        return $stmt;

    }

    function ler1(){
        $query = "SELECT * FROM ".$this->taboa." WHERE id=".$this->id;
        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        return $stmt;

    }

    function consultarID(){
        $query = "UPDATE ".$this->taboa." SET 
            nome ='".$this->nome."', 
            prezo =".$this->prezo.", 
            descricion='".$this->descricion."', 
            idCategoria=".$this->idCategoria.", 
            WHERE id = ".$this->id;

        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        /* 
        UPDATE produtos 
        SET nome = 'paco', prezo = 999
        WHERE nome = 'Carteira';
        */
        return $stmt;

    }


}