<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");
    require_once("../dao/ClienteDao.php");
    require_once("../models/clienteModel.php");

    $seguroDao = new SeguroDao($conn);
    $clientesDao = new clienteDao($conn);
    $clienteModel = new clienteModel();

    $clientes = $clientesDao->listarClientes();
   
    $listaSeguros = $seguroDao->listarSeguros();
    $segurosMapeados = [];
    foreach ($listaSeguros as $seguro) {
    $segurosMapeados[$seguro->id] = $seguro->nome_seguradora;
}   
    $verificaSessao = $adminDao->verificaSessao();

?>

    <h1>Central dos CLIENTES</h1>

    <div class="lista de clientes">
            <table border=1>
                <thead>
                    <tr>
                    <th>Nome do segurado</th>
                    <th>data de nascimento</th>
                    <th>rua</th>
                    <th>numero</th>
                    <th>complemento</th>
                    <th>bairro</th>
                    <th>cidade</th>
                    <th>Data da contratação</th>
                    <th>Data do encerramento</th>
                    <th>Seguro contratado</th>
                    <th>situação</th>
                    <th>-</th>
                    </tr>     
                </thead>
                <tbody>
                <?php foreach($clientes as $cliente):?>
                    <tr>
                    <td><?=$cliente->nome?></td>
                    <td><?= date("d/m/Y", strtotime($cliente->nascimento)) ?></td>
                    <td><?=$cliente->rua?></td>
                    <td><?=$cliente->numero?></td>
                    <td><?=$cliente->complemento?></td>
                    <td><?=$cliente->bairro?></td>
                    <td><?=$cliente->cidade?></td>
                    <td><?= date("d/m/Y", strtotime($cliente->data_contratacao)) ?></td>
                    <td><?= date("d/m/Y", strtotime($cliente->data_encerramento)) ?></td>
                    <td><?= isset($segurosMapeados[$cliente->id_seguro]) ? $segurosMapeados[$cliente->id_seguro] : 'Não definido' ?></td>
                    <td><?=$clienteModel->retornaStatus($cliente->status)?></td>
                    <td>
                        <form action="acoescliente.php" method="GET">
                            <input type="hidden" name="id" value="<?=$cliente->id?>">
                            <input type="submit" value="Ações">
                        </form>
                    </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            
    </div>

    <div class="clientes">
    <a href="<?=$BASE_URL?>cadastrarCliente.php">Cadastrar cliente</a>
            
    </div>

</body>
</html>