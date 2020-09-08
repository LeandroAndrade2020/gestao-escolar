<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    include('conexaoPDO.php');
    include('includes/head.php');

    $nome   = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];
    $dia    = $_POST['data'];

    $serie = explode(',', $_POST['serie']);

    try {
        $stmt = $conection->prepare("DELETE FROM atividades WHERE rg_professor = :rg AND escola = :escola AND dia = :dia AND serie = :serie 
            AND turma = :turma");
        $stmt->bindParam(':rg', $rg, PDO::PARAM_INT);
        $stmt->bindParam(':escola', $escola, PDO::PARAM_STR); 
        $stmt->bindParam(':dia', $dia, PDO::PARAM_STR);
        $stmt->bindParam(':serie', $serie[0], PDO::PARAM_INT);
        $stmt->bindParam(':turma', $serie[1], PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt2 = $conection->prepare("DELETE FROM conteudo where rg_professor = :rg AND escola = :escola AND dia = :dia AND serie = :serie 
            AND turma = :turma");
        $stmt2->bindParam(':rg', $rg, PDO::PARAM_INT);
        $stmt2->bindParam(':escola', $escola, PDO::PARAM_STR);
        $stmt2->bindParam(':dia', $dia, PDO::PARAM_STR);
        $stmt2->bindParam(':serie', $serie[0], PDO::PARAM_INT);
        $stmt2->bindParam(':turma', $serie[1], PDO::PARAM_STR);
        $stmt2->execute();
    ?>
            <div class="text-center m-5"> 
                <h2 class="text-center">Atividade excluída com sucesso!<h2><br>
                <a href="ver_conteudo.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Voltar</a>
            </div>
        <?php
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>