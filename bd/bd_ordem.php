<?php

require_once("conecta_bd.php");

function listaOrdem() {
    $conexao = conecta_bd();
    $ordens = array();

    $query = "SELECT o.cod, a.nome AS nome_aluno, t.nome AS nome_terceirizado, s.nome AS nome_servico, s.valor AS valor_servico, o.data_servico, o.status
              FROM ordem o
              JOIN aluno a ON o.cod_aluno = a.cod
              JOIN terceirizado t ON o.cod_terceirizado = t.cod
              JOIN servico s ON o.cod_servico = s.cod
              ORDER BY o.data_servico DESC";

    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($dados = mysqli_fetch_assoc($resultado)) {
        array_push($ordens, $dados);
    }

    mysqli_close($conexao);
    return $ordens;
}

function buscaOrdem($codigo) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM ordem WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados;
}

function cadastraOrdem($cod_aluno, $cod_servico, $cod_terceirizado, $data_servico, $status, $data) {
    $conexao = conecta_bd();

    $checkQuery = "SELECT cod FROM servico WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $checkQuery);
    mysqli_stmt_bind_param($stmt, "i", $cod_servico);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $query = "INSERT INTO ordem (cod_aluno, cod_terceirizado, cod_servico, data_servico, status, data) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "iiisss", $cod_aluno, $cod_terceirizado, $cod_servico, $data_servico, $status, $data);
        mysqli_stmt_execute($stmt);
        $affectedRows = mysqli_stmt_affected_rows($stmt);
    } else {
        $affectedRows = "Error: cod_servico does not exist in servico table";
    }

    mysqli_close($conexao);
    return $affectedRows;
}

function buscaOrdemadd() {
    $conexao = conecta_bd();

    $query = "SELECT a.nome AS nome_aluno, t.nome AS nome_terceirizado, s.nome AS nome_servico, s.valor AS valor_servico, o.data_servico, o.status
              FROM ordem o
              JOIN aluno a ON o.cod_aluno = a.cod
              JOIN terceirizado t ON o.cod_terceirizado = t.cod
              JOIN servico s ON o.cod_servico = s.cod
              ORDER BY o.data_servico DESC";

    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
    } else {
        $dados = [];
    }

    mysqli_close($conexao);
    return $dados;
}

function removeOrdem($codigo) {
    $conexao = conecta_bd();

    $query = "DELETE FROM ordem WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $affectedRows = mysqli_stmt_affected_rows($stmt);

    mysqli_close($conexao);
    return $affectedRows;
}

function buscaOrdemeditar($codigo) {
    $conexao = conecta_bd();

    $query = "SELECT o.cod, a.nome AS nome_aluno, a.cod AS cod_aluno, t.nome AS nome_terceirizado, s.nome AS nome_servico, o.data_servico, o.status, o.cod_terceirizado, o.cod_servico
              FROM ordem o
              JOIN aluno a ON o.cod_aluno = a.cod
              JOIN terceirizado t ON o.cod_terceirizado = t.cod
              JOIN servico s ON o.cod_servico = s.cod
              WHERE o.cod = ?";

    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados;
}

function editarOrdem($cod, $cod_aluno, $cod_terceirizado, $cod_servico, $data_servico, $status, $data) {
    $conexao = conecta_bd();

    $checkQuery = "SELECT cod FROM servico WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $checkQuery);
    mysqli_stmt_bind_param($stmt, "i", $cod_servico);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) == 1) {
        $query = "UPDATE ordem SET cod_aluno = ?, cod_terceirizado = ?, cod_servico = ?, data_servico = ?, status = ?, data = ? WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "iiisssi", $cod_aluno, $cod_terceirizado, $cod_servico, $data_servico, $status, $data, $cod);
        mysqli_stmt_execute($stmt);
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        mysqli_close($conexao);
        return $affectedRows;
    }
}

function consultaStatusUsuario($status) {
    $conexao = conecta_bd();

    $query = "SELECT COUNT(*) as total FROM ordem WHERE status = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "s", $status);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados ? $dados : ['total' => 0];
}

function consultaStatusAluno($codigo, $status) {
    $conexao = conecta_bd();

    $query = "SELECT COUNT(*) as total FROM ordem WHERE cod_aluno = ? AND status = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "is", $codigo, $status);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados ? $dados : ['total' => 0];
}

function consultaStatusTerceirizado($codigo, $status) {
    $conexao = conecta_bd();

    $query = "SELECT COUNT(*) as total FROM ordem WHERE cod_terceirizado = ? AND status = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "is", $codigo, $status);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($resultado);

    mysqli_close($conexao);
    return $dados ? $dados : ['total' => 0];
}

?>
