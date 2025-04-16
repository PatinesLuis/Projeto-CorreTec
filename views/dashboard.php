<?php
    require_once("../templates/header.php");

    
    $verificaSessao = $adminDao->verificaSessao();

    echo "<pre>";
print_r($_SESSION["token"]);
echo "</pre>";
?>

    <h1>Dashboard</h1>
    <h2>Bem-vindo <?= $_SESSION["token"]['nome'] ?></h2>
    <a href="../processos/deslogar.php" class="nav-link"> Sair</a>
    <a href="<?=$BASE_URL?>novoseguro.php">Criar seguro</a>

</body>
</html>