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

    function crear1(){
        $query = "SELECT * FROM ".$this->taboa." WHERE id=".$this-id;
        $stmt = $this->conn->query($query);
        // execución da consulta
        //$stmt->execute();
        return $stmt;

    }



}