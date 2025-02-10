<?php
session_start();
$grupo_id = $_POST['grupo_id'];

require_once('bd/bd_agrupamento.php');

$dados = deletaAgrupamento($grupo_id);
if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Agrupamento deletado com sucesso.';
    header("Location: agrupamento.php");
} else {
    $_SESSION['texto_erro'] = 'Erro ao deletar agrupamento.';
    header("Location: agrupamento.php");
}
?>