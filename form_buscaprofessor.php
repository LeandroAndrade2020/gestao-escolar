<?php 
    include 'conecta_mysql.php';
    include 'crud/crud.php';
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };
    $nome = $_SESSION['nomePROF'];
	$serie = $_SESSION['seriePROF'];
	$escola = $_SESSION[''];
	$sql = "select * from professor where escola ='".$login.
    $result = $conexao->query($sql);
 
    if($go == true){
    $sql = "select * from professor where rg = '".$login."'";
    $consultas = $conexao->query($sql);
        
    foreach($consultas as $consulta){
        $_SESSION["nomePROF"] = $consulta['nome'];
        $_SESSION["escolaPROF"] = $consulta['escola'];
        $_SESSION["seriePROF"] = $consulta['serie'];
        $_SESSION["turmaPROF"] = $consulta['turma'];
        $_SESSION["discPROF"] = $consulta['disciplina'];
        $_SESSION["rgPROF"] = $consulta['rg'];
        $_SESSION["cod_classePROF"] = $consulta['codigo_classe'];
        };
    }else{
        $_SESSION["nomePROF"] = null;
        header('location: menu2.php');
    }
    
    $conexao->close();



?>


<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'includes/head.php'; ?>
</head>

<body class="menu container mx-auto text-center">
	<h1 class="display-4">BEM VINDO</h1>
	<p class="lead"> <i class="fas fa-user"></i> <?php echo $nome; ?> </p>
	<b>CIE: </b><?=$_SESSION['rgPROF']?>
	<div class="box mx-auto">
<?php
    $a = 0;
    $go = false ;
    if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if($row['rg'] == $login && $row['data_nascimento']==$senha){
				$go = true;
				for ($a=0; $a<($result->num_rows); $a++) {	
					echo "<a class='btn d-block btn-success' href='form.html' role='button'>
							 <i class='fas fa-clipboard-list'></i>
					$nome</a>";
				}   
        	}
		}
	}
	?>		

	<!--<a class="btn d-block btn-warning" href=form_busca.html role="button"> <i class="fas fa-list-alt"></i>Buscar ou Editar Aluno</a>
	<a class="btn d-block btn-warning" href=form_buscaprofessor.html role="button"> <i class="fas fa-list-alt"></i>Buscar ou Editar Professor</a>
	-->
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
				<!-- <a class="dropdown-item" href="faltas.php">Ver Faltas</a> -->
				

			<!--</div>
		</div>-->

		<a class="btn d-block btn-danger" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
	</div>
</body>

</html>