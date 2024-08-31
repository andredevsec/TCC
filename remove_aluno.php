<?php
require_once("valida_session.php");
require_once("bd/bd_aluno.php");

$codigo = $_GET['cod'];

if ($_SESSION['cod_usu'] != $codigo) {
    $dados = removeAluno($codigo);

    if ($dados === 'FOREIGN_KEY_CONSTRAINT') {
        $_SESSION['texto_erro'] = 'O aluno não pode ser excluído do sistema pois possui ordem de serviço!';
        header("Location:aluno.php");
    } elseif ($dados == 0) {
        $_SESSION['texto_erro'] = 'Os dados do aluno não foram excluídos do sistema!';
        header("Location:aluno.php");
    } else {
        $_SESSION['texto_sucesso'] = 'Os dados do aluno foram excluídos do sistema.';
        header("Location:aluno.php");
    }
} else {
    $_SESSION['texto_erro'] = 'O aluno não pode ser excluído do sistema, pois está logado!';
    header("Location:aluno.php");
}
?>
