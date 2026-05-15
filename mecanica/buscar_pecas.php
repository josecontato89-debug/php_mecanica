<?php 
  include 'conecta.php';
  $codigo = $_GET['codigo'];
  $sql = "SELECT * FROM pecas WHERE codigo = :codigo";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
  $stmt->execute();
  $pecas= $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($pecas);
?>