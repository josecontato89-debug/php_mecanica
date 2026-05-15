<?php
   include 'conecta.php';
   $codigo = $_POST['codigo'];
   $nome = $_POST['nome'];
   $marca = $_POST['marca'];
   $modelo = $_POST['modelo'];
   $descricao = $_POST['descricao'];
   $data_entrada = $_POST['data_entrada'];
   $sql = "UPDATE pecas SET nome=:nome,marca=:marca,modelo=:modelo,descricao=:descricao,data_entrada=:data_entrada WHERE codigo=:codigo";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':codigo',$codigo);
   $stmt->bindParam(':nome',$nome);
   $stmt->bindParam(':marca',$marca);
   $stmt->bindParam(':modelo',$modelo);
   $stmt->bindParam(':descricao',$descricao);
   $stmt->bindParam(':data_entrada',$data_entrada);
   $stmt->execute();
   header("location: pecas.php");
?>