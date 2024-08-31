<?php
require_once("valida_session.php");
require_once ("bd/bd_aluno.php");
	     
$codigo = $_POST["cod"];
$status = $_POST["status"];
$data = date("y/m/d");

$dados = editarAluno($codigo, $status, $data);

if ($dados == 1) {
	$_SESSION['texto_sucesso'] = 'Os dados do aluno foram alterados no sistema.';
	header("Location:aluno.php");
} else {
	$_SESSION['texto_erro'] = 'Os dados do aluno não foram alterados no sistema!';
	header("Location:aluno.php");
}
?>
