<?php 
require_once("valida_session.php");
require_once("bd/bd_alimento.php");

$codigo = $_GET['cod'];

$dados = removeAlimento($codigo);

if($dados == 0){
    $_SESSION['texto_erro'] = 'Os dados do alimento não foram excluídos do sistema!';
    header("Location: alimento.php");
} else {
    $_SESSION['texto_sucesso'] = 'Os dados do alimento foram excluídos do sistema.';
    header("Location: alimento.php");
}
?>
