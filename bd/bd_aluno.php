<?php
require_once("conecta_bd.php");

function checaAluno($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);

    $query = "SELECT * FROM aluno WHERE email = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $senhaMd5);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);
    
    mysqli_close($conexao);
    
    return $dados;
}

function listaAlunos() {
    $conexao = conecta_bd();
    $alunos = array();

    $query = "SELECT * FROM aluno ORDER BY nome";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($alunos, $dados);
    }

    mysqli_close($conexao);
    
    return $alunos;
}

function buscaAluno($email) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM aluno WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);
    
    mysqli_close($conexao);
    
    return $dados;
}

function cadastraAluno($nome, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data) {
    $conexao = conecta_bd();

    $query = "INSERT INTO aluno (nome, email, senha, cep, endereco, numero, bairro, cidade, uf, telefone, status, perfil, data) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssssssss', $nome, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    
    mysqli_close($conexao);
    
    return $dados;
}

function removeAluno($codigo) {
    $conexao = conecta_bd();

    $query = "DELETE FROM aluno WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    
    mysqli_close($conexao);
    
    return $dados;
}

function buscaAlunoEditar($codigo) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM aluno WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);
    
    mysqli_close($conexao);
    
    return $dados;
}

function editarAluno($codigo, $status, $data) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM aluno WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE aluno SET status = ?, data = ? WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, 'ssi', $status, $data, $codigo);
        mysqli_stmt_execute($stmt);
        $rows = mysqli_stmt_affected_rows($stmt);

        mysqli_close($conexao);
        return $rows;
    }

    mysqli_close($conexao);
    return 0;
}

function editarSenhaAluno($codigo, $senha) {
    $conexao = conecta_bd();

    $query = "UPDATE aluno SET senha = ? WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'si', $senha, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    
    mysqli_close($conexao);
    
    return $dados;
}

function editarPerfilAluno($codigo, $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data) {
    $conexao = conecta_bd();

    $query = "UPDATE aluno SET nome = ?, email = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, telefone = ?, data = ? WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    
    mysqli_close($conexao);
    
    return $dados;
}
?>
