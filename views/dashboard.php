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
    $totalAtivos = $ClienteDao->totalAtivos();
    $totalInativos = $ClienteDao->totalInativos();


    $porc_ativa = $totalAtivos/$ClientesCadastrados *100;

?>

  <div class="container">
    <h1>Dashboard</h1>
    <h2>Bem-vindo <?= $_SESSION["token"]['nome'] ?></h2>

    <div class="relatorio">
         <div class="row">
          <div class="col-md-12">
            <div class="row">
            <div class="col-md-3">
              <div class="card">
                  <h4>Total de clientes</h4>
                  <div class="row">
                    <div class="col-md-6">
                    <img class="icone" src="../img/cliente.gif" alt="icone cliente">
                    </div>
                    <div class="col-md-6 ">
                    <p><?=$ClientesCadastrados?></p>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                  <h4>Total de inativos</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <img class="icone" src="../img/nao-gosto.gif" alt="Bolsa de dinheiro">
                    </div>
                    <div class="col-md-6">
                    <p><?=$totalInativos?></p>
                    </div>
                  </div>
                  
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                  <h4>Clientes ativos</h4>
                  <div class="row">
                    <div class="col-md-6">
                    <img class="icone" src="../img/ativos.gif" alt="icone ativos">
                    </div>
                    <div class="col-md-6 ">
                    <p><?=$totalAtivos?></p>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                  <h4>% de ativos</h4>
                  <div class="row">
                    <div class="col-md-6">
                    <img class="icone" src="../img/ativos.gif" alt="icone ativos">
                    </div>
                    <div class="col-md-6 ">
                    <p><?=$porc_ativa?></p>
                    </div>
                  </div>
              </div>
            </div>
            </div>
          </div>
            
         </div>
    </div>
  </div>

</body>
</html>
<?php
require_once("../templates/footer.php");
?>