<?php

class adminModel {

    public $id;
    public $nome;
    public $cargo;
    public $login;
    public $senha;
    public $token;

}

interface adminDaoInterface{
    public function construtorAdmin($admin);
    public function verificaSessao();
    public function verificaLogin($login, $senha);
    public function deslogarUsuario();
}