<?php
session_start();

$nome = $_POST["nome"];
$valor = $_POST["valor"];
$quantidade = $_POST["quantidade"];
$data = $_POST["data"]; // Data fornecida pelo formulário

require_once("bd/bd_medicamento.php"); // Atualize o caminho conforme necessário

$dados = cadastraMedicamento($nome, $valor, $quantidade, $data); 

if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Dados do medicamento adicionados com sucesso.';
    unset($_SESSION['nome']);
    unset($_SESSION['valor']);
    unset($_SESSION['quantidade']);
    unset($_SESSION['data']);
    unset($_SESSION['texto_erro']);
    header("Location: medicamento.php"); // Atualize a URL para a página de listagem de medicamentos
} else {
    $_SESSION['texto_erro'] = 'Os dados do medicamento não foram adicionados no sistema!';
    $_SESSION['nome'] = $nome;
    $_SESSION['valor'] = $valor;
    $_SESSION['quantidade'] = $quantidade;
    $_SESSION['data'] = $data;
    header("Location: cad_medicamento.php"); // Atualize a URL para a página de cadastro de medicamentos
}
?>
