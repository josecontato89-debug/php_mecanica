<?php
include 'conecta.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id !== false) {
        try {
            $sql = "UPDATE ordens SET status = 1, data_saida = NOW() WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "<script>alert('Ordem de Serviço fechada com sucesso!'); window.location.href='ordens.php';</script>";
                exit;
            } else {
                echo "<script>alert('Ordem de serviço com problemas!'); window.location.href='ordens.php';</script>";
                exit;
            }
        } catch (PDOException $e) {
            exit("Erro ao fechar a ordem: " . $e->getMessage());
        }
    } else {
        header("Location: index.php?erro=id_invalido");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>