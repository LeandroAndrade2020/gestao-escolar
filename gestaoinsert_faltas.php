<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome   = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];
    $dia    = $_SESSION['dia'];

    $conteudo = $_POST['conteudo'];
    $serie    = $_POST['serie'];
    $turma    = $_POST['turma'];

    unset($_POST['conteudo']);
    unset($_POST['serie']);
    unset($_POST['turma']);


    include 'conecta_mysql.php';
    // Dados do form

    

    foreach($_POST as $ra => $aluno) {
        $verificar = "select * from atividades where ra = '$ra' and dia = '$dia' and rg_professor = '$rg'";
        $resultado = $conexao->query($verificar);

        if(mysqli_num_rows($resultado) >=1){
            $sqlUpdate = "update atividades set online = '$aluno[0]', impresso = '$aluno[1]', devolvido = '', escola = '$escola' where ra = '$ra' and dia='$dia'";
            $conexao->query($sqlUpdate);
        } else {
           // echo $ra . $aluno[0] . '<hr>';
            $sql = "insert into atividades(ra,nome,rg_professor,online,impresso,devolvido,dia,serie,turma,escola) values('$ra','$aluno[2]','$rg','$aluno[0]','$aluno[1]','','$dia','$serie','$turma','$escola')";
            $conexao->query($sql);
        }
    }

    // inserir conteudo
    $verificaC = "select * from conteudo where rg_professor = '$rg' and escola = '$escola' and dia = '$dia' and serie = '$serie' and turma = '$turma'";
    $resultado = $conexao->query($verificaC);

    if(mysqli_num_rows($resultado) >=1) {
        $sqlUpdate = "update conteudo set conteudo = '$conteudo' where rg_professor = '$rg' and escola = '$escola' and dia = '$dia' and serie = '$serie' and turma = '$turma'";
        $conexao->query($sqlUpdate);
    } else {
        $sql = "insert into conteudo(rg_professor,escola,conteudo,turma,serie,dia) values('$rg','$escola', '$conteudo','$turma','$serie','$dia')";
        $conexao->query($sql);
    }

    header('Location: gestaomenuprofessor.php');
?>