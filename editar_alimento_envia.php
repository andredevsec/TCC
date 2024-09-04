<?php
require_once("valida_session.php");
require_once("bd/bd_alimento.php");

$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$valor = $_POST["valor"];
$quantidade = $_POST["quantidade"];
$data = date("Y-m-d");

$dados = editarAlimento($codigo, $nome, $valor, $quantidade, $data);

if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Os dados do alimento foram alterados no sistema.';
    header("Location: alimento.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados do alimento não foram alterados no sistema!';
    header("Location: alimento.php");
}
?>
