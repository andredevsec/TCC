<?php
require_once("valida_session.php");
require_once("bd/bd_animal.php");

$codigo = $_POST["cod"];
$identificador = $_POST["identificador"];
$quantidade = $_POST["quantidade"];
$peso = $_POST["peso"];
$fase = $_POST["fase"];
$sexo = $_POST["sexo"];
$data = date("Y-m-d");

$dados = editarAnimal($codigo, $identificador, $quantidade, $peso, $fase, $sexo, $data);

if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Os dados do animal foram alterados no sistema.';
    header("Location: animal.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados do animal não foram alterados no sistema!';
    header("Location: animal.php");
}
?>
