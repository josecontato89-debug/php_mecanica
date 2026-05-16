<?php
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $prioridade = $_POST['prioridade'];
    
    try {
        $sqlCheck = "SELECT COUNT(*) FROM servicos WHERE descricao=:descricao AND categoria=:categoria AND prioridade=:prioridade";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':descricao', $descricao);
        $stmtCheck->bindParam(':categoria', $categoria);
        $stmtCheck->bindParam(':prioridade', $prioridade);
        
        $stmtCheck->execute();
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>
                    alert('Serviço já existe em nosso banco de dados!');
                    history.back();
                  </script>";
        }
        else {
            $sqlInsert = "INSERT INTO servicos (descricao, categoria, prioridade)
                          VALUES (:descricao, :categoria, :prioridade)";
        
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':descricao', $descricao);
            $stmtInsert->bindParam(':categoria', $categoria);
            $stmtInsert->bindParam(':prioridade', $prioridade);
            
            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Serviços cadastrada com sucesso!');
                        window.location.href ='servicos.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Erro ao cadastrar serviços!');
                        history.back();
                      </script>";
            }
            exit();
        }
    } catch (PDOException $e) {
       echo "Erro:".$e->getMessage();
    }
}
?>