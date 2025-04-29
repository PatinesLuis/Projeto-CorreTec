<?php
    require_once("templates/header.php");
?>
<div class="container">
<h1 class="titulo-login">Entrar</h1>
<form class="formulario-Login" action="<?= $BASE_URL ?>/processos/login.php" method="post">
  <div class="mb-3">
    <label for="login" class="form-label">Login de usuário</label>
    <input type="text" class="form-control" id="login" name="login">
    <div id="loginHelp" class="form-text">Insira o login fornecido pelo administrador do sistema</div>
  </div>
  <div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha">
  </div>
  <button type="submit" class="btn btn-primary">Entrar</button>
</form>
</div>


    
</body>
</html>