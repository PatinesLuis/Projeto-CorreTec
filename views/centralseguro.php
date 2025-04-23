<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");

    $seguroDao = new SeguroDao($conn);
    
    $listaSeguros = $seguroDao->listarSeguros();
    
    $verificaSessao = $adminDao->verificaSessao();

?>

    <div class="container">
    <h1>Central dos seguros</h1>
    <h2>Usuário logado  <?= $_SESSION["token"]['nome'] ?></h2>

    <form class="form-seguro" action="../processos/processoSeguros.php" method="post">
        <input type="hidden" name="tipo"  value="criar">
        <div class="d-flex align-items-center mb-3">
            <label for="nome_seguradora">Nome da seguradora</label>
            <input type="text" id="nome_seguradora" class="form-control" placeholder="nome da seguradora" name="nome_seguradora">
        </div>
        <div class="d-flex align-items-center mb-3">
        <label for="premio">Prêmio do seguro</label>
        <input type="text" id="premio" class="form-control" placeholder="69,90   99,80   100,00" name="premio">
        </div>
        <div class="d-flex align-items-center mb-3">
        <label for="capital">capital do seguro</label>
        <input type="text" id="capital" class="form-control" placeholder="50000  100000 (sem ponto, virgula apenas para centavos)" name="capital">
        </div>
        <div class="d-flex align-items-center mb-3">
        <label for="tipo_seguro">Qual o tipo de seguro</label>
        <input type="text" id="tipo_seguro" class="form-control" placeholder="vida, residencial, automovel, acidentes pessoais?" name="tipo_seguro">
        </div>
        <button type="submit" class="btn btn-success">Success</button>
    </form>

    <div class="lista_seguros">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">SEGURADORA</th>
                    <th scope="col">PRÊMIO</th>
                    <th scope="col">CAPITAL</th>
                    <th scope="col">TIPO DO SEGURO</th>
                    <th scope="col">OPÇÕES</th>
                    </tr>     
                </thead>
                <tbody>
                <?php foreach($listaSeguros as $seguro):?>
                    <tr scope="row">
                    <td><?=$seguro->id?></td>
                    <td><?=$seguro->nome_seguradora?></td>
                    <td><?=$seguro->premio?></td>
                    <td><?=$seguro->capital?></td>
                    <td><?=$seguro->tipo_seguro?></td>
                    <td>
                    <div class="d-flex gap-2">
                        <form action="../processos/processoSeguros.php" method="post">
                            <input type="hidden" name="id" value="<?=$seguro->id?>">
                            <input type="hidden" name="tipo"  value="deletar">
                            <button class="btn btn-danger btn-sm">Deletar</button>
                        </form>

                        <button class="btn btn-primary btn-sm editar-btn">Editar</button>
    </div>
                    </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            
    </div>
    </div>

</body>
</html>
<?php
require_once("../templates/footer.php");
?>