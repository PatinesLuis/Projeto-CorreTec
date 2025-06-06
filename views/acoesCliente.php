<?php
    require_once(__DIR__ . '/../templates/header.php');
    require_once(__DIR__ . '/../dao/SeguroDao.php');
    require_once(__DIR__ . '/../dao/ClienteDao.php');
    require_once(__DIR__ . '/../models/clienteModel.php');
    $verificaSessao = $adminDao->verificaSessao();

    $seguroDao = new SeguroDao($conn);
    $clienteDao = new clienteDao($conn);
    $clienteModel = new clienteModel();

    $listaSeguros = $seguroDao->listarSeguros(); 

    $id = filter_input(INPUT_GET, "id");
    $cliente = $clienteDao->procurarCLiente($id);
?>
    <div class="container">
    <h2>Editar o cliente</h2>

    <form action="/../processos/processoClientes.php" method="post" class="p-4 bg-light rounded shadow">
    <input type="hidden" name="id" value="<?= $cliente->id ?>">

    <div class="mb-3">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" id="nome" name="nome" class="form-control" value="<?= $cliente->nome ?>">
    </div>

    <div class="mb-3">
        <label for="nascimento" class="form-label">Data de nascimento</label>
        <input type="date" id="nascimento" name="nascimento" class="form-control" value="<?= $cliente->nascimento ?>">
    </div>

    <h5 class="mt-4">Endereço</h5>

    <div class="mb-3">
        <label for="rua" class="form-label">Rua</label>
        <input type="text" id="rua" name="rua" class="form-control" value="<?= $cliente->rua ?>">
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="numero" class="form-label">Número</label>
            <input type="text" id="numero" name="numero" class="form-control" value="<?= $cliente->numero ?>">
        </div>
        <div class="col-md-4">
            <label for="complemento" class="form-label">Complemento</label>
            <input type="text" id="complemento" name="complemento" class="form-control" value="<?= $cliente->complemento ?>">
        </div>
        <div class="col-md-4">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" id="bairro" name="bairro" class="form-control" value="<?= $cliente->bairro ?>">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" id="cidade" name="cidade" class="form-control" value="<?= $cliente->cidade ?>">
        </div>
        <div class="col-md-4">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" id="estado" name="estado" class="form-control" value="<?= $cliente->estado ?>">
        </div>
        <div class="col-md-2">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" id="cep" name="cep" class="form-control" value="<?= $cliente->cep ?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="data_contratacao" class="form-label">Data de Contratação</label>
        <input type="date" id="data_contratacao" name="data_contratacao" class="form-control" value="<?= $cliente->data_contratacao ?>">
    </div>

    <div class="mb-3">
        <label for="data_encerramento" class="form-label">Data de Encerramento</label>
        <input type="date" id="data_encerramento" name="data_encerramento" class="form-control" value="<?= $cliente->data_encerramento ?>">
    </div>

    <div class="mb-3">
        <label for="id_seguro" class="form-label">Seguradora</label>
        <select name="id_seguro" id="id_seguro" class="form-select">
            <?php foreach($listaSeguros as $seguro): ?>
                <option value="<?= $seguro->id ?>" <?= $seguro->id == $cliente->id_seguro ? 'selected' : '' ?>>
                    <?= $seguro->nome_seguradora ?> - <?= $seguro->tipo_seguro?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Status</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" value="1" id="ativo" <?= $cliente->status == 1 ? 'checked' : '' ?>>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" value="0" id="inativo" <?= $cliente->status == 0 ? 'checked' : '' ?>>
            <label class="form-check-label" for="inativo">Inativo</label>
        </div>
    </div>
    
    <div id="form-inativo" class="cancelamentos" style="display: none; margin-top: 10px;">
        
    <select class="form-select" aria-label="Default select example" name="motivo" id="">
        <option value="sac">Via SAC</option>
        <option value="seguradora">Na seguradora</option>
        <option value="banco">No banco</option>
        <option value="pagamento">Falta de pagamento</option>
        <option value="vigencia">Vigência</option>
    </select>
        <textarea style="height: 80px" class="form-control" name="desc_motivo" placeholder="Descrição do motivo"></textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" name="tipo" value="editar" class="btn btn-primary">Editar segurado</button>
        <button type="submit" name="tipo" value="deletar" class="btn btn-danger">Deletar segurado</button>
    </div>
</form>
    </div>

<script src="../js/script.js"></script>
<?php
require_once("../templates/footer.php");
?>