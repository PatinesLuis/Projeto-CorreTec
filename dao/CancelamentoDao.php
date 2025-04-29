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
        $cancelamento->nome_cliente = $dados['nome_cliente'];
        $cancelamento->id_seguro = $dados['id_seguro'];
        $cancelamento->id_admin = $dados['id_admin'];
        $cancelamento->motivo = $dados['motivo'];
        $cancelamento->desc_motivo = $dados['desc_motivo'];

        return $cancelamento;
    }

    public function cancelarCliente($cancelamento){
        $stmt = $this->conn->prepare("INSERT INTO cancelamentos (id_cliente, nome_cliente, id_seguro, id_admin, motivo, desc_motivo)
        VALUES (:id_cliente, :nome_cliente, :id_seguro, :id_admin, :motivo, :desc_motivo)");

        $stmt->bindParam(":id_cliente", $cancelamento->id_cliente);
        $stmt->bindParam(":nome_cliente", $cancelamento->nome_cliente);
        $stmt->bindParam(":id_seguro", $cancelamento->id_seguro);
        $stmt->bindParam(":id_admin", $cancelamento->id_admin);
        $stmt->bindParam(":motivo", $cancelamento->motivo);
        $stmt->bindParam(":desc_motivo", $cancelamento->desc_motivo);
        $stmt->execute();
    }

    public function listarCancelamentos(){
        $cancelamentos = [];
        $stmt = $this->conn->query(" SELECT 
                                            c.id,
                                            cli.id AS id_cliente,
                                            cli.nome AS nome_cliente,
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
        $stmt = $this->conn->prepare("UPDATE cancelamentos SET 
        nome_cliente = :nome_cliente, 
        id_seguro = :id_seguro, 
        id_admin = :id_admin, 
        motivo = :motivo, 
        desc_motivo = :desc_motivo
        WHERE id_cliente = :id_cliente");

    $stmt->bindParam(":nome_cliente", $cancelado->nome_cliente);
    $stmt->bindParam(":id_seguro", $cancelado->id_seguro);
    $stmt->bindParam(":id_admin", $cancelado->id_admin);
    $stmt->bindParam(":motivo", $cancelado->motivo);
    $stmt->bindParam(":desc_motivo", $cancelado->desc_motivo);
    $stmt->bindParam(":id_cliente", $cancelado->id_cliente);
    
    $stmt->execute();
    }

    public function ativarCliente($id){

        $stmt = $this->conn->prepare("DELETE FROM cancelamentos WHERE id_cliente = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function verificaClienteCancelado($id_cliente){
        $stmt = $this->conn->prepare("SELECT * FROM cancelamentos WHERE id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente);
        $stmt->execute();

        if($stmt->rowCount()> 0){
            return "existeCancelamento";
        }else{
            return "excluirCancelamento";
        }
    }


}
?>