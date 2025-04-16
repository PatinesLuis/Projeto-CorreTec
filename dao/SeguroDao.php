<?php

require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../models/seguroModel.php');


class SeguroDao implements seguroDaoInterface{

    public $conn;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function construirSeguro($seguro){
        $seguro = new seguroModel();

        $seguro->id = $seguro['id'];
        $seguro->nome_seguradora = $seguro['nome_seguradora'];
        $seguro->premio = $seguro['premio'];
        $seguro->capital = $seguro['capital'];
        $seguro->tipo_seguro = $seguro['tipo_seguro'];

        return $seguro;
    }
    public function criarSeguro($seguro){

        $stmt = $this->conn->prepare("INSERT INTO seguros (nome_seguradora, premio, capital, tipo_seguro, id_admin)
        VALUES (:nome_seguradora, :premio, :capital, :tipo_seguro, :id_admin)");

        $stmt->bindParam(":nome_seguradora",$seguro->nome_seguradora);
        $stmt->bindParam(":premio",$seguro->premio);
        $stmt->bindParam(":capital",$seguro->capital);
        $stmt->bindParam(":tipo_seguro",$seguro->tipo_seguro);
        $stmt->bindParam(":id_admin",$seguro->id_admin);
        $stmt->execute();

    }
    public function editarSeguro($idSeguro){

    }
    public function excluirSeguro($idSeguro){

    }

}