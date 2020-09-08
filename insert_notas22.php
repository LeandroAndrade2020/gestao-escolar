<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome   = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];
    $bimestre    = $_POST['bimestre'];

   
    $serie    = $_POST['serie'];
    $turma    = $_POST['turma'];

    unset($_POST['conteudo']);
    unset($_POST['serie']);
    unset($_POST['turma']);
    unset($_POST['bimestre']);
    unset($_POST['escola']);


    include 'conecta_mysql.php';

    //Dados do form
    foreach($_POST as $ra => $aluno)       
        {

        $verificar = "select * from nota_bimestre where ra = '$ra' and rg_professor = '$rg'";
        $resultado = $conexao->query($verificar);

        if(mysqli_num_rows($resultado) >=1){
            $sqlUpdate = "update nota_bimestre set diagnostico_1 = '$aluno[0]', diagnostico_2 = '$aluno[1]', 5_conceito = '$aluno[2]', nome = '$aluno[3]' where ra = '$ra' and rg_professor = '$rg'";
            $conexao->query($sqlUpdate);
        } else {
              $sql = "insert into nota_bimestre(ra,nome,rg_professor,bimestre,diagnostico_1, diagnostico_2, 5_conceito, porcentagem, escola, situacao, serie, turma) values('$ra','$aluno[3]','$rg','-','$aluno[0]','$aluno[1]','$aluno[2]','-', '$escola','-','$serie','$turma')";
            $conexao->query($sql);
        }

    }
    

header('Location: menu.php');
    //echo json_encode($_POST);
    
?>