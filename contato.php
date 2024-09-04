<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">CONTATO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['texto_erro'])) :
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['texto_erro']);
                endif;
                ?>

                <?php
                if (isset($_SESSION['texto_sucesso'])) :
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['texto_sucesso']);
                endif;
                ?>

                <form class="user" action="mail.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Nome Completo </label>
                        <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= isset($_SESSION['nome_usu']) ? htmlspecialchars($_SESSION['nome_usu']) : '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label> Email </label>
                        <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= isset($_SESSION['email_usu']) ? htmlspecialchars($_SESSION['email_usu']) : '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label> Assunto </label>
                        <input type="text" class="form-control form-control-user" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label> Mensagem </label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label> Selecione um arquivo </label>
                        <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif,.mp3,.wav,.ogg,.mp4,.avi,.mov,.zip,.rar">
                    </div>

                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="home.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <a title="Enviar"><button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fa fa-envelope">&nbsp;</i>Enviar</button> </a>
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