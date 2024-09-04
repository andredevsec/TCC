<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once("bd/bd_medicamento.php"); // Atualize o caminho para o arquivo correto

$codigo = $_GET['cod'];
$dados = buscaMedicamentoEditar($codigo);
$nome = $dados["nome"];
$valor = $dados["valor"];
$quantidade = $dados["quantidade"];
$data = date("Y-m-d", strtotime($dados["data"]));
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
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR DADOS DO MEDICAMENTO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="editar_medicamento_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?=$codigo?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Nome </label>
                            <input type="text" class="form-control form-control-user" id="nome" name="nome" value="<?= $nome ?>" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Valor </label>
                            <input type="text" class="form-control form-control-user" id="valor" name="valor" value="<?= $valor ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Quantidade </label>
                            <input type="text" class="form-control form-control-user" id="quantidade" name="quantidade" value="<?= $quantidade ?>" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Data </label>
                            <input type="date" class="form-control form-control-user" id="data" name="data" value="<?= $data ?>" required>
                        </div>
                    </div>

                    <div class="card-footer text-muted" id="btn-form">
                        <div class="text-right">
                            <a title="Voltar" href="medicamento.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar</button></a>
                            <a title="Atualizar"><button type="submit" name="updatebtn" class="btn btn-primary updatebtn"><i class="fas fa-edit">&nbsp;</i>Atualizar</button></a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('footer.php');
?>
