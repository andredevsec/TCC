<?php 
	require_once("valida_session.php");
	require_once ("bd/bd_animal.php");

	$codigo = $_GET['cod'];

	$dados = removeAnimal($codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados do animal não foram excluidos do sistema!';
		header ("Location:servico.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados do animal foram excluidos do sistema.';
		header ("Location:servico.php");
	}

?>