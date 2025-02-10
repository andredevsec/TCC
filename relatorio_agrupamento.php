<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');
require_once('bd/conecta_bd.php'); // arquivo que contém a função conecta_bd()

// Verifica se o ID do agrupamento foi informado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "<div class='container'><h3>ID do agrupamento não informado.</h3></div>";
  exit;
}

$agrupamento_id = intval($_GET['id']);

// Abre a conexão com o banco de dados
$conexao = conecta_bd();

// 1. Consulta os dados do agrupamento
$query = "SELECT * FROM agrupamento WHERE id = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$agrupamento = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$agrupamento) {
  echo "<div class='container'><h3>Agrupamento não encontrado.</h3></div>";
  exit;
}

// 2. Consulta os animais associados
$query = "SELECT a.* 
          FROM animal a
          INNER JOIN agrupamento_animal aa ON a.cod = aa.animal_id
          WHERE aa.agrupamento_id = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$animais = [];
while ($row = mysqli_fetch_assoc($result)) {
  $animais[] = $row;
}
mysqli_stmt_close($stmt);

// 3. Consulta os serviços associados
$query = "SELECT s.* 
          FROM servico s
          INNER JOIN agrupamento_servico asp ON s.cod = asp.servico_id
          WHERE asp.agrupamento_id = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$servicos = [];
while ($row = mysqli_fetch_assoc($result)) {
  $servicos[] = $row;
}
mysqli_stmt_close($stmt);

// 4. Consulta os alimentos associados
$query = "SELECT al.* 
          FROM alimento al
          INNER JOIN agrupamento_alimento aa ON al.cod = aa.alimento_id
          WHERE aa.agrupamento_id = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$alimentos = [];
while ($row = mysqli_fetch_assoc($result)) {
  $alimentos[] = $row;
}
mysqli_stmt_close($stmt);

// 5. Consulta os medicamentos associados
$query = "SELECT m.* 
          FROM medicamento m
          INNER JOIN agrupamento_medicamento am ON m.cod = am.medicamento_id
          WHERE am.agrupamento_id = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$medicamentos = [];
while ($row = mysqli_fetch_assoc($result)) {
  $medicamentos[] = $row;
}
mysqli_stmt_close($stmt);

mysqli_close($conexao);
?>

<?php
$total_servicos = 0;
$quantidade_servicos = 0;
$total_alimentos = 0;
$quantidade_total_alimentos = 0;
$total_medicamentos = 0;
$quantidade_total_medicamentos = 0;

?>

