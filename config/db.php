<?php

$db_name = "corretec";
$db_host = "localhost";
$db_user = "root";
$db_password = "";


try {
    $conn = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_password);

    // habilitar erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}