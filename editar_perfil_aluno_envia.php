<?php
require_once("valida_session.php");
require_once ("bd/bd_aluno.php");
         
$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$telefone = $_POST["telefone"];
$data = date("y/m/d");

$dados = editarPerfilAluno($codigo, $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data);
if ($dados == 1){
    $_SESSION['nome_usu'] = $nome;
    $_SESSION['texto_sucesso'] = 'Os dados do aluno foram alterados no sistema.';
    header("Location:editar_perfil_aluno.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados do aluno não foram alterados no sistema!';
    header("Location:editar_perfil_aluno.php");
}
?>
