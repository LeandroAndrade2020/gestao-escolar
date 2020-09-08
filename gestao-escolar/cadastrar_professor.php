<?php 
    // error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome   = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $escola = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');
    $rg     = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');

    $nome_professor  = (isset($_POST['nome']) && (!empty($_POST['nome'])) ? $_POST['nome'] : '');
    $rg              = (isset($_POST['rg']) && (!empty($_POST['rg'])) ? $_POST['rg'] : '');
    $data_nascimento = (isset($_POST['data_nascimento']) && (!empty($_POST['data_nascimento'])) ? $_POST['data_nascimento'] : '');
    $serie           = (isset($_POST['ano']) && (!empty($_POST['ano'])) ? $_POST['ano'] : '');
    $turma           = (isset($_POST['turma']) && (!empty($_POST['turma'])) ? $_POST['turma'] : '');
    $periodo         = (isset($_POST['periodo']) && (!empty($_POST['periodo'])) ? $_POST['periodo'] : '');
    $disciplina      = (isset($_POST['disciplina']) && (!empty($_POST['disciplina'])) ? $_POST['disciplina'] : '');

    if((empty($nome_professor)) || (empty($rg)) || (empty($data_nascimento))) {
        header('location: form_adicionar_prof.php');
    } else { 
        try {
            include('conexaoPDO.php');

            $stmt = $conection->prepare("INSERT INTO professor (rg, data_nascimento, nome, cie, escola, serie, turma, periodo, disciplina)
                VALUES(:rg, :data_nascimento, :nome_professor, '', :escola, :serie, :turma, :periodo, :disciplina)");
            $stmt->execute(array(
                ':rg'               => $rg,
                ':data_nascimento'  => $data_nascimento,
                ':nome_professor'   => $nome_professor,
                ':escola'           => $escola,
                ':serie'            => $serie,
                ':turma'            => $turma,
                ':periodo'          => $periodo,
                ':disciplina'       => $disciplina
            ));
            header('Location: view_conteudo3.php');
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>