<?php
require 'config.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if($nome && $email && $senha){

    /*verifica se o email ja esta cadastrado*/
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();

    if($sql->rowCount() === 0){    

        $sql = $pdo->prepare("INSERT INTO usuarios (nome,email,senha) VALUES (:nome, :email, :senha)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        header("Location: index.php");
        exit;
    }else{
        header("Location: adicionar.php");
        exit;
    }
    
}else{
    header("Location: adicionar.php");
    exit;
}
