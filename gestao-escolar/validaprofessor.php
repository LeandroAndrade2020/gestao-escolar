<?php 
    include("conexaoPDO.php");
    
    include 'crud/crud.php';
    session_cache_expire(60);
    session_start();

    $login = (isset($_POST['professor']) && (!empty($_POST['professor'])) ? $_POST['professor'] : '');
    $senha = (isset($_POST['senha']) && (!empty($_POST['senha'])) ? $_POST['senha'] : '');

    try {
        $stmt = $conection->prepare("SELECT * FROM professor WHERE rg = :rg AND data_nascimento = :senha");
        $stmt->bindParam(':rg', $login, PDO::PARAM_INT);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetchAll();

        $a = 0;
        $go = false;
        if(count($resultado)) {
            foreach($resultado as $row) {
                if($row['rg'] == $login && $row['data_nascimento'] == $senha) {
                    $go = true;
                }
            }    
        }

        if($go == true) {
            $stmtConsulta = $conection->prepare("SELECT * FROM professor WHERE rg = :login");
            $stmtConsulta->bindParam(':login', $login, PDO::PARAM_STR);
            $stmtConsulta->execute();
            $resultadoConsulta = $stmtConsulta->fetchAll();
            
            foreach($resultadoConsulta as $row) {
                $_SESSION["nomePROF"]   = $row['nome'];
                $_SESSION["escolaPROF"] = $row['escola'];
                $_SESSION["seriePROF"]  = $row['serie'];
                $_SESSION["turmaPROF"]  = $row['turma'];
                $_SESSION["discPROF"]   = $row['disciplina'];
                $_SESSION["rgPROF"]     = $row['rg'];
            }
            if ($_SESSION["discPROF"] == "ADM") {
                header('location: menu2.php');
            } else {
                header('location: menu3.php');
            }
        } else {
            $_SESSION["nomePROF"] = null;
            header('location: index.php');
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>