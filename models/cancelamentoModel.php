<?php

class cancelamentoModel{
    public $id;
    public $id_cliente;
    public $nome_cliente;
    public $id_seguro;
    public $id_admin;
    public $motivo;
    public $desc_motivo;

}

interface cancelamentoDaoInterface{
    public function construtorCancelamento($dados);
    public function cancelarCliente($dados);
    public function editarCancelamento($dados);
}