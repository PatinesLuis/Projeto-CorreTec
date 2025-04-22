<?php
    require_once("../templates/header.php");
    $verificaSessao = $adminDao->verificaSessao();

    require_once("../dao/seguroDao.php");
    $seguroDao = new SeguroDao($conn);
    require_once("../dao/ClienteDao.php");
    $ClienteDao = new ClienteDao($conn);

    // relatório
    $ClientesCadastrados = $ClienteDao->totalClientes();
    $totalPremios = $ClienteDao->totalPremios();

?>

  <div class="container">
    <h1>Dashboard</h1>
    <h2>Bem-vindo <?= $_SESSION["token"]['nome'] ?></h2>

    <div class="relatorio">
         <div class="row">
            <div class="col-md-4">
              <div class="card">
                  <h4>Total de clientes</h4>
                  <p><?=$ClientesCadastrados?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                  <h4>Total de valor</h4>
                  <p><?=$totalPremios?></p>
              </div>
            </div>
            
         </div>
    </div>
  </div>

</body>
</html>