<?php 
    session_start();
    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }
    $nome  = $_SESSION['nomePROF'];
	$serie = $_SESSION['seriePROF'];
?>


<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>

	<body class="menu mx-auto text-center">
		<div class="mt-3 mb-5">
			<h1 class="display-4">Bem-Vindo (a)</h1>
		</div>
			<p class="lead"> <i class="fas fa-user"></i> <?php echo htmlentities($nome); ?> </p>
			<b>CIE: </b><?= htmlentities($_SESSION['rgPROF'])?>
			<div class="box mx-auto" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
			<a class='btn d-block btn-outline-success' href='login_professor.php' role='button'> <i class='fas fa-clipboard-list'></i> Diário dos Professores</a>
			<a class="btn d-block btn-outline-primary" href=form_busca.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Aluno</a>
			<a class="btn d-block btn-outline-primary" href=view_conteudo3.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Professor</a>

			<a class="btn d-block btn-outline-danger" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
		</div>
	</body>

</html>