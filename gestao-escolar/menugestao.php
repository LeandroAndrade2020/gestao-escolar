<?php 
    include('conexaoPDO.php');   
    include 'crud/crud.php';
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    } 

    if($_SESSION['discPROF'] != 'ADM') {
        header('location: menu.php');
    }

    $nome   = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $escola = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');
    $rg     = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');
    $serie  = (isset($_SESSION['seriePROF']) && (!empty($_SESSION['seriePROF'])) ? $_SESSION['seriePROF'] : '');
    $escola = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');

    try {
        $stmt = $conection->prepare('SELECT rg, data_nascimento FROM professor WHERE nome = :escola');
        $stmt->bindParam(':escola', $escola, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetchAll();
        foreach($resultado as $row) {
            $_SESSION["cieESCOLA"] = $row['rg'];
            $_SESSION["telESCOLA"] = $row['data_nascimento'];
        }

        $cie = $_SESSION['cieESCOLA'];
        $tel = $_SESSION['telESCOLA'];
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
	<?php include 'includes/head.php'; ?>
    <body class="menu mx-auto text-center">
        <div class="mt-3 mb-4">
            <h1 class="display-4">Bem-Vindo (a)</h1>
        </div>
        <p class="lead"> <i class="fas fa-user"></i> <?php echo htmlentities($nome); ?> </p>
        <b>CIE: </b><?= htmlentities($cie)?>

        <div class="box mx-auto" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
            <a class='btn d-block btn-outline-success' href='login_professor.php' role='button'> <i class='fas fa-clipboard-list'></i> Diário dos Professores</a>
            <a class="btn d-block btn-outline-primary" href=form_busca.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Aluno</a>
            <a class="btn d-block btn-outline-primary" href=view_conteudo3.php role="button"> <i class="fas fa-list-alt"></i> Buscar ou Editar Professor</a>
            <a class="btn d-block btn-outline-danger" href="logout.php" role="button"> <i class="fas fa-power-off"></i> Sair</a>
        </div>
    </body>
</html>