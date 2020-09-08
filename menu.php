<?php 
    
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };
    $nome = $_SESSION['nomePROF'];
	$serie = $_SESSION['seriePROF'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php include 'includes/head.php'; ?>
</head>

<body class="menu mx-auto text-center">
	<h1 class="display-4">Bem-Vindo (a)</h1>
	<p class="lead"> <i class="fas fa-user"></i> <?php echo $nome; ?> </p>
	<b>RG: </b><?=$_SESSION['rgPROF']?>
	<div class="box mx-auto">
	<a class='btn d-block btn-outline-success botao' href='calendario.php' role='button'><i class='fas fa-clipboard-list'></i>
	Envios de atividades</a>
	<a class="btn d-block btn-outline-warning botao" href=ver_conteudo.php role="button"><i class="fas fa-list-alt"></i> Visualizar ou Editar atividades</a>
	<a class="btn d-block btn-outline-info botao" href=acompanhamento.php role="button"><i class="fas fa-graduation-cap"></i>Acompanhamento da Aprendizagem</a>
	
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

		<a class="btn d-block btn-outline-danger botao" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
	</div>
</body>

</html>