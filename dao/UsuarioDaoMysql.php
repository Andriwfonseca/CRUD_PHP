<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDao{
 
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function add(Usuario $usuario){

        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $sql->bindValue(":nome", $usuario->getNome());
        $sql->bindValue(":email", $usuario->getEmail());
        $sql->bindValue(":senha", $usuario->getSenha());
        $sql->execute();

        $usuario->setId($this->pdo->lastInsertId());

        return $usuario;
    }
    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $usuario = new Usuario();
                $usuario->setId($item['id']);
                $usuario->setNome($item['nome']);
                $usuario->setEmail($item['email']);
                

                $array[] = $usuario;            }
        }

        return $array;
    }
    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $usuario = new Usuario();
            $usuario->setId($data['id']);
            $usuario->setNome($data['nome']);
            $usuario->setEmail($data['email']);
            

            return $usuario;  

        }else{
            return false;
        }
           
    }
    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $usuario = new Usuario();
            $usuario->setId($data['id']);
            $usuario->setNome($data['nome']);
            $usuario->setEmail($data['email']);
            

            return $usuario;  

        }else{
            return false;
        }
    }
    public function update(Usuario $usuario){
        $sql = $this->pdo->prepare("UPDATE usuarios set nome = :nome, email = :email, senha = :senha WHERE id = :id");
        $sql->bindValue(":nome", $usuario->getNome());
        $sql->bindValue(":email", $usuario->getEmail());
        $sql->bindValue(":senha", $usuario->getSenha());
        $sql->bindValue(":id", $usuario->getId());
        $sql->execute();
        return true;
    }
    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}