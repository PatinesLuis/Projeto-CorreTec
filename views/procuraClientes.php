<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");
    require_once("../dao/ClienteDao.php");
    require_once("../models/clienteModel.php");

    $seguroDao = new SeguroDao($conn);
    $clientesDao = new clienteDao($conn);
    $clienteModel = new clienteModel();

    $nome = filter_input(INPUT_GET, "nome");

    $clientes = $clientesDao->procurarClientePorNome($nome);
   
    $listaSeguros = $seguroDao->listarSeguros();
    $segurosMapeados = [];
    foreach ($listaSeguros as $seguro) {
    $segurosMapeados[$seguro->id] = $seguro->nome_seguradora;
}   
    $verificaSessao = $adminDao->verificaSessao();

?>

    <div class="container">
    <h1>Procura por: <?=$nome ?></h1>

        <table class="table listaClientes">
            <thead>
                <tr>
                <th scope="col">Nome do segurado</th>
                <th scope="col">data de nascimento</th>
                <th scope="col">rua</th>
                <th scope="col">numero</th>
                <th scope="col">cidade</th>
                <th scope="col">estado</th>
                <th scope="col">cep</th>
                <th scope="col">Data da contratação</th>
                <th scope="col">Data do encerramento</th>
                <th scope="col">Seguro contratado</th>
                <th scope="col">situação</th>
                <th scope="col">-</th>
                </tr>     
            </thead>
            <tbody>
            <?php foreach($clientes as $cliente):?>
                <tr>
                <td><?=$cliente->nome?></td>
                <td><?= date("d/m/Y", strtotime($cliente->nascimento)) ?></td>
                <td><?=$cliente->rua?></td>
                <td><?=$cliente->numero?></td>
                <td><?=$cliente->cidade?></td>
                <td><?=$cliente->estado?></td>
                <td><?=$cliente->cep?></td>
                <td><?= date("d/m/Y", strtotime($cliente->data_contratacao)) ?></td>
                <td><?= date("d/m/Y", strtotime($cliente->data_encerramento)) ?></td>
                <td><?= isset($segurosMapeados[$cliente->id_seguro]) ? $segurosMapeados[$cliente->id_seguro] : 'Não definido' ?></td>
                <td><p class="status">
                    <?=$clienteModel->retornaStatus($cliente->status)?>
                </p>
                </td>
                <td>
                    <form action="acoescliente.php" method="GET">
                        <input type="hidden" name="id" value="<?=$cliente->id?>">
                        <input type="submit" class="btn btn-info" value="Ações">
                    </form>
                </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>
<script src="../js/script.js"></script>
<?php
require_once("../templates/footer.php");
?>