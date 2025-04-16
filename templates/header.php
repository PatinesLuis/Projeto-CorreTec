<?php
    require_once(__DIR__ . '/../config/db.php');
    require_once(__DIR__ . '/../config/globals.php');
    require_once(__DIR__ . '/../dao/AdminDao.php');
    require_once(__DIR__ . '/../templates/mensagem.php');

    $adminDao = new AdminDao($conn);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CorreTec</title>
</head>
<body>