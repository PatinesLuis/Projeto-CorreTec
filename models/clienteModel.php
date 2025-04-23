<?php

    class clienteModel {

        public $id;
        public $nome;
        public $nascimento;
        public $rua;
        public $numero;
        public $complemento;
        public $bairro;
        public $cidade;
        public $estado;
        public $cep;
        public $data_contratacao;
        public $data_encerramento;
        public $id_seguro;
        public $status;


        public function retornaStatus($status){
            if($status == 1){
                return "ATIVOS";
            }else{
                return "INATIVO";
            }
        }

    }

    interface clienteDaoInterface{
        public function construirCliente($dados);
        public function criarCliente($cliente);
        public function editarCliente($id);
        public function excluirCLiente($id);
        public function listarClientes();
        public function procurarCLiente($dado);
        public function totalClientes();
        public function totalPremios();
        public function totalAtivos();
        public function totalInativos();
    }

?>