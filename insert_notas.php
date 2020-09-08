<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome   = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];
    $dia    = $_POST['dia'];

       $serie    = $_POST['serie'];
    $turma    = $_POST['turma'];

    unset($_POST['conteudo']);
    unset($_POST['serie']);
    unset($_POST['turma']);
    unset($_POST['dia']);
    unset($_POST['escola']);

    include 'conecta_mysql.php';

    //Dados do form
    foreach($_POST as $ra => $aluno) {
        $verificar = "select * from atividades where ra = '$ra' and dia = '$dia' and rg_professor = '$rg'";
        $resultado = $conexao->query($verificar);

        if(mysqli_num_rows($resultado) >=1){
            $sqlUpdate = "update atividades set online = '$aluno[0]', impresso = '$aluno[1]', devolvido = '' where ra = '$ra' and dia='$dia' and rg_professor = '$rg'";
            $conexao->query($sqlUpdate);
        } else {
            $sql = "insert into atividades(ra,nome,rg_professor,online,impresso,devolvido,dia,serie,turma,escola) values('$ra','$aluno[2]','$rg','$aluno[0]','$aluno[1]','-','$dia','$serie','$turma','$escola')";
            $conexao->query($sql);
        }
    }

    // inserir conteudo
   
    //echo json_encode($_POST);
    header('Location: menu.php');
?>