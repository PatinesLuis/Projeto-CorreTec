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
        $cliente->cep = $dados['cep'];
        $cliente->data_contratacao = $dados['data_contratacao'];
        $cliente->data_encerramento = $dados['data_encerramento'];
        $cliente->id_seguro = $dados['id_seguro'];
        $cliente->status = $dados['status'];

        return $cliente;

    }

    public function criarCliente($cliente){
        $stmt = $this->conn->prepare("INSERT INTO clientes (nome, nascimento, rua, numero, complemento, bairro, cidade, estado, cep, data_contratacao, data_encerramento, id_seguro, status) VALUES
        (:nome, :nascimento, :rua, :numero, :complemento, :bairro, :cidade, :estado, :cep, :data_contratacao, :data_encerramento, :id_seguro, :status)");

        $stmt->bindParam(":nome",$cliente->nome);
        $stmt->bindParam(":nascimento",$cliente->nascimento);
        $stmt->bindParam(":rua",$cliente->rua);
        $stmt->bindParam(":numero",$cliente->numero);
        $stmt->bindParam(":complemento",$cliente->complemento);
        $stmt->bindParam(":bairro",$cliente->bairro);
        $stmt->bindParam(":cidade",$cliente->cidade);
        $stmt->bindParam(":estado",$cliente->estado);
        $stmt->bindParam(":cep",$cliente->cep);
        $stmt->bindParam(":data_contratacao",$cliente->data_contratacao);
        $stmt->bindParam(":data_encerramento",$cliente->data_encerramento);
        $stmt->bindParam(":id_seguro",$cliente->id_seguro);
        $stmt->bindParam(":status",$cliente->status);
        

        $stmt->execute();
    }

    public function editarCliente($cliente){

        $stmt = $this->conn->prepare("UPDATE clientes SET
        nome = :nome, nascimento = :nascimento, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, data_contratacao = :data_contratacao, data_encerramento = :data_encerramento, id_seguro = :id_seguro, status = :status WHERE id = :id");

        $stmt->bindParam(":nome", $cliente->nome);
        $stmt->bindParam(":nascimento", $cliente->nascimento);
        $stmt->bindParam(":rua", $cliente->rua);
        $stmt->bindParam(":numero", $cliente->numero);
        $stmt->bindParam(":complemento", $cliente->complemento);
        $stmt->bindParam(":bairro", $cliente->bairro);
        $stmt->bindParam(":cidade", $cliente->cidade);
        $stmt->bindParam(":estado", $cliente->estado);
        $stmt->bindParam(":cep", $cliente->cep);
        $stmt->bindParam(":data_contratacao", $cliente->data_contratacao);
        $stmt->bindParam(":data_encerramento", $cliente->data_encerramento);
        $stmt->bindParam(":id_seguro", $cliente->id_seguro);
        $stmt->bindParam(":status", $cliente->status);
        $stmt->bindParam(":id", $cliente->id);

        $stmt->execute();

        
    }

    public function excluirCLiente($id){
        $stmt = $this->conn->prepare("DELETE FROM cancelamentos WHERE id_cliente = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

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

        if ($dados) {
            $cliente = $this->construirCliente($dados);
            return $cliente;
        }
    
        return null; // ou false, caso não encontre
}

public function totalClientes(){
    $resultado = [];
    $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM clientes");
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalClientes = $resultado['total'];

    return $totalClientes;
    
}

    public function totalPremios(){

    $resultado = [];
    $stmt = $this->conn->query("SELECT SUM(seguros.premio) AS total_geral FROM clientes JOIN seguros ON clientes.id_seguro = seguros.id;");
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalClientes = $resultado['total_geral'];

    return $totalClientes;
    }

    public function totalAtivos(){
        $resultado = [];
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM clientes WHERE status = '1';");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalClientes = $resultado['total'];

    return $totalClientes;
    }

    public function totalInativos(){
        $resultado = [];
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM clientes WHERE status = '0';");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalClientes = $resultado['total'];

    return $totalClientes;
    }

    public function procurarClientePorNome($nome){
        $clientes = [];

        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE nome LIKE :nome");
        $stmt->bindValue(":nome", '%'.$nome.'%');
        $stmt->execute();

        if($stmt->rowCount()> 0){
            $clientesArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($clientesArray as $cliente){
                $clientes[] = $this->construirCliente($cliente);
            }
        }

        return $clientes;
    }
}