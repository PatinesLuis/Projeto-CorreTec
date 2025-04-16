<?php
    require_once("../templates/header.php");

    
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

</body>
</html>