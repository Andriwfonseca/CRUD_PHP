<?php
require 'config.php';

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if($id && $nome && $email && $senha){

    /*verifica se o email ja esta cadastrado*/
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email and id != :id");
    $sql->bindValue(':id', $id);
    $sql->bindValue(':email', $email);
    $sql->execute();

    if($sql->rowCount() === 0){    

        $sql = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        header("Location: index.php");
        exit;
    }else{
        header("Location: editar.php?id=".$id);
        exit;
    }
    
}else{
    header("Location: index.php");
    exit;
}
