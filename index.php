<?php
    require_once("templates/header.php");
?>


<form action="<?php $BASE_URL?>processos/login.php" method="post">
    <input type="text" name=login placeholder="login">
    <input type="password" name="senha" id="" placeholder="senha">
    <input type="submit" value="Enviar">
</form>
    
</body>
</html>