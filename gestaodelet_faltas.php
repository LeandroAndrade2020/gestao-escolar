<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
    $dia = $_SESSION['dia'];

    $conteudo = $_POST['conteudo'];
    $serie = $_POST['serie'];
    $turma = $_POST['turma'];

    unset($_POST['conteudo']);
    unset($_POST['serie']);
    unset($_POST['turma']);


    include 'conecta_mysql.php';
    // Dados do form
    $registros = $conexao->query("select * from atividades where ra = '$ra' and dia ='$dia' and rg_professor = $'rg' and escola = '$escola'")->num_rows;

    if($registros === 1){

        $conexao->query(
    
 

            
            "DELETE FROM atividades WHERE ra = '$ra' and dia ='$dia' and rg_professor = $'rg' and escola = '$escola'"
           );

    }

    
     echo " <form action='gestaoview_conteudo.php' name= 'gestaoview_conteudo'> 
<input name='serie' type='hidden' value='$serie'>
<input name='turma' type='hidden' value='$turma'>

 <input type='submit'  class='btn btn-danger' value='Apagar Professor'> 
<script type='text/javascript'>
document.gestaoview_conteudo.submit()
</script>";
  
?>

