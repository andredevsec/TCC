<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');

// Inclui as funções de agrupamento e dos itens associados
require_once('bd/bd_agrupamento.php');
require_once('bd/bd_animal.php');
require_once('bd/bd_servico.php');
require_once('bd/bd_alimento.php');
require_once('bd/bd_medicamento.php');

// Variáveis de controle
$isEdit = false;
$agrupamento = [];
$animaisAssociados = [];
$servicosAssociados = [];
$alimentosAssociados = [];
$medicamentosAssociados = [];

// Se for passado um ID via GET, estamos editando
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $agrupamento_id = intval($_GET['id']);
    $agrupamento = listaAgrupamentoPorId($agrupamento_id);
    if ($agrupamento) {
        $isEdit = true;
        $animaisAssociados = listaAnimaisAgrupamento($agrupamento_id);
        $servicosAssociados = listaServicosAgrupamento($agrupamento_id);
        $alimentosAssociados = listaAlimentosAgrupamento($agrupamento_id);
        $medicamentosAssociados = listaMedicamentosAgrupamento($agrupamento_id);
    } else {
        $_SESSION['texto_erro'] = "Agrupamento não encontrado.";
        header("Location: agrupamento.php");
        exit;
    }
}
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php'); ?>

    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <!-- Muda o título conforme a ação -->
                <h6 class="m-0 font-weight-bold text-primary" id="title">
                    <?= $isEdit ? "Editar Agrupamento" : "Vincular Novo Agrupamento"; ?>
                </h6>
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
                <!-- Observe que o formulário sempre envia para o mesmo script.
                     O _backend_ deverá verificar se existe o campo "agrupamento_id"
                     para decidir se atualiza ou insere -->
                <form action="cad_agrupamento_envia.php" method="post">
                    <!-- Se for edição, envia o ID do agrupamento -->
                    <?php if ($isEdit): ?>
                        <input type="hidden" name="agrupamento_id" value="<?= $agrupamento['id']; ?>">
                    <?php endif; ?>

                    <!-- Nome do Agrupamento -->
                    <div class="form-group">
                        <label>Nome do Agrupamento</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome do agrupamento" required
                            value="<?= $isEdit ? htmlspecialchars($agrupamento['nome']) : ''; ?>">
                    </div>

                    <hr>
                    <!-- Seção de Animais -->
                    <h4>Animais</h4>
                    <!-- Container onde serão exibidos os animais adicionados -->
                    <div id="animais-container">
                        <?php if ($isEdit && !empty($animaisAssociados)): ?>
                            <?php foreach ($animaisAssociados as $animal): ?>
                                <div class="alert alert-secondary d-flex justify-content-between align-items-center mt-2">
                                    <span><?= htmlspecialchars($animal['identificador']); ?></span>
                                    <input type="hidden" name="animais[]" value="<?= $animal['cod']; ?>">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="removerAnimal(this, '<?= $animal['cod']; ?>', '<?= htmlspecialchars($animal['identificador']); ?>')">X</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <label>Adicionar Animal</label>
                        <div class="d-flex">
                            <!-- Select principal de animais -->
                            <select id="animal-select" class="form-control mr-2">
                                <option value="">Selecione um animal</option>
                                <?php
                                // Lista todos os animais disponíveis.
                                // Se estiver editando, você poderá querer remover do select os que já foram adicionados.
                                $animais = listaAnimais();
                                foreach ($animais as $animal) {
                                    // Opcional: você pode pular os animais já associados
                                    if ($isEdit && in_array($animal['cod'], array_column($animaisAssociados, 'cod'))) {
                                        continue;
                                    }
                                    echo '<option value="' . $animal['cod'] . '">' . htmlspecialchars($animal['identificador']) . '</option>';
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-primary" onclick="adicionarAnimal()">Adicionar</button>
                        </div>
                    </div>

                    <hr>
                    <!-- Seção de Serviços -->
                    <h4>Serviços</h4>
                    <div id="servicos-container">
                        <?php if ($isEdit && !empty($servicosAssociados)): ?>
                            <?php foreach ($servicosAssociados as $servico): ?>
                                <div class="alert alert-secondary d-flex justify-content-between align-items-center mt-2">
                                    <span><?= htmlspecialchars($servico['nome']); ?></span>
                                    <input type="hidden" name="servicos[]" value="<?= $servico['cod']; ?>">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="removerServico(this, '<?= $servico['cod']; ?>', '<?= htmlspecialchars($servico['nome']); ?>')">X</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <label>Adicionar Serviço</label>
                        <div class="d-flex">
                            <select id="servico-select" class="form-control mr-2">
                                <option value="">Selecione um serviço</option>
                                <?php
                                $servicos = listaServicos();
                                foreach ($servicos as $servico) {
                                    echo '<option value="' . $servico['cod'] . '">' . htmlspecialchars($servico['nome']) . '</option>';
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-primary"
                                onclick="adicionarServico()">Adicionar</button>
                        </div>
                    </div>

                    <hr>
                    <!-- Seção de Alimentos -->
                    <h4>Alimentos</h4>
                    <div id="alimentos-container">
                        <?php if ($isEdit && !empty($alimentosAssociados)): ?>
                            <?php foreach ($alimentosAssociados as $alimento): ?>
                                <div class="alert alert-secondary d-flex justify-content-between align-items-center mt-2">
                                    <span><?= htmlspecialchars($alimento['nome']); ?></span>
                                    <input type="hidden" name="alimentos[]" value="<?= $alimento['cod']; ?>">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="removerAlimento(this, '<?= $alimento['cod']; ?>', '<?= htmlspecialchars($alimento['nome']); ?>')">X</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <label>Adicionar Alimento</label>
                        <div class="d-flex">
                            <select id="alimento-select" class="form-control mr-2">
                                <option value="">Selecione um alimento</option>
                                <?php
                                $alimentos = listaAlimentos();
                                foreach ($alimentos as $alimento) {
                                    echo '<option value="' . $alimento['cod'] . '">' . htmlspecialchars($alimento['nome']) . '</option>';
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-primary"
                                onclick="adicionarAlimento()">Adicionar</button>
                        </div>
                    </div>

                    <hr>
                    <!-- Seção de Medicamentos -->
                    <h4>Medicamentos</h4>
                    <div id="medicamentos-container">
                        <?php if ($isEdit && !empty($medicamentosAssociados)): ?>
                            <?php foreach ($medicamentosAssociados as $medicamento): ?>
                                <div class="alert alert-secondary d-flex justify-content-between align-items-center mt-2">
                                    <span><?= htmlspecialchars($medicamento['nome']); ?></span>
                                    <input type="hidden" name="medicamentos[]" value="<?= $medicamento['cod']; ?>">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="removerMedicamento(this, '<?= $medicamento['cod']; ?>', '<?= htmlspecialchars($medicamento['nome']); ?>')">X</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <label>Adicionar Medicamento</label>
                        <div class="d-flex">
                            <select id="medicamento-select" class="form-control mr-2">
                                <option value="">Selecione um medicamento</option>
                                <?php
                                $medicamentos = listaMedicamentos();
                                foreach ($medicamentos as $medicamento) {
                                    echo '<option value="' . $medicamento['cod'] . '">' . htmlspecialchars($medicamento['nome']) . '</option>';
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-primary"
                                onclick="adicionarMedicamento()">Adicionar</button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Valor Abate</label>
                        <div class="d-flex">
                            <input type="text" class="form-control mr-2" id="valor_abate" name="valor_abate"
                                placeholder="Valor do abate"
                                value="<?= $isEdit ? htmlspecialchars($agrupamento['valor_abate']) : ''; ?>">

                        </div>
                    </div>

                    <!-- Botão de Enviar -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-fw fa-link"></i>
                            <?= $isEdit ? "Atualizar Agrupamento" : "Vincular Agrupamento"; ?>
                        </button>
                    </div>
                </form>
                <!-- Fim do Formulário -->
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

<!-- Bloco de script com as funções (as mesmas utilizadas na versão de cadastro) -->
<script>
    /* =======================
       FUNÇÕES PARA ANIMAIS
       ======================= */
    function adicionarAnimal() {
        var select = document.getElementById('animal-select');
        var selectedOption = select.options[select.selectedIndex];

        if (selectedOption.value === "") {
            alert("Selecione um animal válido!");
            return;
        }

        var container = document.getElementById('animais-container');
        var div = document.createElement('div');
        div.className = "alert alert-secondary d-flex justify-content-between align-items-center mt-2";
        div.innerHTML = `
            <span>${selectedOption.text}</span>
            <input type="hidden" name="animais[]" value="${selectedOption.value}">
            <button type="button" class="btn btn-danger btn-sm" onclick="removerAnimal(this, '${selectedOption.value}', '${selectedOption.text}')">X</button>
        `;
        container.appendChild(div);

        // Remove o animal selecionado do select para evitar duplicatas
        select.remove(select.selectedIndex);
        select.selectedIndex = 0;
    }

    function removerAnimal(button, value, text) {
        var div = button.parentElement;
        div.remove();

        // Reinsere o animal no select principal
        var select = document.getElementById('animal-select');
        var option = document.createElement("option");
        option.value = value;
        option.text = text;
        select.add(option);
    }

    /* =======================
       FUNÇÕES PARA SERVIÇOS
       ======================= */
    function adicionarServico() {
        var select = document.getElementById('servico-select');
        var selectedOption = select.options[select.selectedIndex];

        if (selectedOption.value === "") {
            alert("Selecione um serviço válido!");
            return;
        }

        var container = document.getElementById('servicos-container');
        var div = document.createElement('div');
        div.className = "alert alert-secondary d-flex justify-content-between align-items-center mt-2";
        div.innerHTML = `
            <span>${selectedOption.text}</span>
            <input type="hidden" name="servicos[]" value="${selectedOption.value}">
            <button type="button" class="btn btn-danger btn-sm" onclick="removerServico(this, '${selectedOption.value}', '${selectedOption.text}')">X</button>
        `;
        container.appendChild(div);

        select.selectedIndex = 0;
    }
    function salvarValorAbate() {
        var field = document.getElementById('valor_abate');
        var valor = field.value;
        var container = document.getElementById('animais-container');
        var div = document.createElement('div');
        div.className = "alert alert-secondary d-flex justify-content-between align-items-center mt-2";
        div.innerHTML = `
            <span>Valor do abate: ${valor}</span>
            <input type="hidden" name="valor_abate" value="${valor}">
        `;
        container.appendChild(div);
    }

    function removerServico(button, value, text) {
        var div = button.parentElement;
        div.remove();
    }

    /* =======================
       FUNÇÕES PARA ALIMENTOS
       ======================= */
    function adicionarAlimento() {
        var select = document.getElementById('alimento-select');
        var selectedOption = select.options[select.selectedIndex];

        if (selectedOption.value === "") {
            alert("Selecione um alimento válido!");
            return;
        }

        var container = document.getElementById('alimentos-container');
        var div = document.createElement('div');
        div.className = "alert alert-secondary d-flex justify-content-between align-items-center mt-2";
        div.innerHTML = `
            <span>${selectedOption.text}</span>
            <input type="hidden" name="alimentos[]" value="${selectedOption.value}">
            <button type="button" class="btn btn-danger btn-sm" onclick="removerAlimento(this, '${selectedOption.value}', '${selectedOption.text}')">X</button>
        `;
        container.appendChild(div);

        select.selectedIndex = 0;
    }

    function removerAlimento(button, value, text) {
        var div = button.parentElement;
        div.remove();
    }

    /* =======================
       FUNÇÕES PARA MEDICAMENTOS
       ======================= */
    function adicionarMedicamento() {
        var select = document.getElementById('medicamento-select');
        var selectedOption = select.options[select.selectedIndex];

        if (selectedOption.value === "") {
            alert("Selecione um medicamento válido!");
            return;
        }

        var container = document.getElementById('medicamentos-container');
        var div = document.createElement('div');
        div.className = "alert alert-secondary d-flex justify-content-between align-items-center mt-2";
        div.innerHTML = `
            <span>${selectedOption.text}</span>
            <input type="hidden" name="medicamentos[]" value="${selectedOption.value}">
            <button type="button" class="btn btn-danger btn-sm" onclick="removerMedicamento(this, '${selectedOption.value}', '${selectedOption.text}')">X</button>
        `;
        container.appendChild(div);
        select.selectedIndex = 0;
    }

    function removerMedicamento(button, value, text) {
        var div = button.parentElement;
        div.remove();
    }
</script>