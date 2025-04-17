<?php

require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../models/seguroModel.php');


class SeguroDao implements seguroDaoInterface{

    public $conn;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function construirSeguro($dado){
        $seguro = new seguroModel();

        $seguro->id = $dado['id'];
        $seguro->nome_seguradora = $dado['nome_seguradora'];
        $seguro->premio = $dado['premio'];
        $seguro->capital = $dado['capital'];
        $seguro->tipo_seguro = $dado['tipo_seguro'];

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

        $execução = '';
        try {
            $stmt = $this->conn->prepare("DELETE FROM seguros WHERE id = :id");
            $stmt->bindParam(":id", $idSeguro);
            $stmt->execute();
            
            $execução = "sucesso";
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                // 23000 = erro de integridade referencial (chave estrangeira)
                $execução = "associado";
            } else {
                $execução = "errobd";
            }
        }

        return $execução;
    }

    public function listarSeguros(){

        $seguros = [];
        $stmt = $this->conn->query("SELECT * FROM seguros");
        $stmt->execute();

        if($stmt->rowCount() >0){
            $listaSeguro = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($listaSeguro as $seguro){
                $seguros[] = $this->construirSeguro($seguro);
            }
        }

        return $seguros;
    }

}