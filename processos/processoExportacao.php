<?php
require_once(__DIR__ . '/../config/db.php');
require_once("../dao/ClienteDao.php");

$clientesDao = new ClienteDao($conn);
$clientes = $clientesDao->listarClientes(); // Certifique-se que retorna array associativo

// Cabeçalhos para forçar download como CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="clientes_exportados.csv"');

$saida = fopen('php://output', 'w');

// Cabeçalho do CSV
fputcsv($saida, [
    'nome', 'nascimento', 'rua', 'numero', 'complemento', 'bairro',
    'cidade', 'estado', 'cep', 'data_contratacao',
    'data_encerramento', 'id_seguro', 'status'
], ';');

// Conteúdo do CSV
foreach ($clientes as $cliente) {
    fputcsv($saida, [
        $cliente->nome,
        $cliente->nascimento,
        $cliente->rua,
        $cliente->numero,
        $cliente->complemento,
        $cliente->bairro,
        $cliente->cidade,
        $cliente->estado,
        $cliente->cep,
        $cliente->data_contratacao,
        $cliente->data_encerramento,
        $cliente->id_seguro,
        $cliente->status
    ], ';');
}


fclose($saida);
exit;
