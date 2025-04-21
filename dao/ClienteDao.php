<?php

require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../models/clienteModel.php');

class clienteDao implements clienteDaoInterface{

    public $conn;
    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function construirCliente($dados){

        $cliente = new clientemodel();

        $cliente->id = $dado['id'];
        $cliente->nome = $dado['nome'];
        $cliente->nascimento = $dado['nascimento'];
        $cliente->rua = $dado['rua'];
        $cliente->complemento = $dado['complemento'];
        $cliente->bairro = $dado['bairro'];
        $cliente->cidade = $dado['cidade'];
        $cliente->estado = $dado['estado'];
        $cliente->data_contratacao = $dado['data_contratacao'];
        $cliente->data_encerramento = $dado['data_encerramento'];
        $cliente->status = $dado['status'];

        return $cliente;

    }

    public function criarCliente($cliente){

    }

    public function editarCliente($id){

    }

    public function excluirCLiente($id){

    }

    public function listarClientes(){

    }

    public function procurarCLiente($dado){

    }
}