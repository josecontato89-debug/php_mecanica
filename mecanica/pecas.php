<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header('Location: index.php?status=erro&msg=Acesso Negado');
    exit();
}

$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="Imagens/teacher.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Mecânica</title>

    <style>
        body {
            background-color:
        }

        .header {
            float: right;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="container-fluid" style="background-color:#DCDCDC; text-align:center; position:relative;">
    <img src="imagens/banner.png" alt="Logo">

    <div class="header" style="position:absolute; top:10px; right:10px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
</svg>

        <b><?= htmlspecialchars($nome) ?></b> |
        <a href="sair.php" style="color:black; text-decoration:none; font-weight:bold;">SAIR</a>
    </div>
</div>
<br/>
        <nav>
            <?php
                include 'menu.php';
            ?>
        </nav>

<!-- BOTÃO -->
<div class="text-center my-3">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        CADASTRAR PEÇAS
    </button>
</div>

<!-- TABELA -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

            <div class="card shadow border-2">
                <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
  <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z"/>
</svg>

                    <b>PEÇAS CADASTRADAS</b>
                </div>

                <div class="card-body">

                    <?php
                    include 'conecta.php';

                    $sql = "SELECT codigo,nome,marca,modelo,descricao,DATE_FORMAT(data_entrada,'%d/%m/%Y') AS data_entrada FROM pecas ORDER BY nome;";
                    $consulta = $pdo->query($sql);
                    $listapecas = $consulta->fetchAll(PDO::FETCH_ASSOC);

                    if (count($listapecas) > 0) {

                        echo "<table class='table table-hover align-middle'>";
                        echo "<thead class='table-light'>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>NOME</th>
                                    <th>MARCA</th>
                                    <th>MODELO</th>
                                    <th>DESCRIÇÃO</th>                                  
                                    <th>DATA DE ENTRADA</th>
                                </tr>
                              </thead>";

                        echo "<tbody>";

                        foreach ($listapecas as $item) {
                            $codigo = $item['codigo'];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['codigo']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['data_entrada']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['descricao']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['marca']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['modelo']) . "</td>";
                            echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalEditar' data-id='$codigo'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eraser-fill' viewBox='0 0 16 16'>
                            <path d='M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z'/>
                          </svg></a> | <a href ='excluir.php?id=$codigo'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                          </svg></a></td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";

                    } else {
                        echo "<p class='text-danger'><b>NÃO EXISTEM PEÇAS CADASTRADAS NO MOMENTO!</b></p>";
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title">CADASTRO DE PEÇAS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="cadastro_pecas.php" method="POST">
                <label class="form-label">NOME</label>
                <input type="text" name="nome" class="form-control" required/>
                <br/> 
                <label class="form-label">MARCA</label>
                <input type="text" name="marca" class="form-control" required/>
                <br/> 
                <label class="form-label">MODELO</label>
                <input type="text" name="modelo" class="form-control" required/>
                <br/> 
                <label class="form-label">DESCRIÇÃO</label>
                <input type="text" name="descricao" class="form-control" required/>
                <br/>                
                <label class="form-label">DATA DE ENTRADA</label>
                <input type="date" name="data_entrada" class="form-control" required/>                
                <br/> 
                <button type="submit" class="btn btn-outline-success">CADASTRAR </button>    
                </form>
            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
                
            </div>

        </div>

    </div>
</div>
<!-- Janela modal - editar pessoas-->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg>&nbsp; &nbsp; <h5 class="modal-title" id="modalEditar">EDIÇÃO DE PEÇAS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <div class="modal-body">
           <form action="editar_pecas.php" method="POST">
            <input type="hidden" id="edit_id" name="id"/>
            <form action="cadastro_pecas.php" method="POST">
                <label class="form-label">NOME</label>
                <input type="text" name="nome" class="form-control" required/>
                <br/> 
                <label class="form-label">MARCA</label>
                <input type="text" name="marca" class="form-control" required/>
                <br/> 
                <label class="form-label">MODELO</label>
                <input type="text" name="modelo" class="form-control" required/>
                <br/> 
                <label class="form-label">DESCRIÇÃO</label>
                <input type="text" name="descricao" class="form-control" required/>
                <br/>                
                <label class="form-label">DATA DE ENTRADA</label>
                <input type="date" name="data_entrada" class="form-control" required/>                
                <br/> 
                <button type="submit" class="btn btn-outline-success">CADASTRAR </button>    
                </form>
                <button type="submit" class="btn btn-outline-success">ATUALIZAR </button>    
                </form>       
           </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
       
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('modalEditar').addEventListener('show.bs.modal', function(event){
        let button = event.relatedTarget;
        let id =button.getAttribute('data-id');
        fetch('buscar_pecas.php?id=' +id)
           .then(response=>response.json())
           .then(data=>{
               document.getElementById('edit_codigo').value = data.codigo;
               document.getElementById('edit_nome').value = data.nome;
               document.getElementById('edit_data_entrada').value = data.data_entrada;
               document.getElementById('edit_descricao').value = data.descricao;
               document.getElementById('edit_marca').value = data.marca;
               document.getElementById('edit_modelo').value = data.modelo;
           });
    })
</script>
</body>
</html>