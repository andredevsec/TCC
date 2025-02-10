<?php
require_once("conecta_bd.php");

/**
 * Cadastra um novo agrupamento e retorna o ID inserido.
 */
function cadastraAgrupamento($nome, $valor_abate)
{
  $conexao = conecta_bd();
  $query = "INSERT INTO agrupamento (nome, valor_abate) VALUES (?, ?)";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'si', $nome, $valor_abate);
  mysqli_stmt_execute($stmt);
  $agrupamento_id = mysqli_insert_id($conexao);
  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $agrupamento_id;
}

/**
 * Associa um animal ao agrupamento.
 */
function associaAnimalAgrupamento($agrupamento_id, $animal_id)
{
  $conexao = conecta_bd();
  $query = "INSERT INTO agrupamento_animal (agrupamento_id, animal_id) VALUES (?, ?)";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $animal_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_affected_rows($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $result;
}

/**
 * Associa um serviço ao agrupamento.
 */
function associaServicoAgrupamento($agrupamento_id, $servico_id)
{
  $conexao = conecta_bd();
  $query = "INSERT INTO agrupamento_servico (agrupamento_id, servico_id) VALUES (?, ?)";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $servico_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_affected_rows($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $result;
}

/**
 * Associa um alimento ao agrupamento.
 */
function associaAlimentoAgrupamento($agrupamento_id, $alimento_id)
{
  $conexao = conecta_bd();
  $query = "INSERT INTO agrupamento_alimento (agrupamento_id, alimento_id) VALUES (?, ?)";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $alimento_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_affected_rows($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $result;
}

/**
 * Associa um medicamento ao agrupamento.
 */
function associaMedicamentoAgrupamento($agrupamento_id, $medicamento_id)
{
  $conexao = conecta_bd();
  $query = "INSERT INTO agrupamento_medicamento (agrupamento_id, medicamento_id) VALUES (?, ?)";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $medicamento_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_affected_rows($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $result;
}

/**
 * Retorna todos os agrupamentos.
 */
function listaAgrupamentos()
{
  $conexao = conecta_bd();
  $agrupamentos = array();
  $query = "SELECT * FROM agrupamento ORDER BY nome";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);

  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    array_push($agrupamentos, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $agrupamentos;
}

/**
 * Atualiza o nome do agrupamento.
 */
function editaAgrupamento($agrupamento_id, $novo_nome, $valor_abate)
{
  $conexao = conecta_bd();
  $query = "UPDATE agrupamento SET nome = ?, valor_abate = ? WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'sii', $novo_nome, $valor_abate, $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $dados = mysqli_stmt_affected_rows($stmt);

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $dados;
}

/**
 * Deleta um agrupamento.
 */
function deletaAgrupamento($agrupamento_id)
{
  $conexao = conecta_bd();
  $query = "DELETE FROM agrupamento WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $dados = mysqli_stmt_affected_rows($stmt);

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $dados;
}

/**
 * Lista os animais associados a um agrupamento.
 */
function listaAnimaisAgrupamento($agrupamento_id)
{
  $conexao = conecta_bd();
  $animais = array();
  $query = "SELECT a.* FROM animal a
            INNER JOIN agrupamento_animal aa ON a.cod = aa.animal_id
            WHERE aa.agrupamento_id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);

  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    array_push($animais, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $animais;
}

/**
 * Retorna os dados de um agrupamento com base no ID.
 */
function listaAgrupamentoPorId($agrupamento_id)
{
  $conexao = conecta_bd();
  $query = "SELECT * FROM agrupamento WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $dados;
}

/**
 * Lista os serviços associados a um agrupamento.
 */
function listaServicosAgrupamento($agrupamento_id)
{
  $conexao = conecta_bd();
  $servicos = array();
  $query = "SELECT s.* 
            FROM servico s
            INNER JOIN agrupamento_servico asg ON s.cod = asg.servico_id
            WHERE asg.agrupamento_id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);

  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    array_push($servicos, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $servicos;
}

/**
 * Lista os alimentos associados a um agrupamento.
 */
function listaAlimentosAgrupamento($agrupamento_id)
{
  $conexao = conecta_bd();
  $alimentos = array();
  $query = "SELECT a.* 
            FROM alimento a
            INNER JOIN agrupamento_alimento aa ON a.cod = aa.alimento_id
            WHERE aa.agrupamento_id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);

  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    array_push($alimentos, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $alimentos;
}

/**
 * Lista os medicamentos associados a um agrupamento.
 */
function listaMedicamentosAgrupamento($agrupamento_id)
{
  $conexao = conecta_bd();
  $medicamentos = array();
  $query = "SELECT m.* 
            FROM medicamento m
            INNER JOIN agrupamento_medicamento am ON m.cod = am.medicamento_id
            WHERE am.agrupamento_id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);

  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    array_push($medicamentos, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $medicamentos;
}

/**
 * Função para deletar todas as associações do agrupamento
 * (deletando registros nas tabelas de relacionamento)
 */
function deletaAssociacoesAgrupamento($agrupamento_id)
{
  require_once("conecta_bd.php");
  $conexao = conecta_bd();

  $tables = ['agrupamento_animal', 'agrupamento_servico', 'agrupamento_alimento', 'agrupamento_medicamento'];
  foreach ($tables as $table) {
    $query = "DELETE FROM {$table} WHERE agrupamento_id = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }

  mysqli_close($conexao);
}
?>