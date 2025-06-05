<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once(__DIR__ . '/../dao/ClienteDao.php');
require_once(__DIR__ . '/../dao/AdminDao.php');
require_once(__DIR__ . '/../models/clienteModel.php');

require_once(__DIR__ . '/../models/cancelamentoModel.php');
require_once(__DIR__ . '/../dao/CancelamentoDao.php');


$clienteDao = new CLienteDao($conn);
$cancelamentoDao = new CancelamentoDao($conn);


$tipo = filter_input(INPUT_POST,"tipo");

if($tipo == "criar"){

    $nome = filter_input(INPUT_POST,"nome");
    $nascimento = filter_input(INPUT_POST,"nascimento");
    $rua = filter_input(INPUT_POST,"rua");
    $numero = filter_input(INPUT_POST,"numero");
    $complemento = filter_input(INPUT_POST,"complemento");
    $bairro = filter_input(INPUT_POST,"bairro");
    $cidade = filter_input(INPUT_POST,"cidade");
    $estado = filter_input(INPUT_POST,"estado");
    $cep = filter_input(INPUT_POST,"cep");
    $seguro = filter_input(INPUT_POST,"seguro");
   
    if(empty($nome) || empty($nascimento) || empty($seguro) ){
        header("location: ../views/cadastrarCliente.php?erro=5");
       
    }else{
        $cliente = new clienteModel();

        $cliente->nome = $nome;
        $cliente->nascimento = $nascimento;
        $cliente->rua = $rua;
        $cliente->numero = $numero;
        $cliente->complemento = $complemento;
        $cliente->bairro = $bairro;
        $cliente->cidade = $cidade;
        $cliente->estado = $estado;
        $cliente->cep = $cep;

        //dados de data de contratação
        $data_contratação = date('Y-m-d'); //instanciando a data atual
        $data_encerramento = new DateTime($data_contratação);
        $data_encerramento->modify('+1 year');
        $data_encerramento_formatada = $data_encerramento->format('Y-m-d');
        $cliente->data_contratacao = $data_contratação;
        $cliente->data_encerramento = $data_encerramento_formatada;

        $cliente->id_seguro = $seguro;
        $cliente->status = "1";

        $clienteDao->criarCliente($cliente);

        header("location: ../views/centralClientes.php?sucesso=3");

    }
}else if($tipo == "editar"){

    $id = filter_input(INPUT_POST,"id");
    $nome = filter_input(INPUT_POST,"nome");
    $nascimento = filter_input(INPUT_POST,"nascimento");
    $rua = filter_input(INPUT_POST,"rua");
    $numero = filter_input(INPUT_POST,"numero");
    $complemento = filter_input(INPUT_POST,"complemento");
    $bairro = filter_input(INPUT_POST,"bairro");
    $cidade = filter_input(INPUT_POST,"cidade");
    $estado = filter_input(INPUT_POST,"estado");
    $cep = filter_input(INPUT_POST,"cep");
    $data_contratacao = filter_input(INPUT_POST,"data_contratacao");
    $data_encerramento = filter_input(INPUT_POST,"data_encerramento");
    $seguro = filter_input(INPUT_POST,"id_seguro");  
    $status = filter_input(INPUT_POST,"status");  

    // dados de cancelamento
    $motivo = filter_input(INPUT_POST,"motivo");
    $desc_motivo = filter_input(INPUT_POST,"desc_motivo");


    if(empty($nome) || empty($nascimento) || empty($seguro) || empty($data_contratacao) ||
     empty($data_encerramento)){
        header("location: ../views/acoesCliente.php?id=$id?&erro=6");
    }else{
        $cliente = new clientemodel();

        $cliente->id = $id;
        $cliente->nome = $nome;
        $cliente->nascimento = $nascimento;
        $cliente->rua = $rua;
        $cliente->numero = $numero;
        $cliente->complemento = $complemento;
        $cliente->bairro = $bairro;
        $cliente->cidade = $cidade;
        $cliente->estado = $estado;
        $cliente->cep = $cep;
        $cliente->data_contratacao = $data_contratacao;
        $cliente->data_encerramento = $data_encerramento;
        $cliente->id_seguro = $seguro;
        $cliente->status = $status;

        $clienteDao->editarCliente($cliente);

        //cancelamento do cliente
        if($status== 0){
            $cancelamento = new cancelamentoModel;

            $cancelamento->id_cliente = $id;
            $cancelamento->nome_cliente = $nome;
            $cancelamento->id_seguro = $seguro;
            $cancelamento->id_admin = $_SESSION["token"]['id'];
            $cancelamento->motivo = $motivo;
            $cancelamento->desc_motivo = $desc_motivo;

            //verifica se ele já está cancelado se já estiver, só edita
            $verificarCancelamento = $cancelamentoDao->verificaClienteCancelado($id);

            if($verificarCancelamento == "existeCancelamento"){
                $cancelamentoDao->editarCancelamento($cancelamento);
                header("location: ../views/centralClientes.php?cancelamento=2");
                exit;
            }else if($verificarCancelamento == "excluirCancelamento"){
                $cancelamentoDao->cancelarCliente($cancelamento);
            
                header("location: ../views/centralClientes.php?cancelamento=1");
                exit;
            }
            
           
        }else if($status == 1){
            $cancelamentoDao->ativarCliente($id);
        }

        header("location: ../views/centralClientes.php?sucesso=4");
        
        
    }


}else if($tipo == "deletar"){
    
    $id = filter_input(INPUT_POST,"id");

    if($id){

        $clienteDao->excluirCliente($id);
        header("location: ../views/centralClientes.php?sucesso=5");
    }else{
        header("location: ../views/centralClientes.php");
    }

}else{
    header("Location: ../index.php?erro=1");
}