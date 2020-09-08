<?php 
    include 'crud/crud.php';
    include 'conexaoPDO.php';
    session_cache_expire(60);
    session_start();

    $login = trim($_POST['professor']);
    $senha = trim($_POST['senha']);

    if(empty($login) || empty($senha)) {
        header('location: index.php');
    } else {
        try {
            $stmt = $conection->prepare("SELECT * FROM professor WHERE rg = :rg AND data_nascimento = :senha");
            $stmt->bindParam(':rg', $login, PDO::PARAM_INT);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $stmt->fetchAll();
            if(count($resultado)) {
                foreach($resultado as $row) {
                    $_SESSION["nomePROF"] = $row['nome'];
                    $_SESSION["escolaPROF"] = $row['escola'];
                    $_SESSION["seriePROF"] = $row['serie'];
                    $_SESSION["turmaPROF"] = $row['turma'];
                    $_SESSION["discPROF"] = $row['disciplina'];
                    $_SESSION["rgPROF"] = $row['rg'];
                }
                if($_SESSION['discPROF'] == 'ADM') {
                    header('location: menugestao.php');
                } else {
                    header('location: menu.php');
                }
            } else {
                header('location: index.php');
            }
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>