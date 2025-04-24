<?php

require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../models/cancelamentoModel.php');

class CancelamentoDao implements cancelamentoDaoInterface{

    public $conn;
    public function __construct($conn){
        $this->conn = $conn;

    }

    public function construtorCancelamento($dados){
        $cancelamento = new cancelamentoModel();

        $cancelamento->id = $dados['id'];
        $cancelamento->id_cliente = $dados['id_cliente'];
        $cancelamento->id_seguro = $dados['id_seguro'];
        $cancelamento->id_admin = $dados['id_admin'];
        $cancelamento->motivo = $dados['motivo'];
        $cancelamento->desc_motivo = $dados['desc_motivo'];

        return $cancelamento;
    }

    public function cancelarCliente($cancelamento){
        $stmt = $this->conn->prepare("INSERT INTO cancelamentos (id_cliente, id_seguro, id_admin, motivo, desc_motivo)
        VALUES (:id_cliente, :id_seguro, :id_admin, :motivo, :desc_motivo)");

        $stmt->bindParam(":id_cliente", $cancelamento->id_cliente);
        $stmt->bindParam(":id_seguro", $cancelamento->id_seguro);
        $stmt->bindParam(":id_admin", $cancelamento->id_admin);
        $stmt->bindParam(":motivo", $cancelamento->motivo);
        $stmt->bindParam(":desc_motivo", $cancelamento->desc_motivo);
        $stmt->execute();
    }

    public function listarCancelamentos(){
        $cancelamentos = [];
        $stmt = $this->conn->query(" SELECT
                                         c.id AS id, 
                                        cli.nome AS id_cliente,
                                        s.nome_seguradora AS id_seguro,
                                        a.nome AS id_admin,
                                        c.motivo,
                                        c.desc_motivo
                                        FROM cancelamentos c
                                        JOIN clientes cli ON c.id_cliente = cli.id
                                        JOIN seguros s ON c.id_seguro = s.id
                                        JOIN admins a ON c.id_admin = a.id");
        $stmt->execute();

        if($stmt->rowCount() >0){
            $listacancelamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($listacancelamentos as $cancelado){
                $cancelamentos[] = $this->construtorCancelamento($cancelado);
            }
        }

        return $cancelamentos;
    }

    public function editarCancelamento($cancelado){

    }

}
?>