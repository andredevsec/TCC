<?php
require_once("valida_session.php");
require_once("bd/bd_medicamento.php"); // Atualize o caminho para o arquivo correto

$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$valor = $_POST["valor"];
$quantidade = $_POST["quantidade"];
$data = $_POST["data"]; // Data fornecida pelo formulário

$dados = editarMedicamento($codigo, $nome, $valor, $quantidade, $data);

if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Os dados do medicamento foram alterados no sistema.';
    header("Location: medicamento.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados do medicamento não foram alterados no sistema!';
    header("Location: editar_medicamento.php?cod=$codigo"); // Redireciona de volta para o formulário de edição com o código do medicamento
}
?>
