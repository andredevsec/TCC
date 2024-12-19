<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
$grupo_id = $_GET['grupo_id'];
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php');?> 

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ANIMAIS DO AGRUPAMENTO</h6>
            </div>
            <div class="card-body">
                <form action="associa_animal_envia.php" method="post">
                    <input type="hidden" name="grupo_id" value="<?= $grupo_id ?>">
                    <div class="form-group">
                        <label>Escolha o Animal</label>
                        <select class="form-control" name="animal_id" required>
                            <?php
                            $animais = listaAnimais();
                            foreach($animais as $animal): ?>
                                <option value="<?= $animal['cod'] ?>"><?= $animal['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Associar Animal</button>
                </form>

                <h4 class="mt-4">Animais Associados</h4>
                <ul>
                    <?php 
                    $animais_agrupamento = listaAnimaisAgrupamento($grupo_id);
                    foreach($animais_agrupamento as $animal): ?>
                        <li><?= $animal['nome'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
