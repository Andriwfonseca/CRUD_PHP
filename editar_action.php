<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if($id && $nome && $email && $senha){

    $u = $usuarioDao->findByEmail($email);

    $usuario = $usuarioDao->findById($id);

    /*validação email duplicado*/
    if($u === false || $usuario->getEmail() == $email){

        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha(md5($senha));
    
        $usuarioDao->update($usuario);    
    }else{
        header("Location: editar.php?id=".$id);
        exit;
    }    
}
header("Location: index.php");
exit;