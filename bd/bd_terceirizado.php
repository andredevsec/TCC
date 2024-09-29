<?php
require_once("conecta_bd.php");

function checaTerceirizado($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);

    $query = "SELECT * FROM terceirizado WHERE email = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $senhaMd5);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaTerceirizados() {
    $conexao = conecta_bd();
    $terceirizados = array();

    $query = "SELECT * FROM terceirizado ORDER BY nome";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($dados = mysqli_fetch_array($resultado)) {
        array_push($terceirizados, $dados);
    }

    return $terceirizados;
}

function buscaTerceirizado($email) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM terceirizado WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    return $dados;
}

function cadastraTerceirizado($nome, $email, $telefone, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $status, $perfil, $data) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);

    $query = "INSERT INTO terceirizado (nome, email, telefone, senha, cep, endereco, numero, bairro, cidade, uf, status, perfil, data) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $nome, $email, $telefone, $senhaMd5, $cep, $endereco, $numero, $bairro, $cidade, $uf, $status, $perfil, $data);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}

function removeTerceirizado($codigo) {
    $conexao = conecta_bd();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    mysqli_begin_transaction($conexao);

    try {
        $query = "DELETE FROM terceirizado WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "i", $codigo);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conexao);
        return mysqli_stmt_affected_rows($stmt);
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conexao);

        if ($e->getCode() == 1451) {
            return 'FOREIGN_KEY_CONSTRAINT';
        } else {
            throw $e;
        }
    } finally {
        mysqli_close($conexao);
    }
}

function buscaTerceirizadoeditar($codigo) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM terceirizado WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarTerceirizado($codigo, $status, $data) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM terceirizado WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE terceirizado SET status = ?, data = ? WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $status, $data, $codigo);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }
    return 0;
}

function editarSenhaTerceirizado($codigo, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);

    $query = "UPDATE terceirizado SET senha = ? WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "si", $senhaMd5, $codigo);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_affected_rows($stmt) > 0;
}

function editarPerfilTerceirizado($codigo, $nome, $email, $telefone, $data) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM terceirizado WHERE cod = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_num_rows($resultado);

    if ($dados == 1) {
        $query = "UPDATE terceirizado SET nome = ?, email = ?, telefone = ?, data = ? WHERE cod = ?";
        $stmt = mysqli_prepare($conexao, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $nome, $email, $telefone, $data, $codigo);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    return 0;
}
?>
