<?php
session_start();
if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso negado');
    exit;
}
// Inclui sua conexão PDO ($pdo)
include 'conecta.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados recebidos do cliente e veículo
    $nome_cliente = $_POST['nome_cliente'] ?? '';
    $cpf          = $_POST['cpf'] ?? '';
    $veiculo      = $_POST['veiculo'] ?? '';
    $placa        = $_POST['placa'] ?? '';
    // Arrays de IDs numéricos enviados pelas tabelas dinâmicas do JavaScript
    $servicos_escolhidos = $_POST['id_servicos'] ?? [];
    $pecas_escolhidas    = $_POST['id_pecas'] ?? [];
    // Valores automáticos exigidos
    $data_entrada = date('Y-m-d H:i:s'); // Data de abertura
    $status       = 0;                   // Status booleano (0 = Aberta)
    try {
        // Inicia uma transação para garantir segurança total nas gravações
        $pdo->beginTransaction();
        // 1º PASSO: Gravar primeiro na tabela 'ordens' os dados do cliente
        $sqlOrdemPrincipal = "INSERT INTO ordens (nome_cliente, cpf, veiculo, placa, data_entrada, status) 
                              VALUES (:nome, :cpf, :veiculo, :placa, :data, :status)"; 
        $stmtPrincipal = $pdo->prepare($sqlOrdemPrincipal);
        $stmtPrincipal->execute([
            ':nome'         => $nome_cliente,
            ':cpf'          => $cpf,
            ':veiculo'      => $veiculo,
            ':placa'        => $placa,
            ':data'         => $data_entrada,
            ':status'       => $status
        ]);
        // 2º PASSO: Capturar o ID recém gerado da tabela 'ordens'
        $idOrdemGerado = $pdo->lastInsertId();
        // 3º PASSO: Preparar o INSERT para a tabela 'ordem_servicos' baseado na nova imagem (id_ordem, id_servicos, id_pecas)
        $sqlItens = "INSERT INTO ordem_servicos (id_ordem, servico, pecas) 
                     VALUES (:id_ordem, :id_servicos, :id_pecas)";
        $stmtItens = $pdo->prepare($sqlItens);
        // Grava os Serviços vinculados a esta ordem
        if (!empty($servicos_escolhidos)) {
            foreach ($servicos_escolhidos as $id_servico) {
                $stmtItens->execute([
                    ':id_ordem'    => $idOrdemGerado,
                    ':id_servicos' => $id_servico,    // ID numérico do serviço
                    ':id_pecas'    => 0               // Usa 0 caso a tabela não aceite NULL
                ]);
            }
        }
        // Grava as Peças vinculadas a esta ordem
        if (!empty($pecas_escolhidas)) {
            foreach ($pecas_escolhidas as $id_peca) {
                $stmtItens->execute([
                    ':id_ordem'    => $idOrdemGerado,
                    ':id_servicos' => 0,              // Usa 0 caso a tabela não aceite NULL
                    ':id_pecas'    => $id_peca        // ID/Código numérico da peça
                ]);
            }
        }
        // Se chegou até aqui sem erros nos laços, confirma as gravações permanentemente
        $pdo->commit();
        // Redireciona de volta com mensagem de sucesso
        header('Location: ordens.php?status=sucesso&msg=Ordem de serviço aberta com sucesso!');
        exit;
    } catch (PDOException $e) {
        // Se houver qualquer erro, desfaz absolutamente tudo para não quebrar a consistência das tabelas
        $pdo->rollBack();
        // Redireciona exibindo o erro detalhado para facilitar seu teste
        header('Location: ordens.php?status=erro&msg=Erro ao registrar Ordem: ' . urlencode($e->getMessage()));
        exit;
    }
} else {
    header('Location: ordens.php');
    exit;
}