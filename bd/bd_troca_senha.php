<?php
require_once("bd_usuario.php");
require_once("bd_aluno.php");
require_once("bd_terceirizado.php");

function trocaSenha($email, $nova_senha, $perfil) {
    $nova_senha_md5 = md5($nova_senha);

    switch ($perfil) {
        case '1': 
            $usuarioExiste = buscaUsuario($email);
            if ($usuarioExiste > 0) {
                $conexao = conecta_bd();
                
                $query = "SELECT * FROM usuario WHERE email = ?";
                $stmt = mysqli_prepare($conexao, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $dadosUsuario = mysqli_fetch_assoc($resultado);

                if ($dadosUsuario) {
                    return editarSenhaUsuario($dadosUsuario['cod'], $nova_senha_md5);
                }
            } else {
                return 'Usuário não encontrado.';
            }
            break;

        case '2':
            $clienteExiste = buscaAluno($email);
            if ($clienteExiste > 0) {
                $conexao = conecta_bd();

                $query = "SELECT * FROM aluno WHERE email = ?";
                $stmt = mysqli_prepare($conexao, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $dadosCliente = mysqli_fetch_assoc($resultado);

                if ($dadosCliente) {
                    return editarSenhaAluno($dadosCliente['cod'], $nova_senha_md5);
                }
            } else {
                return 'Cliente não encontrado.';
            }
            break;

        case '3':
            $terceirizadoExiste = buscaTerceirizado($email);
            if ($terceirizadoExiste > 0) {
                $conexao = conecta_bd();

                $query = "SELECT * FROM terceirizado WHERE email = ?";
                $stmt = mysqli_prepare($conexao, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $dadosTerceirizado = mysqli_fetch_assoc($resultado);

                if ($dadosTerceirizado) {
                    return editarSenhaTerceirizado($dadosTerceirizado['cod'], $nova_senha_md5);
                }
            } else {
                return 'Terceirizado não encontrado.';
            }
            break;

        default:
            return 'Perfil inválido!';
    }
}
?>