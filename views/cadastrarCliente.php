<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");

    $seguroDao = new SeguroDao($conn);
    
    $listaSeguros = $seguroDao->listarSeguros();
    
    $verificaSessao = $adminDao->verificaSessao();

?>

    <h1>Cadastrar Clientes</h1>
    <h2>Usuário logado <?= $_SESSION["token"]['nome'] ?></h2>
    <a href="<?=$BASE_URL?>centralseguro.php">Criar seguro</a>
    <a href="<?=$BASE_URL?>centralClientes.php">Clientes</a>

    <form action="../processos/processoSeguros.php" method="post">
        <input type="text" placeholder="Digite o nome" name="nome">
        <input type="date" placeholder="Digite a idade" name="nascimento">
        <input type="text" placeholder="Digite a rua" name="rua">
        <input type="text" placeholder="Digite o numero" name="numero">
        <input type="text" placeholder="Digite o complemento" name="complemento">
        <input type="text" placeholder="Digite o bairro" name="bairro">
        <input type="text" placeholder="Digite o cidade" name="cidade">
        <input type="text" placeholder="Digite o estado" name="estado">
        <select name="id_seguro" id="">
            <?php foreach($listaSeguros as $seguro): ?>
                <option value="<?= $seguro->id?>"><?= $seguro->nome_seguradora?></option>
            <?php endforeach;?>
        </select>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>