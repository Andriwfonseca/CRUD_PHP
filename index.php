<?php 
require 'config.php';
?>
<a href="adicionar.php">ADICIONAR USUÁRIO</a>
<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>E-MAIL</th>
        <th>AÇÕES</th>
    </tr>
    <?php
    $sql = "SELECT * FROM usuarios";
    $sql = $pdo->query($sql);
    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $usuario){
            echo '<tr>';
            echo '<td>'.$usuario['id'].'</td>';
            echo '<td>'.$usuario['nome'].'</td>';
            echo '<td>'.$usuario['email'].'</td>';
            echo '<td><a href="editar.php?id='.$usuario['id'].'">Editar</a> - <a href="excluir.php?id='.$usuario['id'].'">Excluir</a></td>';
            echo '</tr>';
        }
    } 
    ?>
</table>