<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");

    $seguroDao = new SeguroDao($conn);
    
    $listaSeguros = $seguroDao->listarSeguros();
    
    $verificaSessao = $adminDao->verificaSessao();

?>

    <h1>Criar seguro</h1>
    <h2>Bem-vindo <?= $_SESSION["token"]['nome'] ?></h2>
    <a href="../views/dashboard.php" class="nav-link"> voltar</a>

    <form action="../processos/processoSeguros.php" method="post">
        <input type="hidden" name="tipo"  value="criar">
        <input type="text" placeholder="nome da seguradora" name="nome_seguradora">
        <input type="text" placeholder="premio do seguro" name="premio">
        <input type="text" placeholder="capital segurado" name="capital">
        <input type="text" placeholder="tipo do seguro" name="tipo_seguro">
        <button>Enviar</button>
    </form>

    <div class="lista seguros">
            <table border=1>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>SEGURADORA</th>
                    <th>PRÊMIO</th>
                    <th>CAPITAL</th>
                    <th>TIPO DO SEGURO</th>
                    <th>OPÇÕES</th>
                    </tr>     
                </thead>
                <tbody>
                <?php foreach($listaSeguros as $seguro):?>
                    <tr>
                    <td><?=$seguro->id?></td>
                    <td><?=$seguro->nome_seguradora?></td>
                    <td><?=$seguro->premio?></td>
                    <td><?=$seguro->capital?></td>
                    <td><?=$seguro->tipo_seguro?></td>
                    <td>
                        <form action="../processos/processoSeguros.php" method="post">
                            <input type="hidden" name="id" value="<?=$seguro->id?>">
                            <input type="hidden" name="tipo"  value="deletar">
                            <button>Deletar</button>
                        </form>

                        <button class="editar-btn">editar</button>
                    </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

            <table>
            <table border=1>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>SEGURADORA</th>
                    <th>PRÊMIO</th>
                    <th>CAPITAL</th>
                    <th>TIPO DO SEGURO</th>
                    <th>OPÇÕES</th>
                    </tr>     
                </thead>
                <tbody>
                    <tr">
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
            </table>
            
    </div>


    <script src="script.js"></script>
</body>
</html>