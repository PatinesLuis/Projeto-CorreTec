<?php
    require_once(__DIR__ . '/../config/db.php');
    require_once(__DIR__ . '/../models/adminModel.php');
    

Class adminDao implements adminDaoInterface{
    

    public $conn;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    public function construtorAdmin($admin){
        $adminModel = new AdminModel();

        $adminModel->id = $admin["id"];
        $adminModel->nome = $admin["nome"];
        $adminModel->cargo = $admin["cargo"];
        $adminModel->login = $admin["login"];
        $adminModel->senha = $admin["senha"];
        $adminModel->token = $admin["token"];

        return $adminModel;
    }
    public function verificaSessao(){
        
        if(!isset($_SESSION['token']) || empty($_SESSION['token'])){
            header("Location: ../index.php?erro=2");
        }
    }

    public function verificaLogin($login, $senha){

        if(!empty($login) && !empty($senha)){
            $stmt = $this->conn->prepare("SELECT * FROM admins WHERE login = :login AND senha = :senha");
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":senha", $senha);  
            $stmt->execute();
            
            if($stmt->rowCount() > 0) {
                $adminRetornoBanco = $stmt->fetch();
                $adminLogado = $this->construtorAdmin($adminRetornoBanco);

                $_SESSION['token'] = [
                    'id' => $adminLogado->id,
                    'nome' => $adminLogado->nome,
                    'cargo' => $adminLogado->cargo,
                    'login' => $adminLogado->login,
                    'token' => $adminLogado->token
                ];
                return $_SESSION['token'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    
    }

    public function deslogarUsuario(){

        //limpar dados da seção
        $_SESSION = [];
        session_destroy();

        //remove cookies da seção
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        header("Location: ../index.php?logout=1");

    }
}
