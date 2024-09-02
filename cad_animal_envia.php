<?php
session_start();
$identificador = $_POST["identificador"];
$quantidade = $_POST["quantidade"];
$peso = $_POST["peso"];
$fase = $_POST["fase"];
$sexo = $_POST["sexo"];
$data = date("Y-m-d"); // Formato correto para data no MySQL

require_once ("bd/bd_animal.php");

$dados = cadastraAnimal($identificador, $quantidade, $peso, $fase, $sexo, $data);
if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Dados do animal adicionados com sucesso.';
    unset($_SESSION['identificador']);
    unset($_SESSION['quantidade']);
    unset($_SESSION['peso']);
    unset($_SESSION['fase']);
    unset($_SESSION['sexo']);
    unset($_SESSION['texto_erro']);
    header("Location: animal.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados do animal não foram adicionados no sistema!';
    $_SESSION['identificador'] = $identificador;
    $_SESSION['quantidade'] = $quantidade;
    $_SESSION['peso'] = $peso;
    $_SESSION['fase'] = $fase;
    $_SESSION['sexo'] = $sexo;
    header("Location: cad_animal.php");
}
?>
