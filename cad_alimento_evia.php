<?php
session_start();
$nome = $_POST["nome"];
$valor = $_POST["valor"];
$quantidade = $_POST["quantidade"];
$data = $_POST["data"]; // Data fornecida pelo formulário

require_once("bd/bd_alimento.php");

$dados = cadastraAlimento($nome, $valor, $quantidade, $data);
if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Dados do alimento adicionados com sucesso.';
    unset($_SESSION['nome']);
    unset($_SESSION['valor']);
    unset($_SESSION['quantidade']);
    unset($_SESSION['data']);
    unset($_SESSION['texto_erro']);
    header("Location: alimento.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados do alimento não foram adicionados no sistema!';
    $_SESSION['nome'] = $nome;
    $_SESSION['valor'] = $valor;
    $_SESSION['quantidade'] = $quantidade;
    $_SESSION['data'] = $data;
    header("Location: cad_alimento.php");
}
?>
