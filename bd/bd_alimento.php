<?php

require_once("conecta_bd.php");

function listaAlimentos() {
    $conexao = conecta_bd();
    $alimentos = array();
    $query = "SELECT * FROM alimento ORDER BY cod";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        array_push($alimentos, $dados);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $alimentos;
}

function buscaAlimento($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM alimento WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $dados = mysqli_stmt_num_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function cadastraAlimento($nome, $valor, $quantidade, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO alimento (nome, valor, quantidade, data) 
              VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sdss', $nome, $valor, $quantidade, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function removeAlimento($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM alimento WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function buscaAlimentoEditar($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM alimento WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function editarAlimento($codigo, $nome, $valor, $quantidade, $data) {
    $conexao = conecta_bd();
    $query = "UPDATE alimento 
              SET nome = ?, valor = ?, quantidade = ?, data = ?
              WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sdssi', $nome, $valor, $quantidade, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

?>
