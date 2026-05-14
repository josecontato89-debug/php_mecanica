<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $descricao = $_POST['descricao'];  
    $data_entrada = $_POST['data_entrada'];
    try {
        $sqlCheck = "SELECT COUNT(*) FROM pecas WHERE nome = :nome AND marca = :marca AND modelo = :modelo";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':nome', $nome);
        $stmtCheck->bindParam(':marca', $marca);
        $stmtCheck->bindParam(':modelo', $modelo);
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Peça já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO pecas (nome, marca, modelo,descricao, data_entrada)
                          VALUES (:nome, :marca, :modelo, :descricao, :data_entrada)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':nome', $nome);
            $stmtInsert->bindParam(':marca', $marca);
            $stmtInsert->bindParam(':modelo', $modelo);
            $stmtInsert->bindParam(':descricao', $descricao);           
            $stmtInsert->bindParam(':data_entrada', $data_entrada);
            if($stmtInsert->execute()){
            echo "<script>
                        alert('Peça cadastrada com sucesso!');
                        window.location.href ='pecas.php';
                      </script>";
            }
                exit();
        }
    } catch (PDOExcepetion $e) {
       echo "Erro:".$e->getMessage();
    }
}
?>