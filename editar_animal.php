<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once("bd/bd_animal.php");

$codigo = $_GET['cod'];
$dados = buscaAnimalEditar($codigo);
$identificador = $dados["identificador"];
$quantidade = $dados["quantidade"];
$peso = $dados["peso"];
$fase = $dados["fase"];
$sexo = $dados["sexo"];
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
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR DADOS DO ANIMAL</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="editar_animal_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?=$codigo?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Identificador </label>
                            <input type="text" class="form-control form-control-user" id="identificador" name="identificador" value="<?= $identificador ?>" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Quantidade </label>
                            <input type="text" class="form-control form-control-user" id="quantidade" name="quantidade" value="<?= $quantidade ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Peso </label>
                            <input type="text" class="form-control form-control-user" id="peso" name="peso" value="<?= $peso ?>" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Fase </label>
                            <input type="text" class="form-control form-control-user" id="fase" name="fase" value="<?= $fase ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label> Sexo </label>
                            <input type="text" class="form-control form-control-user" id="sexo" name="sexo" value="<?= $sexo ?>" required>
                        </div>
                    </div>

                    <div class="card-footer text-muted" id="btn-form">
                        <div class="text-right">
                            <a title="Voltar" href="animal.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar</button></a>
                            <a title="Atualizar"><button type="submit" name="updatebtn" class="btn btn-primary updatebtn"><i class="fas fa-edit">&nbsp;</i>Atualizar</button> </a>
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
