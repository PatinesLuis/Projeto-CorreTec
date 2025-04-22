<?php

session_start();
require_once("../dao/seguroDao.php");
require_once("../dao/adminDao.php");
require_once('../models/seguroModel.php');

$seguroDao = new SeguroDao($conn);


    $tipo = filter_input(INPUT_POST,"tipo");

    if($tipo == "criar"){

        $nome_seguradora = filter_input(INPUT_POST,"nome_seguradora");
        $premio = filter_input(INPUT_POST,"premio");
        $capital = filter_input(INPUT_POST,"capital");
        $tipo_seguro = filter_input(INPUT_POST,"tipo_seguro");
        $id_admin = $_SESSION["token"]['id'];

        if(empty($nome_seguradora) || empty($premio) || empty($capital) ||empty($tipo_seguro)){
            header("location: ../views/centralseguro.php?erro=3");
        }else{

            $seguro = new seguroModel();
            
            $seguro->nome_seguradora = $nome_seguradora;
            $seguro->premio = $premio;
            $seguro->capital = $capital;
            $seguro->tipo_seguro = $tipo_seguro;
            $seguro->id_admin = $id_admin;

            $seguroDao->criarSeguro($seguro);

            header("location: ../views/centralseguro.php?sucesso=1");
        }

    }else if($tipo == "deletar"){
        $id = filter_input(INPUT_POST,"id");

        $excluir = $seguroDao->excluirSeguro($id);

        if($excluir == "sucesso"){
            header("location: ../views/centralseguro.php?sucesso=2");
        }else if($excluir == "associado"){
            header("location: ../views/centralseguro.php?erro=4");
        }else{
            header("location: ../views/centralseguro.php?erro=4");
        }
    }else{
        header("Location: ../index.php?erro=1");
    }

    