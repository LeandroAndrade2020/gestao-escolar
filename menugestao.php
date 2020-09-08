<?php 
    include 'conecta_mysql.php';   
    include 'crud/crud.php';
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    };

    $nome   = $_SESSION['nomePROF'];
	$serie  = $_SESSION['seriePROF'];
	$escola = $_SESSION['escolaPROF'];

    $sql = "select rg, data_nascimento from professor where nome = '$escola'";
    $result = $conexao->query($sql);

    foreach($result as $consulta2) {
        $_SESSION["cieESCOLA"] = $consulta2['rg'];
        $_SESSION["telESCOLA"] = $consulta2['data_nascimento'];
    }

    $cie = $_SESSION['cieESCOLA'];
    $tel = $_SESSION['telESCOLA'];
?>
<!DOCTYPE html>
<html lang="pt.br">

<head>
	<?php include 'includes/head.php'; ?>
</head>

<body class="menu mx-auto text-center">
	<div class="mt-3 mb-4">
		<h1 class="display-4">Bem-Vindo (a)</h1>
	</div>
	<p class="lead"> <i class="fas fa-user"></i> <?php echo $nome; ?> </p>
	<b>CIE: </b><?=$cie?>

	<div class="box mx-auto">
	<a class='btn d-block btn-outline-success' href='login_professor.php' role='button'> <i class='fas fa-clipboard-list'></i> Diário dos Professores</a>
	<a class="btn d-block btn-outline-primary" href=form_busca.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Aluno</a>
    <a class="btn d-block btn-outline-primary" href=view_conteudo3.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Professor</a>
    <a class="btn d-block btn-outline-primary" href=form_busca_grafico.php role="button"> <i class="fas fa-list-alt"></i> Grafico e relatórios</a>
	<a class="btn d-block btn-outline-danger" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
	</div>
</body>

</html>