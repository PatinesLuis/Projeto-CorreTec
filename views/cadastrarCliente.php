<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");

    $seguroDao = new SeguroDao($conn);
    $listaSeguros = $seguroDao->listarSeguros();

    $verificaSessao = $adminDao->verificaSessao();

?>

<div class="container">
    <h1>Cadastrar Clientes</h1>
    <h2>Usuário logado: <?= $_SESSION["token"]['nome'] ?></h2>

    <form action="../processos/processoClientes.php" method="post">
        <input type="hidden" name="tipo" value="criar">

        <!-- Dados pessoais -->
        <div class="mt-3 row g-2 align-items-center">
            <div class="col-md-6">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" class="form-control" placeholder="Digite o nome" name="nome">
            </div>
            <div class="col-md-6">
                <label for="nascimento">Data de nascimento</label>
                <input type="date" id="nascimento" class="form-control" name="nascimento">
            </div>
        </div>

        <!-- Endereço -->
        <div class="mt-4 endereco">
            <h5>Endereço completo</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="number" class="form-control" placeholder="Digite o CEP" id="cep" name="cep">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Digite a rua" id="rua" name="rua">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Digite o número" id="numero" name="numero">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Digite o complemento" id="complemento" name="complemento">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Digite o bairro" id="bairro" name="bairro">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Digite a cidade" id="cidade" name="cidade">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Digite o estado" id="estado" name="estado">
                </div>
            </div>
        </div>

        <!-- Seguros -->
        <div class="mb-4">
            <label for="seguro">Selecione o seguro</label>
            <select name="seguro" class="form-select" id="seguro">
                <?php foreach($listaSeguros as $seguro): ?>
                    <option value="<?= $seguro->id ?>"><?= $seguro->nome_seguradora ?> - <?= $seguro->tipo_seguro?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Botão -->
        <input type="submit" class="btn btn-success" value="Enviar">
    </form>
</div>
<script src="../js/script.js"></script>
<?php require_once("../templates/footer.php"); ?>
