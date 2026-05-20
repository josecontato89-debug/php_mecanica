<?php
include 'conecta.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // 1. Busca os dados gerais da ordem
    $sqlOrdem = "SELECT id, nome_cliente, cpf, veiculo, placa, DATE_FORMAT(data_entrada, '%d/%m/%Y %H:%i') AS data_entrada, status FROM ordens WHERE id = ?";
    $stmt = $pdo->prepare($sqlOrdem);
    $stmt->execute([$id]);
    $ordem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ordem) {
        // 2. Busca os serviços relacionados
        $sqlServicos = "SELECT s.descricao, s.categoria, s.prioridade 
                        FROM ordem_servicos AS os 
                        INNER JOIN servicos AS s ON os.servico = s.id 
                        WHERE os.id_ordem = ?";
        $stmtServicos = $pdo->prepare($sqlServicos);
        $stmtServicos->execute([$id]);
        $ordem['servicos'] = $stmtServicos->fetchAll(PDO::FETCH_ASSOC);

        // 3. NOVA QUERY: Busca as peças utilizadas através do INNER JOIN
        // Vincula o campo relacional 'os.pecas' com a chave primária 'p.codigo'
        $sqlPecas = "SELECT p.nome, p.marca, p.modelo 
                     FROM ordem_servicos AS os 
                     INNER JOIN pecas AS p ON os.pecas = p.codigo 
                     WHERE os.id_ordem = ?";
        $stmtPecas = $pdo->prepare($sqlPecas);
        $stmtPecas->execute([$id]);
        $ordem['pecas'] = $stmtPecas->fetchAll(PDO::FETCH_ASSOC);

        // 4. Envia tudo encapsulado num único objeto JSON
        header('Content-Type: application/json');
        echo json_encode($ordem);
        exit;
    }
}

echo json_encode(["erro" => "Ordem não encontrada"]);
?>