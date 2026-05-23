<?php
// 1. Incluir a conexão com o banco de dados
require_once 'conecta.php';

try {
    // 2. Executar a query do mês corrente por prioridade
    $sql = "SELECT s.prioridade, COUNT(os.id) AS total 
            FROM ordem_servicos os 
            INNER JOIN servicos s ON os.servico = s.id 
            INNER JOIN ordens o ON os.id_ordem = o.id
            WHERE MONTH(o.data_entrada) = MONTH(NOW()) 
              AND YEAR(o.data_entrada) = YEAR(NOW())
            GROUP BY s.prioridade";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Guardar todos os dados na variável $resultados
    $resultados = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Prioridades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Prioridade');
        data.addColumn('number', 'Quantidade');
        
        // Aqui o PHP injeta os dados dinamicamente!
        data.addRows([
          <?php
          // Fazemos um loop pelos resultados obtidos do banco de dados
          foreach ($resultados as $linha) {
              // Convertemos o total para inteiro (int) para o JavaScript aceitar como número
              echo "['" . $linha['prioridade'] . "', " . (int)$linha['total'] . "],";
          }
          ?>
        ]);

        // Configurações do gráfico
        var options = {
          'title': 'Prioridade das Ordens de Serviço - Mês Corrente',
          'width': 600,
          'height': 400,
          'is3D': true // Deixa o gráfico de pizza em 3D (opcional, mas fica bem legal!)
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>

<body>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Painel de Indicadores</h4>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div id="chart_div"></div>
      </div>
    </div>
  </div>
</body>
</html>