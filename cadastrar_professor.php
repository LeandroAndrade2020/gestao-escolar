<?php 
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome   = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg     = $_SESSION['rgPROF'];

    $nome_professor  = $_POST['nome'];
    $rg              = $_POST['rg'];
    $data_nascimento = $_POST['data_nascimento'];
    $serie           = $_POST['ano'];
    $turma           = $_POST['turma'];
    $periodo         = $_POST['periodo'];
    $disciplina      = $_POST['disciplina'];

    if((empty($nome_professor)) || (empty($rg)) || (empty($data_nascimento))) {
        header('location: form_adicionar_prof.php');
    } else {
        include 'conecta_mysql.php';
    
        $sql = "insert into professor (rg,data_nascimento,nome,cie,escola,serie,turma,periodo,disciplina) 
            values('$rg','$data_nascimento','$nome_professor','','$escola','$serie','$turma','$periodo','$disciplina')";
        $conexao->query($sql);
    
        header('Location: view_conteudo3.php');
    }
?>