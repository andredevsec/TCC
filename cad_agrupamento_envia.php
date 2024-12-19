<?php
session_start();
$nome = $_POST['nome'];

require_once('bd/bd_animal.php');
require_once('sidebar.php'); 

$dados = cadastraAgrupamento($nome);
if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Agrupamento cadastrado com sucesso.';
    header("Location: agrupamento.php");
} else {
    $_SESSION['texto_erro'] = 'Erro ao cadastrar agrupamento.';
    header("Location: cad_agrupamento.php");
}
?>
