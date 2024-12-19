<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php');?> 

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">GERENCIAR AGRUPAMENTOS</h6>
                    </div>
                    <div class="col-md-4 card_button_title">
                        <a title="Adicionar Agrupamento" href="cad_agrupamento.php">
                            <button type="button" class="btn btn-primary btn-sm card_button_title">Adicionar Agrupamento</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Agrupamento</th>
                                <th>Visualizar Animais</th>
                                <th>Editar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            require_once('bd/bd_animal.php');
                            $agrupamentos = listaAgrupamentos();
                            foreach($agrupamentos as $grupo): 
                            ?>
                            <tr>
                                <td><?= $grupo['id'] ?></td>
                                <td><?= $grupo['nome'] ?></td>
                                <td class="text-center">
                                    <a href="visualiza_animais.php?grupo_id=<?= $grupo['id'] ?>" class="btn btn-sm btn-primary">Ver Animais</a>
                                </td>
                                <!-- Botão para Editar -->
                                <td class="text-center">
                                    <a href="edita_agrupamento.php?grupo_id=<?= $grupo['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                </td>
                                <!-- Formulário para Deletar -->
                                <td class="text-center">
                                    <form action="deleta_agrupamento.php" method="post" onsubmit="return confirm('Tem certeza que deseja deletar este agrupamento?');">
                                        <input type="hidden" name="grupo_id" value="<?= $grupo['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

