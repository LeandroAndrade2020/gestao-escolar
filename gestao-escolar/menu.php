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
		<p class="lead"> <i class="fas fa-user"></i> <?php echo htmlentities($nome); ?> </p>
		<b>RG: </b><?= htmlentities($_SESSION['rgPROF'])?>
		<div class="box mx-auto" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
			<a class='btn d-block btn-outline-success botao' href='calendario.php' role='button'>
				<i class='fas fa-clipboard-list'></i> Envios de atividades
			</a>
			<a class="btn d-block btn-outline-warning botao" href=ver_conteudo.php role="button"><i class="fas fa-list-alt"></i> Visualizar ou Editar atividades</a>
			<!-- <a class="btn d-block btn-outline-info botao" href=relatorio_geral.php role="button"><i class="fas fa-graduation-cap"></i> Gráficos e Relatórios</a> -->
			<a class="btn d-block btn-outline-danger botao" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
		</div>
	</body>
</html>