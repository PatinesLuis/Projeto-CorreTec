<?php

class seguroModel{

    public $id;
    public $nome_seguradora;
    public $premio;
    public $capital;
    public $tipo_seguro;
    public $id_admin;
}


interface seguroDaoInterface{
    public function construirSeguro($seguro);
    public function criarSeguro($seguro);
    public function editarSeguro($idSeguro);
    public function excluirSeguro($idSeguro);

}