<?php
require 'config.php';

$info = [];

$id = filter_input(INPUT_GET, "id");

if($id){
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
        $info = $sql->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
    exit;
}
?>

<h1>Editar Usuário</h1>

<form action="editar_action.php" method="post">
    <input type="hidden" name="id" value="<?=$info['id']?>">

    <label>
        Nome:<br/>
        <input type="text" name="nome" value="<?=$info['nome']?>" required>
    </label><br/><br/>
    <label>
        E-mail:<br/>
        <input type="email" name="email" value="<?=$info['email']?>" required>
    </label><br/><br/>
    <label>
        Senha:<br/>
        <input type="password" name="senha" required>
    </label><br/><br/>
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
</form>