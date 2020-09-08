<!DOCTYPE html>
<html lang="pt-br">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

<?php 
	include 'includes/head.php';
?>
<!-- <div class="text-center m-5">
<h1>Sistema em Manutenção...</h1>
</div> -->
	<body class="text-center">
    <!--<h1 class="text-center">Sistema em manutenção!</h1>-->
		<div class="login-logo">				
			<img src="images/educacao.jpg" alt="Brasão de Caraguatatuba" width="180px" heigth="180px"/>	
		</div>

		<h3 class="display-4">Sistema de Registro de Atividades</h3>
		<form class="box row mx-auto" action="valida.php" method="POST">
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
				<input type="text" name="professor" class="form-control" placeholder="R.G ou CIE:" required/>
			</div><br>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-key icon"></i>
					</span>
				</div>
				<label for="start"></label>
				<input type="password" name="senha" class="form-control" placeholder="Senha:" required/>
			</div><br>
			<button type="submit" class="btn btn-outline-success"><span class="glyphicon glyphicon-off"></span> Login</button>
		</form>
	</body>
</html>