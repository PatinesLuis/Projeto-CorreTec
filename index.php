<?php
    require_once("templates/header.php");
?>



<!-- <form action="<?php $BASE_URL?>processos/login.php" method="post">
    <input type="text" name=login placeholder="login">
    <input type="password" name="senha" id="" placeholder="senha">
    <input type="submit" value="Enviar">
</form> -->

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
<?php
require_once("../templates/footer.php");
?>