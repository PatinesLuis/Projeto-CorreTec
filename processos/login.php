<?php

require_once(__DIR__ . '/../dao/AdminDao.php');
require_once(__DIR__ . '/../config/db.php');
session_start();

$adminDao = new AdminDao($conn);

$login = filter_input(INPUT_POST, "login");
$senha = filter_input(INPUT_POST, "senha");

if (!empty($login) && !empty($senha)) {
    if ($adminDao->verificaLogin($login, $senha)) {
        // Se login válido, redireciona para o painel
        header("Location: ../views/dashboard.php");
        exit;
    } else {
        // Login inválido
        header("Location: ../index.php?erro=1");
        exit;
    }
} else {
    // Campos vazios
    header("Location: ../index.php");
    exit;
}
