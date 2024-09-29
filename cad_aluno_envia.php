<?php
require_once ("bd/bd_aluno.php");

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	$_SESSION['cep'] = $cep;
	$_SESSION['endereco'] = $endereco;
	$_SESSION['numero'] = $numero;
	$_SESSION['bairro'] = $bairro;
	$_SESSION['cidade'] = $cidade;
	$_SESSION['uf'] = $uf;
	$_SESSION['telefone'] = $telefone;
	header ("Location:cad_aluno.php");
}else{

	$dados = cadastraAluno($nome, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data);

	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		unset ($_SESSION['cep']);
		unset ($_SESSION['endereco']);
		unset ($_SESSION['numero']);
		unset ($_SESSION['bairro']);
		unset ($_SESSION['cidade']);
		unset ($_SESSION['uf']);
		unset ($_SESSION['telefone']);
		header ("Location:aluno.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
		$_SESSION['cep'] = $cep;
		$_SESSION['endereco'] = $endereco;
		$_SESSION['numero'] = $numero;
		$_SESSION['bairro'] = $bairro;
		$_SESSION['cidade'] = $cidade;
		$_SESSION['uf'] = $uf;
		$_SESSION['telefone'] = $telefone;
		header ("Location:cad_aluno.php");
	}
}

?>