<?php
require_once("conecta_bd.php");

function listaServicos() {
    $conexao = conecta_bd();
    $servicos = array();

    $query = "SELECT * FROM servico ORDER BY nome";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($servicos, $dados);
    }

    mysqli_close($conexao);
    return $servicos;
}

function buscaServico($email) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM servico WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    return $dados;
}

function cadastraServico($nome, $valor, $data) {
    $conexao = conecta_bd();

    $query = "INSERT INTO servico (nome, valor, data) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "sds", $nome, $valor, $data);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

function removeServico($codigo) {
    $conexao = conecta_bd();

    $query = "DELETE FROM servico WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

function buscaServicoeditar($codigo) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM servico WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarServico($codigo, $nome, $valor) {
    $conexao = conecta_bd();

    $query = "UPDATE servico SET nome = ?, valor = ? WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "sdi", $nome, $valor, $codigo);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}
?>
