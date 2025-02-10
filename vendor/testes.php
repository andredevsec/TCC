Atualmente tenho uma tela para cadastrar os dados, porém eo backend ainda não vincula corretamente:

<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php'); ?>

    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" id="title">VINCULAR NOVO AGRUPAMENTO</h6>
            </div>
            <div class="card-body">
                <!-- Mensagens de Erro / Sucesso -->
                <?php if (isset($_SESSION['texto_erro'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?= $_SESSION['texto_erro'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['texto_erro']); endif; ?>

                <?php if (isset($_SESSION['texto_sucesso'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $_SESSION['texto_sucesso'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['texto_sucesso']); endif; ?>

                <!-- Início do Formulário -->
                <form action="cad_agrupamento_envia.php" method="post">
                    <!-- Nome do Agrupamento -->
                    <div class="form-group">
                        <label>Nome do Agrupamento</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome do agrupamento" required>
                    </div>

                    <hr>
                    <!-- Seção de Animais -->
                    <h4>Animais</h4>
                    <div id="animais-container">
                        <!-- As linhas de animal serão adicionadas aqui -->
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" onclick="adicionarAnimal()">Adicionar Animal</button>

                    <hr>
                    <!-- Seção de Serviços -->
                    <h4>Serviços</h4>
                    <div id="servicos-container">
                        <!-- As linhas de serviço serão adicionadas aqui -->
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" onclick="adicionarServico()">Adicionar Serviço</button>

                    <hr>
                    <!-- Seção de Alimentos -->
                    <h4>Alimentos</h4>
                    <div id="alimentos-container">
                        <!-- As linhas de alimento serão adicionadas aqui -->
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" onclick="adicionarAlimento()">Adicionar Alimento</button>

                    <hr>
                    <!-- Seção de Medicamentos -->
                    <h4>Medicamentos</h4>
                    <div id="medicamentos-container">
                        <!-- As linhas de medicamento serão adicionadas aqui -->
                    </div>
                    <button type="button" class="btn btn-secondary mb-3" onclick="adicionarMedicamento()">Adicionar Medicamento</button>

                    <!-- Botão de Enviar -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-fw fa-link"></i> Vincular Agrupamento
                        </button>
                    </div>
                </form>
                <!-- Fim do Formulário -->
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>

<!-- Coloque o bloco de script antes do footer, para garantir que as funções fiquem definidas no escopo global -->
<script>
// Função para adicionar uma linha de animal
function adicionarAnimal() {
    var container = document.getElementById('animais-container');
    var div = document.createElement('div');
    div.className = "card card-body m-0 mb-2";
    div.innerHTML = `
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Animal Existente</label>
                <select name="animais[]" class="form-control" required>
                    <option value="">Selecione um animal</option>
                    <?php
                    require_once('bd/bd_animal.php');
                    $animais = listaAnimais();
                    foreach ($animais as $animal) {
                        echo '<option value="'.$animal['cod'].'">'.htmlspecialchars($animal['identificador']).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-danger form-control" onclick="removerCampo(this)">X</button>
            </div>
        </div>
    `;
    container.appendChild(div);
}

// Função para adicionar uma linha de serviço
function adicionarServico() {
    var container = document.getElementById('servicos-container');
    var div = document.createElement('div');
    div.className = "card card-body m-0 mb-2";
    div.innerHTML = `
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Serviço Existente</label>
                <select name="servicos[]" class="form-control" required>
                    <option value="">Selecione um serviço</option>
                    <?php
                    require_once('bd/bd_servico.php');
                    $servicos = listaServicos();
                    foreach ($servicos as $servico) {
                        echo '<option value="'.$servico['cod'].'">'.htmlspecialchars($servico['nome']).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-danger form-control" onclick="removerCampo(this)">X</button>
            </div>
        </div>
    `;
    container.appendChild(div);
}

// Função para adicionar uma linha de alimento
function adicionarAlimento() {
    var container = document.getElementById('alimentos-container');
    var div = document.createElement('div');
    div.className = "card card-body m-0 mb-2";
    div.innerHTML = `
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Alimento Existente</label>
                <select name="alimentos[]" class="form-control" required>
                    <option value="">Selecione um alimento</option>
                    <?php
                    require_once('bd/bd_alimento.php');
                    $alimentos = listaAlimentos();
                    foreach ($alimentos as $alimento) {
                        echo '<option value="'.$alimento['cod'].'">'.htmlspecialchars($alimento['nome']).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-danger form-control" onclick="removerCampo(this)">X</button>
            </div>
        </div>
    `;
    container.appendChild(div);
}

// Função para adicionar uma linha de medicamento
function adicionarMedicamento() {
    var container = document.getElementById('medicamentos-container');
    var div = document.createElement('div');
    div.className = "card card-body m-0 mb-2";
    div.innerHTML = `
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Medicamento Existente</label>
                <select name="medicamentos[]" class="form-control" required>
                    <option value="">Selecione um medicamento</option>
                    <?php
                    require_once('bd/bd_medicamento.php');
                    $medicamentos = listaMedicamentos();
                    foreach ($medicamentos as $medicamento) {
                        echo '<option value="'.$medicamento['cod'].'">'.htmlspecialchars($medicamento['nome']).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-danger form-control" onclick="removerCampo(this)">X</button>
            </div>
        </div>
    `;
    container.appendChild(div);
}

// Função para remover uma linha (campo)
function removerCampo(botao) {
    var container = botao.closest('.card');
    container.remove();
}
</script>

preciso fazer o backend salvar corretamente:
<?php
session_start();

// Requer os arquivos com as funções necessárias
require_once('bd/bd_agrupamento.php');   // Função: cadastraAgrupamento(), associaAnimalAgrupamento(), etc.
require_once('bd/bd_animal.php');         // Função: cadastraAnimal()
require_once('bd/bd_servico.php');        // Função: cadastraServico()
require_once('bd/bd_alimento.php');       // Função: cadastraAlimento()
require_once('bd/bd_medicamento.php');    // Função: cadastraMedicamento()

// Recebe o nome do agrupamento
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';

if (empty($nome)) {
    $_SESSION['texto_erro'] = "O nome do agrupamento é obrigatório.";
    header("Location: cad_agrupamento.php");
    exit;
}

// Cadastra o agrupamento e obtém o ID inserido
$agrupamento_id = cadastraAgrupamento($nome);
if (!$agrupamento_id) {
    $_SESSION['texto_erro'] = "Erro ao cadastrar agrupamento.";
    header("Location: cad_agrupamento.php");
    exit;
}

// Processa os animais (array de arrays)
if (isset($_POST['animais']) && is_array($_POST['animais'])) {
    foreach ($_POST['animais'] as $animal) {
        $identificador = isset($animal['identificador']) ? trim($animal['identificador']) : '';
        $quantidade    = isset($animal['quantidade']) ? (int)$animal['quantidade'] : 0;
        $peso          = isset($animal['peso']) ? (float)$animal['peso'] : 0;
        $fase          = isset($animal['fase']) ? trim($animal['fase']) : '';
        $sexo          = isset($animal['sexo']) ? trim($animal['sexo']) : '';
        $data          = isset($animal['data']) ? trim($animal['data']) : '';

        if ($identificador != '' && $quantidade > 0 && $peso > 0 && $fase != '' &&
            ($sexo == 'Macho' || $sexo == 'Fêmea') && $data != '') {

            // Cadastra o novo animal
            $novo_animal_id = cadastraAnimal($identificador, $quantidade, $peso, $fase, $sexo, $data);
            if ($novo_animal_id) {
                // Associa o animal ao agrupamento
                associaAnimalAgrupamento($agrupamento_id, $novo_animal_id);
            }
        }
    }
}

// Processa os serviços
if (isset($_POST['servicos']) && is_array($_POST['servicos'])) {
    foreach ($_POST['servicos'] as $servico) {
        $nome_servico = isset($servico['nome']) ? trim($servico['nome']) : '';
        $valor        = isset($servico['valor']) ? (float)$servico['valor'] : 0;
        $data         = isset($servico['data']) ? trim($servico['data']) : '';

        if ($nome_servico != '' && $valor > 0 && $data != '') {
            $novo_servico_id = cadastraServico($nome_servico, $valor, $data);
            if ($novo_servico_id) {
                associaServicoAgrupamento($agrupamento_id, $novo_servico_id);
            }
        }
    }
}

// Processa os alimentos
if (isset($_POST['alimentos']) && is_array($_POST['alimentos'])) {
    foreach ($_POST['alimentos'] as $alimento) {
        $nome_alimento = isset($alimento['nome']) ? trim($alimento['nome']) : '';
        $valor         = isset($alimento['valor']) ? (float)$alimento['valor'] : 0;
        $quantidade    = isset($alimento['quantidade']) ? (int)$alimento['quantidade'] : 0;
        $data          = isset($alimento['data']) ? trim($alimento['data']) : '';

        if ($nome_alimento != '' && $valor > 0 && $quantidade > 0 && $data != '') {
            $novo_alimento_id = cadastraAlimento($nome_alimento, $valor, $quantidade, $data);
            if ($novo_alimento_id) {
                associaAlimentoAgrupamento($agrupamento_id, $novo_alimento_id);
            }
        }
    }
}

// Processa os medicamentos
if (isset($_POST['medicamentos']) && is_array($_POST['medicamentos'])) {
    foreach ($_POST['medicamentos'] as $medicamento) {
        $nome_medicamento = isset($medicamento['nome']) ? trim($medicamento['nome']) : '';
        $valor            = isset($medicamento['valor']) ? (float)$medicamento['valor'] : 0;
        $quantidade       = isset($medicamento['quantidade']) ? (int)$medicamento['quantidade'] : 0;
        $data             = isset($medicamento['data']) ? trim($medicamento['data']) : '';

        if ($nome_medicamento != '' && $valor > 0 && $quantidade > 0 && $data != '') {
            $novo_medicamento_id = cadastraMedicamento($nome_medicamento, $valor, $quantidade, $data);
            if ($novo_medicamento_id) {
                associaMedicamentoAgrupamento($agrupamento_id, $novo_medicamento_id);
            }
        }
    }
}

$_SESSION['texto_sucesso'] = "Agrupamento cadastrado com sucesso.";
header("Location: agrupamento.php");
exit;
?>


<?php
require_once("conecta_bd.php");

/**
 * Cadastra um novo agrupamento e retorna o ID inserido.
 */
function cadastraAgrupamento($nome) {
    $conexao = conecta_bd();
    $query = "INSERT INTO agrupamento (nome) VALUES (?)";
    $stmt  = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 's', $nome);
    mysqli_stmt_execute($stmt);
    $agrupamento_id = mysqli_insert_id($conexao);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $agrupamento_id;
}

/**
 * Associa um animal ao agrupamento.
 */
function associaAnimalAgrupamento($agrupamento_id, $animal_id) {
    $conexao = conecta_bd();
    $query = "INSERT INTO agrupamento_animal (agrupamento_id, animal_id) VALUES (?, ?)";
    $stmt  = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $animal_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $result;
}

/**
 * Associa um serviço ao agrupamento.
 */
function associaServicoAgrupamento($agrupamento_id, $servico_id) {
    $conexao = conecta_bd();
    $query = "INSERT INTO agrupamento_servico (agrupamento_id, servico_id) VALUES (?, ?)";
    $stmt  = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $servico_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $result;
}

/**
 * Associa um alimento ao agrupamento.
 */
function associaAlimentoAgrupamento($agrupamento_id, $alimento_id) {
    $conexao = conecta_bd();
    $query = "INSERT INTO agrupamento_alimento (agrupamento_id, alimento_id) VALUES (?, ?)";
    $stmt  = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $alimento_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $result;
}

/**
 * Associa um medicamento ao agrupamento.
 */
function associaMedicamentoAgrupamento($agrupamento_id, $medicamento_id) {
    $conexao = conecta_bd();
    $query = "INSERT INTO agrupamento_medicamento (agrupamento_id, medicamento_id) VALUES (?, ?)";
    $stmt  = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $agrupamento_id, $medicamento_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    return $result;
}

function listaAgrupamentos() {
  $conexao = conecta_bd();
  $agrupamentos = array();
  $query = "SELECT * FROM agrupamento ORDER BY nome";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  
  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
      array_push($agrupamentos, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $agrupamentos;
}


function editaAgrupamento($agrupamento_id, $novo_nome) {
  $conexao = conecta_bd();
  $query = "UPDATE agrupamento SET nome = ? WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'si', $novo_nome, $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $dados = mysqli_stmt_affected_rows($stmt);

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $dados;
}

function deletaAgrupamento($agrupamento_id) {
  $conexao = conecta_bd();
  $query = "DELETE FROM agrupamento WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $dados = mysqli_stmt_affected_rows($stmt);

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $dados;
}
function listaAnimaisAgrupamento($agrupamento_id) {
  $conexao = conecta_bd();
  $animais = array();
  $query = "SELECT a.* FROM animal a
            INNER JOIN agrupamento_animal aa ON a.cod = aa.animal_id
            WHERE aa.agrupamento_id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);

  while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
      array_push($animais, $dados);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $animais;
}
function listaAgrupamentoPorId($agrupamento_id) {
  $conexao = conecta_bd();
  $query = "SELECT * FROM agrupamento WHERE id = ?";
  $stmt = mysqli_prepare($conexao, $query);
  mysqli_stmt_bind_param($stmt, 'i', $agrupamento_id);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

  mysqli_stmt_close($stmt);
  mysqli_close($conexao);
  return $dados;
}
?>

-- ====================================================
-- Script Completo para o banco de dados "controleanimais"
-- com relacionamento de agrupamento para animais, serviços,
-- alimentos e medicamentos.
-- ====================================================

-- (Opcional) Se quiser recriar o banco do zero, descomente a linha abaixo:
-- DROP DATABASE IF EXISTS `controleanimais`;

CREATE DATABASE IF NOT EXISTS `controleanimais` 
    DEFAULT CHARACTER SET utf8 
    COLLATE utf8_general_ci;
USE `controleanimais`;

-- ====================================================
-- Criação das Tabelas Principais
-- ====================================================

-- Tabela Agrupamento
CREATE TABLE IF NOT EXISTS `agrupamento` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Aluno
CREATE TABLE IF NOT EXISTS `aluno` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `curso` VARCHAR(100) NOT NULL,
    `ra` VARCHAR(100) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `senha` VARCHAR(100) NOT NULL,
    `cep` VARCHAR(8) NOT NULL,
    `endereco` VARCHAR(100) NOT NULL,
    `numero` VARCHAR(10) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `uf` VARCHAR(2) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `perfil` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Terceirizado
CREATE TABLE IF NOT EXISTS `terceirizado` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `telefone` VARCHAR(20) NOT NULL,
    `senha` VARCHAR(100) NOT NULL,
    `cep` VARCHAR(8) NOT NULL,
    `endereco` VARCHAR(100) NOT NULL,
    `numero` VARCHAR(10) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `uf` VARCHAR(2) NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `perfil` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Serviço
CREATE TABLE IF NOT EXISTS `servico` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `valor` DECIMAL(10,2) NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Animal
CREATE TABLE IF NOT EXISTS `animal` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `identificador` VARCHAR(100) NOT NULL,
    `quantidade` INT NOT NULL,
    `peso` DECIMAL(10,2) NOT NULL,
    `fase` VARCHAR(100) NOT NULL,
    `sexo` ENUM('Macho', 'Fêmea') NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Alimento
CREATE TABLE IF NOT EXISTS `alimento` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `valor` DECIMAL(10,2) NOT NULL,
    `quantidade` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Medicamento
CREATE TABLE IF NOT EXISTS `medicamento` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `valor` DECIMAL(10,2) NOT NULL,
    `quantidade` INT NOT NULL,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Usuário
CREATE TABLE IF NOT EXISTS `usuario` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `cep` VARCHAR(8) NOT NULL,
    `endereco` VARCHAR(100) NOT NULL,
    `numero` VARCHAR(10) NOT NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `uf` VARCHAR(2) NOT NULL,
    `perfil` INT NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Tabela Ordem de Serviço
CREATE TABLE IF NOT EXISTS `ordem` (
    `cod` INT NOT NULL AUTO_INCREMENT,
    `cod_aluno` INT NOT NULL,
    `cod_terceirizado` INT NOT NULL,
    `cod_servico` INT NOT NULL,
    `data_servico` DATE NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `data` DATE NOT NULL,
    PRIMARY KEY (`cod`),
    CONSTRAINT `fk_ordem_aluno` FOREIGN KEY (`cod_aluno`) REFERENCES `aluno` (`cod`) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_ordem_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servico` (`cod`) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_ordem_terceirizado` FOREIGN KEY (`cod_terceirizado`) REFERENCES `terceirizado` (`cod`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ====================================================
-- Criação das Tabelas de Relacionamento para Agrupamento
-- ====================================================
-- Cada join table liga um registro de agrupamento a um item da entidade correspondente.

-- Relacionamento entre Agrupamento e Animal
CREATE TABLE IF NOT EXISTS `agrupamento_animal` (
    `agrupamento_id` INT NOT NULL,
    `animal_id` INT NOT NULL,
    PRIMARY KEY (`agrupamento_id`, `animal_id`),
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`animal_id`) REFERENCES `animal`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Relacionamento entre Agrupamento e Serviço
CREATE TABLE IF NOT EXISTS `agrupamento_servico` (
    `agrupamento_id` INT NOT NULL,
    `servico_id` INT NOT NULL,
    PRIMARY KEY (`agrupamento_id`, `servico_id`),
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`servico_id`) REFERENCES `servico`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Relacionamento entre Agrupamento e Alimento
CREATE TABLE IF NOT EXISTS `agrupamento_alimento` (
    `agrupamento_id` INT NOT NULL,
    `alimento_id` INT NOT NULL,
    PRIMARY KEY (`agrupamento_id`, `alimento_id`),
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`alimento_id`) REFERENCES `alimento`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Relacionamento entre Agrupamento e Medicamento
CREATE TABLE IF NOT EXISTS `agrupamento_medicamento` (
    `agrupamento_id` INT NOT NULL,
    `medicamento_id` INT NOT NULL,
    PRIMARY KEY (`agrupamento_id`, `medicamento_id`),
    FOREIGN KEY (`agrupamento_id`) REFERENCES `agrupamento`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`medicamento_id`) REFERENCES `medicamento`(`cod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ====================================================
-- Inserções de Dados (Mantendo os Inserts Originais)
-- ====================================================

-- Inserção em Alimento
INSERT INTO `alimento` (`cod`, `nome`, `valor`, `quantidade`, `data`) VALUES
	(7, 'teste', 50.00, 1, '2024-09-04');

-- Inserção em Aluno
INSERT INTO `aluno` (`cod`, `nome`, `curso`, `ra`, `email`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `telefone`, `status`, `perfil`, `data`) VALUES
	(8, 'aluno1', 'curso1', '123', 'aluno1@gmail.com', 'a9f598a223a555dd4acaaa5a5a46a9e8', '37750000', 'aluno1', '11', 'aluno1', 'aluno1', 'MG', '16112341234', 1, 2, '2024-08-04');

-- Inserção em Animal
INSERT INTO `animal` (`cod`, `identificador`, `quantidade`, `peso`, `fase`, `sexo`, `data`) VALUES
    (9, '4564', 123, 102.00, 'amamentação', 'Fêmea', '2024-09-01'),
    (10, '255', 12, 250.00, 'criação', 'Macho', '2024-09-01');

-- Inserção em Medicamento
INSERT INTO `medicamento` (`cod`, `nome`, `valor`, `quantidade`, `data`) VALUES
	(7, 'medicamento teste1', 50.00, 1, '2024-09-04');

-- Inserção em Serviço
INSERT INTO `servico` (`cod`, `nome`, `valor`, `data`) VALUES
	(6, 'teste1', 50.00, '2024-09-01');

-- Inserção em Terceirizado
INSERT INTO `terceirizado` (`cod`, `nome`, `email`, `telefone`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `status`, `perfil`, `data`) VALUES
	(11, 'terceiro1', 'terceiro1@gmail.com', '(35) 99898-9898', 'c0cddf54f075bd5c5ecf419c0805db60', '37750000', 'terceiro1', '1', 'terceiro1', 'Machado', 'MG', 1, 3, '2024-08-07');

-- Inserção em Usuário
INSERT INTO `usuario` (`cod`, `nome`, `senha`, `email`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `perfil`, `status`, `data`) VALUES
	(32, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'teste@gmail.com', '37750000', 'teste', '2', 'Centro', 'Machado', 'MG', 1, 1, '2024-08-06');

-- Inserção em Ordem de Serviço
INSERT INTO `ordem` (`cod`, `cod_aluno`, `cod_terceirizado`, `cod_servico`, `data_servico`, `status`, `data`) VALUES
	(30, 8, 11, 6, '2024-09-04', 1, '2024-09-04');

-- ====================================================
-- Exemplo de Inserções para Relacionar Itens ao Agrupamento
-- ====================================================
-- 1. Insere um agrupamento
INSERT INTO `agrupamento` (`id`, `nome`) VALUES (1, 'Agrupamento Exemplo');

-- 2. Associa animais, serviços, alimentos e medicamentos ao agrupamento criado
INSERT INTO `agrupamento_animal` (`agrupamento_id`, `animal_id`) VALUES (1, 9), (1, 10);
INSERT INTO `agrupamento_servico` (`agrupamento_id`, `servico_id`) VALUES (1, 6);
INSERT INTO `agrupamento_alimento` (`agrupamento_id`, `alimento_id`) VALUES (1, 7);
INSERT INTO `agrupamento_medicamento` (`agrupamento_id`, `medicamento_id`) VALUES (1, 7);

