<?php 
    include 'conecta_mysql.php';   
        include 'crud/crud.php';
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };
    $nome = $_SESSION['nomePROF'];
	$serie = $_SESSION['seriePROF'];
	$escola = $_SESSION['escolaPROF'];
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'includes/head.php'; ?>
</head>

<body class="menu mx-auto text-center">
	<h1 class="display-4">Bem-Vindo (a)</h1>
	<p class="lead"> <i class="fas fa-user"></i> <?php echo $nome; ?> </p>
	<b>RG: </b><?=$_SESSION['rgPROF']?>
	<div class="box mx-auto">
	<a class='btn d-block btn-outline-success' href='calendario.php' role='button'> <i class='fas fa-clipboard-list'></i>
	Envios de atividades</a>
	<a class="btn d-block btn-outline-warning" href=ver_conteudo.php role="button"> <i class="fas fa-list-alt"></i> Visualizar ou Editar atividades</a>
	<a class="btn d-block btn-outline-info" href=relatorio_geral.php role="button"> <i class="fas fa-graduation-cap"></i>Gráficos e Relatórios</a>

<!--  <a class="btn d-block btn-outline-danger" href="validaescola.php" role="button"> <i class="fas fa-power-off"></i> Voltar para Escola</a> -->
    <table class='table table-hover'>

    <?php 
            echo '<tr>';
       
                echo "<td> <form action='valida.php'  method='post'> 
                     <input name='professor' type='hidden' value='{$_SESSION['cieESCOLA']}'>
                                     <input name='senha' type='hidden' value='{$_SESSION['telESCOLA']}'>
                    <input type='submit' class='btn btn-outline-danger' value='Voltar para Escola'> 
                    </form> 
                    </td>";
            echo '</tr>';
    echo '</table>';
    ?>

		</div>
	</form>
	</div>
</body>

</html>