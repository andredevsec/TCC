<?php

require_once("conecta_bd.php");

function listaAnimais() {
    $conexao = conecta_bd();
    $animais = array();
    $query = "SELECT * FROM animal ORDER BY identificador";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        array_push($animais, $dados);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $animais;
}

function buscaAnimal($identificador) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM animal WHERE identificador = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 's', $identificador);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $dados = mysqli_stmt_num_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function cadastraAnimal($identificador, $quantidade, $peso, $fase, $sexo, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO animal (identificador, quantidade, peso, fase, sexo, data) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ssssss', $identificador, $quantidade, $peso, $fase, $sexo, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function removeAnimal($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM animal WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function buscaAnimalEditar($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM animal WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}

function editarAnimal($codigo, $identificador, $quantidade, $peso, $fase, $sexo) {
    $conexao = conecta_bd();
    $query = "UPDATE animal 
              SET identificador = ?, quantidade = ?, peso = ?, fase = ?, sexo = ?
              WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sssssi', $identificador, $quantidade, $peso, $fase, $sexo, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $dados;
}


?>