<?php
    require_once(__DIR__ . '/../config/db.php');
    require_once(__DIR__ . '/../config/globals.php');
    require_once(__DIR__ . '/../dao/AdminDao.php');
    $adminDao = new AdminDao($conn);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,300;1,300&family=Special+Gothic&display=swap" rel="stylesheet">

    <!-- CSS -->
     <link rel="stylesheet" href="<?=$BASE_URL?>/style/style.css">
     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    
    <title>CorreTec</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=$BASE_URL?>/views/dashboard.php">Corretec</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=$BASE_URL?>/views/dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$BASE_URL?>/views/centralseguro.php">Seguros</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Clientes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=$BASE_URL?>/views/centralClientes.php">Central de clientes</a></li>
            <li><a class="dropdown-item" href="<?=$BASE_URL?>/views/cadastrarCliente.php">Cadastrar clientes</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$BASE_URL?>/processos/deslogar.php">Sair</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="procurar cliente" aria-label="Search">
        <button class="btn btn-dark" type="submit">procurar</button>
      </form>
    </div>
  </div>
</nav>
<?php
require_once(__DIR__ . '/../templates/mensagem.php');
?>