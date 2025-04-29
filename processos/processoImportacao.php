<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once(__DIR__ . '/../config/db.php');
require_once("../dao/ClienteDao.php");
require_once("../dao/adminDao.php");
require_once('../models/clienteModel.php');

require_once('../models/cancelamentoModel.php');
require_once("../dao/CancelamentoDao.php");

$clienteDao = new CLienteDao($conn);


if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0){

    $arquivo = $_FILES['arquivo']['tmp_name'];
    $abrirArquivo = fopen($arquivo, 'r');

    //ignorar primeira linha se for cabeçalho
    $cabecalho = fgetcsv($abrirArquivo,1000, ';');
              //le a linha e transforma em array(1000->numero maximo de caracteres - ','define o separador)
    
    while(($dados = fgetcsv($abrirArquivo,1000, ';')) !== false){
        $nome = $dados[0];
        $nascimento = DateTime::createFromFormat('d/m/y', $dados[1];);
        $rua = $dados[2];
        $numero = $dados[3];
        $complemento = $dados[4];
        $bairro = $dados[5];
        $cidade = $dados[6];
        $estado = $dados[7];
        $cep = $dados[8];
        $data_contratacao = DateTime::createFromFormat('d/m/Y', $dados[9]);
        $data_encerramento = DateTime::createFromFormat('d/m/Y', $dados[10]);
        $id_seguro = $dados[11];
        $status = $dados[12];


        $cliente = new clienteModel();

        $cliente->nome = $nome;
        $cliente->rua = $rua;
        $cliente->numero = $numero;
        $cliente->complemento = $complemento;
        $cliente->bairro = $bairro;
        $cliente->cidade = $cidade;
        $cliente->estado = $estado;
        $cliente->cep = $cep;
        if ($data_contratacao && $data_encerramento && $nascimento) {
            $cliente->nascimento = $nascimento->format('y-m-d');
            $cliente->data_contratacao = $data_contratacao->format('Y-m-d');
            $cliente->data_encerramento = $data_encerramento->format('Y-m-d');
        }
        $cliente->id_seguro = $id_seguro;
        $cliente->status = $status;



        try {
            $clienteDao->criarCliente($cliente);
        } catch (PDOException $e) {
            echo "Erro ao importar cliente: " . $e->getMessage();
        }
    }

    fclose($abrirArquivo);

    header("location: ../views/centralClientes.php?sucesso=6");
}else{
    header("location: ../views/centralClientes.php?erro=7");
}