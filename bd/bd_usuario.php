<?php

require_once("conecta_bd.php");

function checaUsuario($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);

    $query = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $senhaMd5);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);
    
    mysqli_close($conexao);

    return $dados;
}

function listaUsuarios() {
    $conexao = conecta_bd();
    $usuarios = array();

    $query = "SELECT * FROM usuario ORDER BY nome";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($usuarios, $dados);
    }

    mysqli_close($conexao);

    return $usuarios;
}

function buscaUsuario($email) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM usuario WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    mysqli_close($conexao);

    return $dados;
}

function cadastraUsuario($nome, $senha, $email, $cep, $endereco, $numero, $bairro, $cidade, $uf, $perfil, $status, $data) {
    $conexao = conecta_bd();

    $query = "INSERT INTO usuario (nome, senha, email, cep, endereco, numero, bairro, cidade, uf, perfil, status, data) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $nome, $senha, $email, $cep, $endereco, $numero, $bairro, $cidade, $uf, $perfil, $status, $data);
    mysqli_stmt_execute($stmt);

    $rows = mysqli_stmt_affected_rows($stmt);
    mysqli_close($conexao); // Fecha a conexão após a execução

    return $rows;
}

function removeUsuario($codigo) {
    $conexao = conecta_bd();

    $query = "DELETE FROM usuario WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);

    $rows = mysqli_stmt_affected_rows($stmt);
    mysqli_close($conexao); // Fecha a conexão após a execução

    return $rows;
}

function buscaUsuarioeditar($codigo) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM usuario WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);
    
    mysqli_close($conexao);

    return $dados;
}

function editarUsuario($codigo, $status, $data) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM usuario WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE usuario SET status = ?, data = ? WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $status, $data, $codigo);
        mysqli_stmt_execute($stmt);
        $rows = mysqli_stmt_affected_rows($stmt);

        mysqli_close($conexao);
        return $rows;
    }

    mysqli_close($conexao);
    return 0;
}

function editarSenhaUsuario($codigo, $senha) {
    $conexao = conecta_bd();

    $query = "UPDATE usuario SET senha = ? WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "si", $senha, $codigo);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_stmt_affected_rows($stmt);

    mysqli_close($conexao); // Fecha a conexão após a execução
    return $rows > 0;
}

function editarPerfilUsuario($codigo, $nome, $email, $data) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM usuario WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE usuario SET nome = ?, email = ?, data = ? WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $data, $codigo);
        mysqli_stmt_execute($stmt);
        $rows = mysqli_stmt_affected_rows($stmt);

        mysqli_close($conexao); // Fecha a conexão após a execução
        return $rows;
    }

    mysqli_close($conexao); // Fecha a conexão mesmo se não encontrar
    return 0;
}

?>
