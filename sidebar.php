<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
		<div class="sidebar-brand-text mx-3"><img class="img-dashbord" src="img/favicon-alvina.png">Controle de animais
		</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">
	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="home.php">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Painel de Controle</span></a>
	</li>

	<?php
	if ($_SESSION['perfil'] == 1) {
		?>
		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="usuario.php">
				<i class="fa fa-user-circle"></i>
				<span>Usuários</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="animal.php">
			<i class="fas fa-paw"></i>
				<span>Animais</span></a>
				
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="agrupamento.php">
			<i class="fas fa-paw"></i>
				<span>Agrupamento</span></a>
				
		</li>

	
		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="alimento.php">
			<i class='fas fa-drumstick-bite'></i>
				<span>Alimentos</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="aluno.php">
				<i class="fas fa-fw fa-user"></i>
				<span>Alunos</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="medicamento.php">
			<i class="fa fa-medkit" aria-hidden="true"></i>
				<span>Medicamentos</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="terceirizado.php">
				<i class="fa fa-handshake"></i>
				<span>Terceirizados</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="servico.php">
				<i class="fas fa-fw fa-wrench"></i>
				<span>Serviços</span></a>
		</li>
		<!-- Divider -->
		<hr class="sidebar-divider my-0">
		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="ordem.php">
				<i class="fas fa-fw fa-clipboard-list"></i>
				<span>Gerar Ordem de Serviço</span></a>
		</li>


		<?php
	}
	?>

	<hr class="sidebar-divider my-0">
	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="contato.php">
			<i class="fa fa-envelope"></i>
			<span>Contato</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">