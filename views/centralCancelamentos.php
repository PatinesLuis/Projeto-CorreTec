<?php
    require_once(__DIR__ .'/../templates/header.php');
    require_once(__DIR__ .'/../dao/SeguroDao.php');
    require_once(__DIR__ .'/../dao/ClienteDao.php');
    require_once(__DIR__ .'/../models/clienteModel.php');

    $seguroDao = new SeguroDao($conn);
    $clientesDao = new clienteDao($conn);
    $clienteModel = new clienteModel();

    require_once('../models/cancelamentoModel.php');
    require_once("../dao/CancelamentoDao.php");

 

    $cancelamentoDao = new CancelamentoDao($conn);
    $clientes = $cancelamentoDao->listarCancelamentos();

    $verificaSessao = $adminDao->verificaSessao();

?>

    <div class="container">
    <h1>Central dos CANCELAMENTOS</h1>

        <table class="table listaClientes">
            <thead>
                <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Seguro</th>
                <th scope="col">Usuário</th>
                <th scope="col">Motivo</th>
                <th scope="col">Descrição do cancelamento</th>
                <th scope="col">-</th>
                </tr>     
            </thead>
            <tbody>
            <?php foreach($clientes as $cliente):?>
                <tr>
                <td><?=$cliente->nome_cliente?></td>
                <td><?=$cliente->id_seguro?></td>
                <td><?=$cliente->id_admin?></td>
                <td><?=$cliente->motivo?></td>
                <td><?=$cliente->desc_motivo?></td>
                <td>
                <form action="acoesCliente.php" method="GET">

                
                        <input type="hidden" name="id" value="<?=$cliente->id_cliente?>">
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
<?php
require_once("../templates/footer.php");
?>