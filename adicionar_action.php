<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if($nome && $email && $senha){

    if($usuarioDao->findByEmail($email) === false){
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($nome);
        $novoUsuario->setEmail($email);
        $novoUsuario->setSenha(md5($senha));  
        
        $usuarioDao->add($novoUsuario);

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
