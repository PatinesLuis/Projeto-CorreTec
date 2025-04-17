<?php

$msg = "";

//sucessos

if(isset($_GET["sucesso"])){
    $sucesso = $_GET["sucesso"];

    if($sucesso == 1){
        $msg = "Seguro criado com sucesso";
    }else if($sucesso == 2){
        $msg = "Seguro excluido com sucesso!";
    }
}

//erros
    if(isset($_GET["erro"])){
        $erro = $_GET["erro"];

        if($erro == 1){
            $msg = "Login ou senha invalidos";
        }else if($erro == 2){
            $msg = "Você precisa estár logado para acessar está pagina!";
        }else if($erro == 3){
            $msg = "Você precisa preencher todos os campos";
        }else if($erro == 4){
            $msg = "Este seguro está associado a 1 ou mais clientes";
        }
    }

//deslogar
if(isset($_GET["logout"])){
    $erro = $_GET["logout"];

    if($erro = 1){
        $msg = "deslogado com sucesso";
    }
}

?>

<div class="mensagem">
    <p><?=$msg?></p>
</div>