<?php
session_start();

$nome = $_POST["nome"];
$curso = $_POST["curso"];
$ra = $_POST["ra"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$cep = $_POST["cep"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$uf = $_POST["uf"];
$telefone = $_POST["telefone"];
$status = $_POST["status"];
$perfil = 2;
$data = date("y/m/d");

require_once("bd/bd_aluno.php");

$dados = buscaAluno($email);

if ($dados != 0) {
    $_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
    $_SESSION['nome'] = $nome;
    $_SESSION['curso'] = $curso;
    $_SESSION['ra'] = $ra;
    $_SESSION['email'] = $email;
    $_SESSION['cep'] = $cep;
    $_SESSION['endereco'] = $endereco;
    $_SESSION['numero'] = $numero;
    $_SESSION['bairro'] = $bairro;
    $_SESSION['cidade'] = $cidade;
    $_SESSION['uf'] = $uf;
    $_SESSION['telefone'] = $telefone;
    header("Location: cad_aluno.php");
} else {
    $dados = cadastraAluno($nome, $curso, $ra, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data);

    if ($dados == 1) {
        $_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
        unset($_SESSION['texto_erro']);
        unset($_SESSION['nome']);
        unset($_SESSION['curso']);
        unset($_SESSION['ra']);
        unset($_SESSION['email']);
        unset($_SESSION['cep']);
        unset($_SESSION['endereco']);
        unset($_SESSION['numero']);
        unset($_SESSION['bairro']);
        unset($_SESSION['cidade']);
        unset($_SESSION['uf']);
        unset($_SESSION['telefone']);
        header("Location: aluno.php");
    } else {
        $_SESSION['texto_erro'] = 'Os dados não foram adicionados no sistema!';
        $_SESSION['nome'] = $nome;
        $_SESSION['curso'] = $curso;
        $_SESSION['ra'] = $ra;
        $_SESSION['email'] = $email;
        $_SESSION['cep'] = $cep;
        $_SESSION['endereco'] = $endereco;
        $_SESSION['numero'] = $numero;
        $_SESSION['bairro'] = $bairro;
        $_SESSION['cidade'] = $cidade;
        $_SESSION['uf'] = $uf;
        $_SESSION['telefone'] = $telefone;
        header("Location: cad_aluno.php");
    }
}
?>
