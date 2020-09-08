<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    include('includes/head.php');

    $nome   = $_SESSION['nomePROF'];
    // $escola = $_SESSION['escolaPROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];
    $dia    = $_POST['data'];

    // var_dump($_POST) . ' POST <br><br>';
    // var_dump($_SESSION) . 'SESSION <br>';

    $serie = explode(',', $_POST['serie']);

    include 'conecta_mysql.php';
    // Dados do form
    $sql = "delete from atividades where rg_professor = '$rg' and escola = '$escola' and dia = '$dia' and serie = '$serie[0]' 
        and turma = '$serie[1]'";
    $statusAtividades = $conexao->query($sql);
    // echo $sql . '<br><br>';

    $sql2 = "delete from conteudo where rg_professor = '$rg' and escola = '$escola' and dia = '$dia' and serie = '$serie[0]' 
        and turma = '$serie[1]'";
    $statusConteudo = $conexao->query($sql2);
    // echo $sql2 . '<br><br>';

    if($statusAtividades){
        ?>
        <div class="text-center m-5"> 
            <h2 class="text-center">Atividade excluída com sucesso!<h2><br>
            <a href="ver_conteudo.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Voltar</a>
        </div>
        <?php
    } else {
        echo "Erro, tente novamente mais tarde.";
    }
?>