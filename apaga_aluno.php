 <?php
    include('includes/head.php');
    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    }

    $ra     = $_POST['ra'];
    $serie  = $_POST['serie'];
    $turma  = $_POST['turma'];
    $escola = $_POST['escola'];
    $id     = $_POST['id'];
   
    include 'conecta_mysql.php';

    $registros = $conexao->query("select * from matricula where ra = '$ra'")->num_rows;

    if($registros >= 1) {
        $conexao->query("DELETE FROM matricula  WHERE ra = '$ra' and escola = '$escola' and turma = '$turma' and serie = '$serie' and id = '$id'");
        // $sqlteste = ("DELETE FROM matricula  WHERE ra = '$ra' and escola = '$escola' and turma = '$turma' and serie = '$serie'");
        // echo $sqlteste . '<br><br>';
    } else {
        echo 'Erro. Tente novamente mais tarde!';
    }

    echo " <form action='view_conteudo2.php' name='nome_do_seu_form'> 
    <input name='serie' type='hidden' value='$serie'>
    <input name='turma' type='hidden' value='$turma'></form>
    
     <input type='submit'  class='btn btn-danger' value='Apagar Professor'> 
    <script type='text/javascript'>
    document.nome_do_seu_form.submit()
    </script>";
?>