<!-- Main Content -->
<div id="content">
  <?php require_once('navbar.php'); ?>

  <div class="container-fluid">
    <h2 class="mt-4">Relatório do Agrupamento: <?= htmlspecialchars($agrupamento['nome']); ?></h2>

    <!-- Seção: Dados do Agrupamento -->
    <div class="card mb-4 mt-2">
      <div class="card-header">
        <h5>Dados do Agrupamento</h5>
      </div>
      <div class="card-body">
        <p><strong>ID:</strong> <?= $agrupamento['id']; ?></p>
        <p><strong>Nome:</strong> <?= htmlspecialchars($agrupamento['nome']); ?></p>
        <!-- Adicione outros campos se houver -->
        <a href="cad_agrupamento.php?id=<?= $agrupamento['id']; ?>" class="btn btn-primary">Editar</a>
      </div>
    </div>

    <!-- Seção: Animais -->
    <div class="card mb-4">
      <div class="card-header">
        <h5>Animais</h5>
      </div>
      <div class="card-body">
        <?php if (count($animais) > 0): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código</th>
                <th>Identificador</th>
                <th>Quantidade</th>
                <th>Peso</th>
                <th>Fase</th>
                <th>Sexo</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($animais as $animal): ?>
                <tr>
                  <td><?= $animal['cod']; ?></td>
                  <td><?= htmlspecialchars($animal['identificador']); ?></td>
                  <td><?= $animal['quantidade']; ?></td>
                  <td><?= number_format($animal['peso'], 2, ',', '.'); ?></td>
                  <td><?= htmlspecialchars($animal['fase']); ?></td>
                  <td><?= htmlspecialchars($animal['sexo']); ?></td>
                  <td><?= date('d/m/Y', strtotime($animal['data'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>Nenhum animal associado.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Seção: Serviços -->
    <div class="card mb-4">
      <div class="card-header">
        <h5>Serviços</h5>
      </div>
      <div class="card-body">
        <?php if (count($servicos) > 0): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <?php

              foreach ($servicos as $servico):
                $quantidade_servicos++;
                $total_servicos += $servico['valor'];
                ?>
                <tr>
                  <td><?= $servico['cod']; ?></td>
                  <td><?= htmlspecialchars($servico['nome']); ?></td>
                  <td>R$ <?= number_format($servico['valor'], 2, ',', '.'); ?></td>
                  <td><?= date('d/m/Y', strtotime($servico['data'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2">Total de Serviços</th>
                <th colspan="2">R$ <?= number_format($total_servicos, 2, ',', '.'); ?></th>
              </tr>
            </tfoot>
          </table>
        <?php else: ?>
          <p>Nenhum serviço associado.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Seção: Alimentos -->
    <div class="card mb-4">
      <div class="card-header">
        <h5>Alimentos</h5>
      </div>
      <div class="card-body">
        <?php if (count($alimentos) > 0): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($alimentos as $alimento):
                $quantidade_total_alimentos++;
                $total_alimentos += $alimento['valor'];
                ?>
                <tr>
                  <td><?= $alimento['cod']; ?></td>
                  <td><?= htmlspecialchars($alimento['nome']); ?></td>
                  <td>R$ <?= number_format($alimento['valor'], 2, ',', '.'); ?></td>
                  <td><?= date('d/m/Y', strtotime($alimento['data'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2">Total de Alimentos</th>
                <th colspan="3">R$ <?= number_format($total_alimentos, 2, ',', '.'); ?></th>
              </tr>
            </tfoot>
          </table>
        <?php else: ?>
          <p>Nenhum alimento associado.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Seção: Medicamentos -->
    <div class="card mb-4">
      <div class="card-header">
        <h5>Medicamentos</h5>
      </div>
      <div class="card-body">
        <?php if (count($medicamentos) > 0): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($medicamentos as $medicamento):
                $quantidade_total_medicamentos++;
                $total_medicamentos += $medicamento['valor'];
                ?>
                <tr>
                  <td><?= $medicamento['cod']; ?></td>
                  <td><?= htmlspecialchars($medicamento['nome']); ?></td>
                  <td>R$ <?= number_format($medicamento['valor'], 2, ',', '.'); ?></td>
                  <td><?= date('d/m/Y', strtotime($medicamento['data'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2">Total de Medicamentos</th>
                <th colspan="3">R$ <?= number_format($total_medicamentos, 2, ',', '.'); ?></th>
              </tr>
            </tfoot>
          </table>
        <?php else: ?>
          <p>Nenhum medicamento associado.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header">
        <h5>Abate</h5>
      </div>
      <div class="card-body">
        <?php if ($agrupamento['valor_abate'] > 0): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Valor</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Serviço</td>
                <td>R$ <?= number_format($agrupamento['valor_abate'], 2, ',', '.'); ?></td>
              </tr>
            </tbody>

          </table>
        <?php else: ?>
          <p>Nenhum valor cadastrado!</p>
        <?php endif; ?>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <h5>Custo Total</h5>
      </div>
      <div class="card-body">
        <?php if (count($servicos) > 0 || count($medicamentos) > 0 || count($alimentos) > 0): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Valor</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($servicos) > 0): ?>
                <tr>
                  <td>Serviços</td>
                  <td><?= $quantidade_servicos; ?></td>
                  <td>R$ <?= number_format($total_servicos, 2, ',', '.'); ?></td>
                </tr>
              <?php endif; ?>
              <?php if (count($alimentos) > 0): ?>
                <tr>
                  <td>Alimentos</td>
                  <td><?= $quantidade_total_alimentos; ?></td>
                  <td>R$ <?= number_format($total_alimentos, 2, ',', '.'); ?></td>
                </tr>
              <?php endif; ?>
              <?php if (count($medicamentos) > 0): ?>
                <tr>
                  <td>Medicamentos</td>
                  <td><?= $quantidade_total_medicamentos; ?></td>
                  <td>R$ <?= number_format($total_medicamentos, 2, ',', '.'); ?></td>
                </tr>
              <?php endif; ?>
              <?php if ($agrupamento['valor_abate'] > 0): ?>
                <tr>
                  <td>Custo Abate</td>
                  <td></td>
                  <td>R$ <?= number_format($agrupamento['valor_abate'], 2, ',', '.'); ?></td>
                </tr>
              <?php endif; ?>
            </tbody>

            <tfoot>
              <tr>
                <th colspan="2">Total geral</th>
                <th colspan="3">R$
                  <?= number_format(($total_servicos + $total_alimentos + $total_medicamentos) + $agrupamento['valor_abate'], 2, ',', '.'); ?>
                </th>
              </tr>
            </tfoot>
          </table>
        <?php else: ?>
          <p>Nenhum tipo encontrado.</p>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<?php require_once('footer.php'); ?>