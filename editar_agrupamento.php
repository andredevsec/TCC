<?php
require_once('header.php'); 
require_once('sidebar.php'); 
require_once('bd_animal.php');

$grupo_id = $_GET['grupo_id'];
$grupo = listaAgrupamentoPorId($grupo_id);  // Função que deve ser criada para buscar um agrupamento por ID
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php');?> 

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">EDITAR AGRUPAMENTO</h6>
            </div>
            <div class="card-body">
                <form action="edita_agrupamento_envia.php" method="post">
                    <input type="hidden" name="grupo_id" value="<?= $grupo['id'] ?>">
                    <div class="form-group">
                        <label>Nome do Agrupamento</label>
                        <input type="text" class="form-control" name="nome" value="<?= $grupo['nome'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
