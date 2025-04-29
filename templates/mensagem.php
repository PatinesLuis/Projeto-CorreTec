<?php

$msg = "";

//sucessos

if(isset($_GET["sucesso"])){
    $sucesso = $_GET["sucesso"];
    $estiloMensagem = "sucesso";

    if($sucesso == 1){
        $msg = "Seguro criado com sucesso";
    }else if($sucesso == 2){
        $msg = "Seguro excluido com sucesso!";
    }else if($sucesso == 3){
        $msg = "Cliente criado com sucesso!";
    }else if($sucesso == 4){
        $msg = "Cliente editado com sucesso!";
    }
    else if($sucesso == 5){
        $msg = "Cliente excluido com sucesso!";
    }
}

//erros
    if(isset($_GET["erro"])){
        $erro = $_GET["erro"];
        $estiloMensagem = "erro";

        if($erro == 1){
            $msg = "Login ou senha invalidos";
        }else if($erro == 2){
            $msg = "Você precisa estár logado para acessar está pagina!";
        }else if($erro == 3){
            $msg = "Você precisa preencher todos os campos";
        }else if($erro == 4){
            $msg = "Este seguro está associado a 1 ou mais clientes";
        }else if($erro == 5){
            $msg = "Os campos NOME - DATA DE NASCIMENTO são obrigatórios";
        }else if($erro == 6){
            $msg = "Os campos NOME - AS DATAS - STATUS - SEGURO são obrigatórios";
        }
    }

//cancelamentos

if(isset($_GET["cancelamento"])){
    $cancelamento = $_GET["cancelamento"];
    $estiloMensagem = "alerta";

    if($cancelamento == 1){
        $msg = "Cliente cancelado!";
        
    }else if($cancelamento == 2){
        $msg = "Cliente cancelado editado";
    }
}

//deslogar
if(isset($_GET["logout"])){
    $erro = $_GET["logout"];
    $estiloMensagem = "deslogar";

    if($erro = 1){
        $msg = "deslogado com sucesso";
    }
}

?>

<div id="mensagem" class="mensagem">
    <p class="<?=$estiloMensagem?>"><?=$msg?></p>
</div>