<?php

require_once("conecta_bd.php");

function listaMedicamentos() {
    $conexao = conecta_bd();
    $medicamentos = array();
    $query = "SELECT * FROM medicamento ORDER BY cod";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        array_push($medicamentos, $dados);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $medicamentos;
}

function buscaMedicamento($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM medicamento WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $dados = mysqli_stmt_num_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function cadastraMedicamento($nome, $valor, $quantidade, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO medicamento (nome, valor, quantidade, data) 
              VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sdss', $nome, $valor, $quantidade, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function removeMedicamento($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM medicamento WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function buscaMedicamentoEditar($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM medicamento WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function editarMedicamento($codigo, $nome, $valor, $quantidade, $data) {
    $conexao = conecta_bd();
    $query = "UPDATE medicamento 
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
