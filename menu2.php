<?php 
    
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };
    $nome = $_SESSION['nomePROF'];
	$serie = $_SESSION['seriePROF'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'includes/head.php'; ?>
</head>

<body class="menu mx-auto text-center">
	<div class="mt-3 mb-5">
		<h1 class="display-4">Bem-Vindo (a)</h1>
	</div>
	<p class="lead"> <i class="fas fa-user"></i> <?php echo $nome; ?> </p>
	<b>CIE: </b><?=$_SESSION['rgPROF']?>
	<div class="box mx-auto">
	<a class='btn d-block btn-outline-success' href='login_professor.php' role='button'> <i class='fas fa-clipboard-list'></i> Diário dos Professores</a>
	<a class="btn d-block btn-outline-primary" href=form_busca.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Aluno</a>
	<a class="btn d-block btn-outline-primary" href=view_conteudo3.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Professor</a>
	
		<!-- <a class="btn d-block btn-primary" href="notas.php" role="button">Lançar notas</a> -->

		<!-- <div class="dropdown" style="display:grid;">
			<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-graduation-cap"></i> Lançar notas
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="notas.php">Notas</a>
				<a class="dropdown-item" href="5_conceito.php">5° Conceito</a>

			</div>
		</div> -->

			<!-- <a class="btn d-block btn-secondary" href="observacoes.php" role="button"> <i class="fas fa-eye"></i> Lançar
				observações</a> -->

			<!--<div class="dropdown" style="display:grid;">
			<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-graduation-cap"></i> Visualizar Diário
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="d-none dropdown-item" href="ver_observacoes.php">Ver Observações</a>
				<a class="dropdown-item" href="ver_conteudo.php">Ver Conteúdo</a>
			 <a class="dropdown-item" href="faltas.php">Ver Faltas</a> -->
				

			<!--</div>
		</div>-->

		<a class="btn d-block btn-outline-danger" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
	</div>
</body>

</html>