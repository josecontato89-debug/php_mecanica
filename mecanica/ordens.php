<?php
    session_start();
    if (!isset($_SESSION['nome'])) {
        header('Location: index.php?status=erro&msg=Acesso negado');
        exit;
    }
    $nome = $_SESSION['nome'];
    $funcao = $_SESSION['funcao'];
if($funcao != "admin"){
    header('location: mecanica.php?status=erro&msg=Acesso Negado');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-language" content="pt-br">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="imagens/logo_aba.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Mecanica</title>
        <style>
            body {
                background-color: #ddd7d7;
            }
            .header {
                float: right;
            }
            table {
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <img src="imagens/banner.png" width="650">
            <?php
                echo "<div class='header'>";
                if (isset($_SESSION['nome'])) {
                    $nome = $_SESSION['nome'];
                    echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16'>
                        <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0'/>
                        <path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1'/>
                        </svg>&nbsp;<b>".$nome."</b> | <a href='sair.php' style='color: black; text-decoration: none; font-weight: bold;'>SAIR</a>";
                }
                echo "</div>";
            ?>
        </div>
        <br/>
        <nav>
            <?php
                include 'menu.php';
            ?>
        </nav>
        <br/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <center><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><b>NOVA ORDEM DE SERVIÇO</b></button></center>
        <br/>
        <div class="row justify-content-center">
            <div class="col-md-11 mb-4">
                <div class="card shadow border-2">
                    <div class="card-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#005B74" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                        </svg>&nbsp;&nbsp;<b>ORDENS DE SERVIÇOS CADASTRADAS</b>
                    </div>
                    <div class="card-body">
                        <?php
                            include 'conecta.php';
                            $sql = "SELECT id, veiculo, placa, DATE_FORMAT(data_entrada, '%d/%m/%Y %H:%i') AS data_fentrada FROM ordens WHERE status = 0 ORDER BY data_entrada";
                            $consulta = $pdo->query($sql);
                            $listaordens = $consulta->fetchAll(PDO::FETCH_ASSOC);
                            if (count($listaordens) > 0) {
                                echo "<table class='table table-hover align-middle'>";
                                echo "<thead class='table-light'>
                                        <tr>
                                            <th>ID</th>
                                            <th>VEÍCULO</th>
                                            <th>PLACA DO CARRO</th>
                                            <th>DATA DE ENTRADA</th>
                                            <th>AÇÕES</th>
                                        </tr>
                                    </thead>";
                                echo "<tbody>";
                                foreach ($listaordens as $item) {
                                    $id = $item['id'];
                                    echo "<tr>";
                                        echo "<td>".htmlspecialchars($item['id'])."</td>";
                                        echo "<td>".htmlspecialchars($item['veiculo'])."</td>";
                                        echo "<td>".htmlspecialchars($item['placa'])."</td>";
                                        echo "<td>".htmlspecialchars($item['data_fentrada'])."</td>";
                                        echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalVisualizar' data-id='$id' title='Visualizar Ordem' class='me-1'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='green' class='bi bi-eye' viewBox='0 0 16 16'>
                                            <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z'/>
                                            <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0'/>
                                            </svg></a> | <a href='fechar_ordem.php?id=$id' title='Fechar Ordem'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='red' class='bi bi-check-square-fill' viewBox='0 0 16 16'>
                                            <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z'/>
                                            </svg></a>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            }
                            else {
                                echo "<p><font color='red'><b>NÃO EXISTE ORDENS DE SERVIÇOS CADASTRADAS NO MOMENTO!</b></font></p>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Janela Modal - Cadastro de Ordens -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#005B74" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                        </svg>&nbsp;<h5 class="modal-title" id="exampleModalLabel">NOVA ORDEM DE SERVIÇO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <form action="cadastro_ordens.php" method="POST">
                        <label class="form-label">NOME DO CLIENTE</label>
                        <input type="text" name="nome_cliente" class="form-control" required/>
                        <br/>
                        <label class="form-label">CPF</label>
                        <input type="number" name="cpf" class="form-control" required/>
                        <br/>
                        <label class="form-label">VEÍCULO</label>
                        <input type="text" name="veiculo" class="form-control" required/>
                        <br/>
                        <label class="form-label">PLACA</label>
                        <input type="text" name="placa" class="form-control" required/>
                        <br/>
                        <?php
                            // Buscar Serviços
                            $sqlServicos = "SELECT id, descricao, categoria FROM servicos ORDER BY descricao ASC";
                            $consultaServicos = $pdo->query($sqlServicos);
                            $listaServicos = $consultaServicos->fetchAll(PDO::FETCH_ASSOC);
                            // Buscar Peças
                            $sqlPecas = "SELECT codigo, nome, marca FROM pecas ORDER BY nome ASC";
                            $consultaPecas = $pdo->query($sqlPecas);
                            $listaPecas = $consultaPecas->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <hr>
                        <div class="mb-4">
                            <label class="form-label font-weight-bold"><b>ADICIONAR SERVIÇOS</b></label>
                            <div class="input-group mb-2">
                                <select id="select-servico" class="form-select">
                                    <option value="">Selecione um serviço para inserir...</option>
                                    <?php foreach ($listaServicos as $s): ?>
                                    <option value="<?= $s['id'] ?>" data-categoria="<?= htmlspecialchars($s['categoria']) ?>">
                                    <?= htmlspecialchars($s['descricao']) ?> (<?= htmlspecialchars($s['categoria']) ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" class="btn btn-primary" onclick="adicionarServicoNaTabela()">Inserir</button>
                            </div>
                            <table class="table table-sm table-bordered align-middle mt-2" id="tabela-lista-servicos">
                                <thead class="table-light">
                                    <tr>
                                        <th>Descrição do Serviço</th>
                                        <th>Categoria</th>
                                        <th style="width: 50px;" class="text-center">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="mb-4">
                            <label class="form-label font-weight-bold"><b>ADICIONAR PEÇAS</b></label>
                            <div class="input-group mb-2">
                                <select id="select-peca" class="form-select">
                                    <option value="">Selecione uma peça para inserir...</option>
                                    <?php foreach ($listaPecas as $p): ?>
                                    <option value="<?= $p['codigo'] ?>" data-marca="<?= htmlspecialchars($p['marca']) ?>">
                                    <?= htmlspecialchars($p['nome']) ?> (<?= htmlspecialchars($p['marca']) ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" class="btn btn-primary" onclick="adicionarPecaNaTabela()">Inserir</button>
                            </div>
                            <table class="table table-sm table-bordered align-middle mt-2" id="tabela-lista-pecas">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nome da Peça</th>
                                        <th>Marca</th>
                                        <th style="width: 50px;" class="text-center">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-success">CADASTRAR</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Janela Modal - Visualizar Ordem de serviço -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="modalVisualizarLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#005B74" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                    </svg><i class="bi bi-search"></i>DETALHES DA ORDEM DE SERVIÇO<span id="detalhe-id"></span></svg>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-bs-target="#modalVisualizar" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6 border-bottom pb-2">
                            <span class="text-muted d-block small uppercase fw-bold text-secondary">CLIENTE</span>
                            <span class="fs-5 text-dark" id="detalhe-cliente">---</span>
                        </div>
                        <div class="col-md-6 border-bottom pb-2">
                            <span class="text-muted d-block small uppercase fw-bold text-secondary">CPF</span>
                            <span class="fs-5 text-dark font-monospace" id="detalhe-cpf">---</span>
                        </div>
                        <div class="col-md-6 border-bottom pb-2">
                            <span class="text-muted d-block small uppercase fw-bold text-secondary">VEÍCULO</span>
                            <span class="fs-5 text-dark" id="detalhe-veiculo">---</span>
                        </div>
                        <div class="col-md-6 border-bottom pb-2">
                            <span class="text-muted d-block small uppercase fw-bold text-secondary">PLACA</span>
                            <span class="fs-5 text-dark" id="detalhe-placa">---</span>
                        </div>
                        <div class="col-md-6 border-bottom pb-2">
                            <span class="text-muted d-block small uppercase fw-bold text-secondary">DATA DE ENTRADA</span>
                            <span class="fs-5 text-dark" id="detalhe-entrada">---</span>
                        </div>
                    <div class="col-12 mt-4">
                        <h6 class="text-secondary fw-bold mb-3">SERVIÇOS REALIZADOS</h6>
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>DESCRIÇÃO</th>
                                    <th>CATEGORIA</th>
                                    <th>PRIORIDADE</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-servicos-modal">
                                <tr>
                                    <td colspan="3" class="text-muted text-center">A carregar serviços...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-4">
                        <h6 class="text-secondary fw-bold mb-3">PEÇAS UTILIZADAS</h6>
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>NOME DA PEÇA</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-pecas-modal">
                                <tr><td colspan="3" class="text-muted text-center">A carregar peças...</td></tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('modalVisualizar').addEventListener('show.bs.modal', function(event){
    let button = event.relatedTarget;
    let id = button.getAttribute('data-id');
    
    fetch('buscar_ordem.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            // Preenche os dados gerais da ordem
            document.getElementById('detalhe-id').textContent = ' #' + data.id;
            document.getElementById('detalhe-cliente').textContent = data.nome_cliente;
            document.getElementById('detalhe-cpf').textContent = data.cpf;
            document.getElementById('detalhe-veiculo').textContent = data.veiculo;
            document.getElementById('detalhe-placa').textContent = data.placa;
            document.getElementById('detalhe-entrada').textContent = data.data_entrada;

            // --- 1. Preencher a Tabela de Serviços ---
            const tabelaServicos = document.getElementById('tabela-servicos-modal');
            tabelaServicos.innerHTML = ""; 

            if (data.servicos && data.servicos.length > 0) {
                data.servicos.forEach(servico => {
                    let linha = document.createElement('tr');
                    linha.innerHTML = `
                        <td>${servico.descricao}</td>
                        <td>${servico.categoria}</td>
                        <td>${servico.prioridade}</td>
                    `;
                    tabelaServicos.appendChild(linha);
                });
            } else {
                tabelaServicos.innerHTML = `<tr><td colspan="3" class="text-muted text-center">Nenhum serviço registado para esta ordem.</td></tr>`;
            }

            // --- 2. NOVA LÓGICA: Preencher a Tabela de Peças ---
            const tabelaPecas = document.getElementById('tabela-pecas-modal');
            tabelaPecas.innerHTML = ""; // Limpa consultas anteriores

            if (data.pecas && data.pecas.length > 0) {
                data.pecas.forEach(peca => {
                    let linha = document.createElement('tr');
                    linha.innerHTML = `
                        <td>${peca.nome}</td>
                        <td>${peca.marca}</td>
                        <td>${peca.modelo}</td>
                    `;
                    tabelaPecas.appendChild(linha);
                });
            } else {
                tabelaPecas.innerHTML = `<tr><td colspan="3" class="text-muted text-center">Nenhuma peça utilizada nesta ordem.</td></tr>`;
            }
        })
        .catch(error => {
            console.error('Erro ao buscar os detalhes:', error);
        });
});
    </script>
    <script>
        function adicionarServicoNaTabela() {
            const select = document.getElementById('select-servico');
            const serviceId = select.value; // Coleta o ID numérico (Ex: 1, 2, 3...)
            const optionSelecionada = select.options[select.selectedIndex];
            if (!serviceId) {
                alert('Por favor, selecione um serviço antes de inserir.');
            return;
            }
            const descricao = optionSelecionada.text;
            const categoria = optionSelecionada.getAttribute('data-categoria') || 'Sem Categoria'
            const tabelaBody = document.getElementById('tabela-lista-servicos').getElementsByTagName('tbody')[0]; 
            // Evita duplicados na tabela visual antes de enviar
            if (tabelaBody.querySelectorAll(`input[value="${serviceId}"]`).length > 0) {
                alert('Este serviço já foi adicionado.');
                return;
            }
            const novaLinha = tabelaBody.insertRow();
            novaLinha.innerHTML = `
            <td>
                <input type="hidden" name="id_servicos[]" value="${serviceId}">
                ${descricao}
            </td>
            <td>
            ${categoria}
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">-</button>
            </td>
            `;
            select.value = '';
        }

    function adicionarPecaNaTabela() {
        const select = document.getElementById('select-peca');
        const pecaCodigo = select.value; // Coleta o Código numérico da peça
        const optionSelecionada = select.options[select.selectedIndex];
        if (!pecaCodigo) {
            alert('Por favor, selecione uma peça antes de inserir.');
            return;
        }
        const nome = optionSelecionada.text;
        const marca = optionSelecionada.getAttribute('data-marca') || 'Sem Marca'
        const tabelaBody = document.getElementById('tabela-lista-pecas').getElementsByTagName('tbody')[0];
        if (tabelaBody.querySelectorAll(`input[value="${pecaCodigo}"]`).length > 0) {
            alert('Esta peça já foi adicionada.');
            return;
        }
        const novaLinha = tabelaBody.insertRow();
        novaLinha.innerHTML = `
        <td>
            <input type="hidden" name="id_pecas[]" value="${pecaCodigo}">
            ${nome}
        </td>
        <td>
            ${marca}
            </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">-</button>
        </td>
    `;
    select.value = '';
    }
    </script>
    </body>
</html>