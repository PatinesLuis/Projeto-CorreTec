<?php
    require_once("../templates/header.php");
    require_once("../dao/seguroDao.php");

    $seguroDao = new SeguroDao($conn);
    
    
    $listaSeguros = $seguroDao->listarSeguros();
    
    $verificaSessao = $adminDao->verificaSessao();

?>

    <h1>Central dos seguros</h1>

    </form>

    <div class="clientes">
    <a href="<?=$BASE_URL?>cadastrarCliente.php">Cadastrar cliente</a>
            
    </div>

</body>
</html>