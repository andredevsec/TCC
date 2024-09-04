<?php
require_once("valida_session.php");
require_once("bd/bd_medicamento.php"); // Atualize o caminho para o arquivo correto

$codigo = $_GET['cod'];

$dados = removeMedicamento($codigo);

if ($dados == 0) {
    $_SESSION['texto_erro'] = 'Os dados do medicamento não foram excluídos do sistema!';
    header("Location: medicamento.php");
} else {
    $_SESSION['texto_sucesso'] = 'Os dados do medicamento foram excluídos do sistema.';
    header("Location: medicamento.php");
}
?>
