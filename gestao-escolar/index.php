<!DOCTYPE html>
<html lang="pt-br">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<?php 
	include 'includes/head.php';
	if(isset($_SESSION)) {
		session_destroy();
	}
?>
<!-- <div class="text-center m-5">
	<h1 class="display-4">Sistema em Manutenção Programada...</h1>
	<h4>Dia 28 de Agosto, das 16 às 23 horas</h4>
</div> -->

<body class="text-center">

	<div class="login-logo">
		<img src="images/educacao.jpg" alt="Brasão de Caraguatatuba" width="180px" heigth="180px" />
	</div>

	<h3 class="display-4">Sistema de Registro de Atividades</h3>
	<form class="box row mx-auto mt-5" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);" action="valida.php"
		method="POST">
		<div class="container">
			<div class="text-center">
				<h1 class="lead mb-3"><i class="fa fa-lock" aria-hidden="true"></i> Login</h1>
			</div>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-user-tie"></i>
					</span>
				</div>
				<input type="text" name="professor" class="form-control" placeholder="R.G ou CIE:" required />
			</div><br>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-key icon"></i>
					</span>
				</div>
				<label for="start"></label>
				<input type="password" name="senha" class="form-control" placeholder="Senha:" required />
			</div><br>
			<button type="submit" class="btn btn-outline-success"><span class="glyphicon glyphicon-off"></span>
				Login</button>
		</div>
	</form>
	
	<?php include('includes/footer.php')?>
	<!-- Alert de avisos  -->
	<!-- <div class="alert alert-danger alert-dismissible fade show mt-5 text-center" role="alert">
			<strong>Importante: </strong> Será realizada uma atualização de segurança no dia 28 de Agosto, das 15 às 23 horas, portanto o sistema ficará indisponível neste período.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div> -->
</body>

</html>