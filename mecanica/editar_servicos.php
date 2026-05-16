<?php
   include 'conecta.php';
   $id = $_POST['id'];
   $descricao = $_POST['descricao'];
   $categoria = $_POST['categoria'];
   $prioridade = $_POST['prioridade'];
   
   $sql = "UPDATE servicos SET descricao=:descricao, categoria=:categoria, prioridade=:prioridade WHERE id=:id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id',$id);
   $stmt->bindParam(':descricao',$descricao);
   $stmt->bindParam(':categoria',$categoria);
   $stmt->bindParam(':prioridade',$prioridade);
   
   $stmt->execute();
   header("location: servicos.php");
?>