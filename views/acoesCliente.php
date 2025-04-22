<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");
    require_once("../dao/ClienteDao.php");
    require_once("../models/clienteModel.php");

    $seguroDao = new SeguroDao($conn);
    $clienteDao = new clienteDao($conn);
    $clienteModel = new clienteModel();

   
    $listaSeguros = $seguroDao->listarSeguros(); 
    $verificaSessao = $adminDao->verificaSessao();

    $id = filter_input(INPUT_GET, "id");
    $cliente = $clienteDao->procurarCLiente($id);
?>

<h2>Editar o cliente</h2>

<form action="../PROCESSOS/processoClientes.php" method="post">
<input type="hidden" name ="id" value="<?= $cliente->id?>">
    <input type="text" name ="nome" value="<?= $cliente->nome?>">
    <input type="date" name ="nascimento" value="<?= $cliente->nascimento?>">
    <input type="text" name="rua" value="<?= $cliente->rua?>">
    <input type="text" name ="numero" value="<?= $cliente->numero?>">
    <input type="text" name ="complemento" value="<?= $cliente->complemento?>">
    <input type="text" name ="bairro" value="<?= $cliente->bairro?>">
    <input type="text" name ="cidade" value="<?= $cliente->cidade?>">
    <input type="text" name ="estado" value="<?= $cliente->estado?>">
    <input type="date" name ="data_contratacao" value="<?= $cliente->data_contratacao?>">
    <input type="date" name ="data_encerramento" value="<?= $cliente->data_encerramento?>">
    <select name="id_seguro" id="">
    <?php foreach($listaSeguros as $seguro): ?>
        <option value="<?= $seguro->id ?>" <?= $seguro->id == $cliente->id_seguro ? 'selected' : '' ?>>
            <?= $seguro->nome_seguradora ?>
        </option>
    <?php endforeach; ?>
</select>
<label>
    <input type="radio" name="status" value="1" <?= $cliente->status == 1 ? 'checked' : '' ?>>
    Ativo
</label>
<label>
    <input type="radio" name="status" value="0" <?= $cliente->status == 0 ? 'checked' : '' ?>>
    Inativo
</label>
        <button type="submit" name="tipo" value="editar">Editar segurado</button>
        <button type="submit" name="tipo" value="deletar">deletar segurado</button>
</form>