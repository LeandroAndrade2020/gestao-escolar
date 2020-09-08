<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome   = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];
    $dia    = $_POST['dia'];

    $conteudo = $_POST['conteudo'];
    $serie    = $_POST['serie'];
    $turma    = $_POST['turma'];

    unset($_POST['conteudo']);
    unset($_POST['serie']);
    unset($_POST['turma']);
    unset($_POST['dia']);
    unset($_POST['escola']);

    
    try {
        include 'conexaoPDO.php';
        foreach($_POST as $ra => $aluno) {
            $stmt = $conection->prepare("SELECT * from atividades where ra = :ra and dia = :dia and rg_professor = :rg");
            $stmt->bindParam(':ra', $ra, PDO::PARAM_INT);
            $stmt->bindParam(':dia', $dia, PDO::PARAM_STR);
            $stmt->bindParam(':rg', $rg, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetchAll();
            if(count($resultado) >= 1) {
                $sqlUpdate = $conection->prepare("UPDATE atividades SET online = :aluno0, impresso = :aluno1, devolvido = '' WHERE ra = :ra AND dia = :dia 
                    AND rg_professor = :rg");
                $sqlUpdate->execute(array(
                    ':aluno0' => $aluno[0],
                    ':aluno1' => $aluno[1],
                    ':ra'     => $ra,
                    ':dia'    => $dia,
                    ':rg'     => $rg
                ));
            } else {
                $sql = $conection->prepare("INSERT INTO atividades(ra, nome, rg_professor, online, impresso, devolvido, dia, serie, turma, escola) 
                    VALUES(:ra, :aluno2, :rg ,:aluno0, :aluno1, '-', :dia, :serie, :turma, :escola)");
                $sql->execute(array(
                    ':ra'     => $ra,
                    ':aluno2' => $aluno[2],
                    ':rg'     => $rg,
                    ':aluno0' => $aluno[0],
                    ':aluno1' => $aluno[1],
                    ':dia'    => $dia,
                    ':serie'  => $serie,
                    ':turma'  => $turma,
                    ':escola' => $escola,
                ));
            }
        }
        
        $verificaC = $conection->prepare("SELECT * FROM conteudo WHERE rg_professor = :rg AND escola = :escola AND dia = :dia AND serie = :serie 
            AND turma = :turma");
        $verificaC->bindParam(':rg', $rg, PDO::PARAM_STR);
        $verificaC->bindParam(':escola', $escola, PDO::PARAM_STR);
        $verificaC->bindParam(':dia', $dia, PDO::PARAM_STR);
        $verificaC->bindParam(':serie', $serie, PDO::PARAM_STR);
        $verificaC->bindParam(':turma', $turma, PDO::PARAM_STR);
        $verificaC->execute();
        $resultado = $verificaC->fetchAll();
        
        if(count($resultado) >= 1) {
            $sqlUpdate = $conection->prepare("UPDATE conteudo SET conteudo = :conteudo WHERE rg_professor = :rg AND escola = :escola AND dia = :dia 
                AND serie = :serie AND turma = :turma");
            $sqlUpdate->execute(array(
                ':conteudo' => $conteudo,
                ':rg'       => $rg,
                ':escola'   => $escola,
                ':dia'      => $dia,
                ':serie'    => $serie,
                ':turma'    => $turma
            ));
        } else {
            $sql = $conection->prepare("INSERT INTO conteudo(rg_professor, escola, conteudo, turma, serie, dia) 
                VALUES(:rg, :escola, :conteudo, :turma, :serie, :dia)");
            $sql->execute(array(
                ':rg'       => $rg,
                ':escola'   => $escola,
                ':conteudo' => $conteudo,
                ':turma'    => $turma,
                ':serie'    => $serie,
                ':dia'      => $dia
            ));
        }
        header('Location: menu.php');
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>