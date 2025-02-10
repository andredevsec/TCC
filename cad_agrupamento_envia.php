<?php
session_start();

require_once('bd/bd_agrupamento.php');

// Recebe e trata o nome do agrupamento
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';

$abate = isset($_POST['valor_abate']) ? trim($_POST['valor_abate']) : 0;

if (empty($nome)) {
    $_SESSION['texto_erro'] = "O nome do agrupamento é obrigatório.";
    header("Location: cad_agrupamento.php");
    exit;
}

// Verifica se é edição (se existe o campo agrupamento_id) ou inserção nova
if (isset($_POST['agrupamento_id']) && !empty($_POST['agrupamento_id'])) {
    // Modo de atualização
    $agrupamento_id = intval($_POST['agrupamento_id']);

    // Atualiza o nome do agrupamento
    $atualizado = editaAgrupamento($agrupamento_id, $nome, $abate);
    if ($atualizado === false) {
        $_SESSION['texto_erro'] = "Erro ao atualizar o agrupamento.";
        header("Location: cad_agrupamento.php?id=" . $agrupamento_id);
        exit;
    }

    // Remover as associações antigas para recriá-las
    deletaAssociacoesAgrupamento($agrupamento_id);

    // Processa os animais (array de IDs)
    if (isset($_POST['animais']) && is_array($_POST['animais'])) {
        foreach ($_POST['animais'] as $animal_id) {
            if (!empty($animal_id)) {
                associaAnimalAgrupamento($agrupamento_id, $animal_id);
            }
        }
    }

    // Processa os serviços (array de IDs)
    if (isset($_POST['servicos']) && is_array($_POST['servicos'])) {
        foreach ($_POST['servicos'] as $servico_id) {
            if (!empty($servico_id)) {
                associaServicoAgrupamento($agrupamento_id, $servico_id);
            }
        }
    }

    // Processa os alimentos (array de IDs)
    if (isset($_POST['alimentos']) && is_array($_POST['alimentos'])) {
        foreach ($_POST['alimentos'] as $alimento_id) {
            if (!empty($alimento_id)) {
                associaAlimentoAgrupamento($agrupamento_id, $alimento_id);
            }
        }
    }

    // Processa os medicamentos (array de IDs)
    if (isset($_POST['medicamentos']) && is_array($_POST['medicamentos'])) {
        foreach ($_POST['medicamentos'] as $medicamento_id) {
            if (!empty($medicamento_id)) {
                associaMedicamentoAgrupamento($agrupamento_id, $medicamento_id);
            }
        }
    }

    $_SESSION['texto_sucesso'] = "Agrupamento atualizado com sucesso.";
    header("Location: agrupamento.php");
    exit;
} else {
    // Modo de inserção (novo agrupamento)
    $agrupamento_id = cadastraAgrupamento($nome, $abate);
    if (!$agrupamento_id) {
        $_SESSION['texto_erro'] = "Erro ao cadastrar agrupamento.";
        header("Location: cad_agrupamento.php");
        exit;
    }

    if (isset($_POST['animais']) && is_array($_POST['animais'])) {
        foreach ($_POST['animais'] as $animal_id) {
            if (!empty($animal_id)) {
                associaAnimalAgrupamento($agrupamento_id, $animal_id);
            }
        }
    }

    if (isset($_POST['servicos']) && is_array($_POST['servicos'])) {
        foreach ($_POST['servicos'] as $servico_id) {
            if (!empty($servico_id)) {
                associaServicoAgrupamento($agrupamento_id, $servico_id);
            }
        }
    }

    if (isset($_POST['alimentos']) && is_array($_POST['alimentos'])) {
        foreach ($_POST['alimentos'] as $alimento_id) {
            if (!empty($alimento_id)) {
                associaAlimentoAgrupamento($agrupamento_id, $alimento_id);
            }
        }
    }

    if (isset($_POST['medicamentos']) && is_array($_POST['medicamentos'])) {
        foreach ($_POST['medicamentos'] as $medicamento_id) {
            if (!empty($medicamento_id)) {
                associaMedicamentoAgrupamento($agrupamento_id, $medicamento_id);
            }
        }
    }

    $_SESSION['texto_sucesso'] = "Agrupamento cadastrado com sucesso.";
    header("Location: agrupamento.php");
    exit;
}
?>