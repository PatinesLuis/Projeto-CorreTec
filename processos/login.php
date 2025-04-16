<?php

require_once("../dao/adminDao.php");
require_once("../config/db.php");
session_start();

$adminDao = new AdminDao($conn);

$login = filter_input(INPUT_POST, "login");
$senha = filter_input(INPUT_POST, "senha");

if(!empty($login) && !empty($senha)){

    if($adminDao->verificaLogin($login, $senha)){
        
        if (!isset($_SESSION['token'])) {
            // Usuário não está logado, redireciona para a página de login
            header("Location: ../index.php");
            exit;
        }else{
            header("Location: ../views/dashboard.php");
        }

    }else{
        header("Location: ../index.php?erro=1");
    }

}else{
    echo "dados vazios";
}