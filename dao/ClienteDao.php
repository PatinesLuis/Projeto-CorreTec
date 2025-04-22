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

        $cliente->id = $dados['id'];
        $cliente->nome = $dados['nome'];
        $cliente->nascimento = $dados['nascimento'];
        $cliente->rua = $dados['rua'];
        $cliente->numero = $dados['numero'];
        $cliente->complemento = $dados['complemento'];
        $cliente->bairro = $dados['bairro'];
        $cliente->cidade = $dados['cidade'];
        $cliente->estado = $dados['estado'];
        $cliente->data_contratacao = $dados['data_contratacao'];
        $cliente->data_encerramento = $dados['data_encerramento'];
        $cliente->id_seguro = $dados['id_seguro'];
        $cliente->status = $dados['status'];

        return $cliente;

    }

    public function criarCliente($cliente){
        $stmt = $this->conn->prepare("INSERT INTO clientes (nome, nascimento, rua, numero, complemento, bairro, cidade, estado, data_contratacao, data_encerramento, id_seguro, status) VALUES
        (:nome, :nascimento, :rua, :numero, :complemento, :bairro, :cidade, :estado, :data_contratacao, :data_encerramento, :id_seguro, :status)");

        $stmt->bindParam(":nome",$cliente->nome);
        $stmt->bindParam(":nascimento",$cliente->nascimento);
        $stmt->bindParam(":rua",$cliente->rua);
        $stmt->bindParam(":numero",$cliente->numero);
        $stmt->bindParam(":complemento",$cliente->complemento);
        $stmt->bindParam(":bairro",$cliente->bairro);
        $stmt->bindParam(":cidade",$cliente->cidade);
        $stmt->bindParam(":estado",$cliente->estado);
        $stmt->bindParam(":data_contratacao",$cliente->data_contratacao);
        $stmt->bindParam(":data_encerramento",$cliente->data_encerramento);
        $stmt->bindParam(":id_seguro",$cliente->id_seguro);
        $stmt->bindParam(":status",$cliente->status);
        

        $stmt->execute();
    }

    public function editarCliente($cliente){

        $stmt = $this->conn->prepare("UPDATE clientes SET
        nome = :nome, nascimento = :nascimento, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, data_contratacao = :data_contratacao, data_encerramento = :data_encerramento, id_seguro = :id_seguro, status = :status WHERE id = :id");

        $stmt->bindParam(":nome", $cliente->nome);
        $stmt->bindParam(":nascimento", $cliente->nascimento);
        $stmt->bindParam(":rua", $cliente->rua);
        $stmt->bindParam(":numero", $cliente->numero);
        $stmt->bindParam(":complemento", $cliente->complemento);
        $stmt->bindParam(":bairro", $cliente->bairro);
        $stmt->bindParam(":cidade", $cliente->cidade);
        $stmt->bindParam(":estado", $cliente->estado);
        $stmt->bindParam(":data_contratacao", $cliente->data_contratacao);
        $stmt->bindParam(":data_encerramento", $cliente->data_encerramento);
        $stmt->bindParam(":id_seguro", $cliente->id_seguro);
        $stmt->bindParam(":status", $cliente->status);
        $stmt->bindParam(":id", $cliente->id);

        $stmt->execute();

        
    }

    public function excluirCLiente($id){
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();    
    }

    public function listarClientes(){

        $clientes = [];
        $stmt = $this->conn->query("SELECT * FROM clientes");
        $stmt->execute();

        if($stmt->rowCount() >0){
            $listaClientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($listaClientes as $cliente){
                $clientes[] = $this->construirCliente($cliente);
            }
        }

        return $clientes;
    }

    public function procurarCLiente($id){

        $cliente = [];
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        $cliente = $this->construirCliente($dados);

        if ($dados) {
            $cliente = $this->construirCliente($dados);
            return $cliente;
        }
    
        return null; // ou false, caso não encontre
}
}