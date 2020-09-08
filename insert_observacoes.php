<?php 
    include 'conecta_mysql.php';
    session_start();
    if(!isset($_SESSION['nomePROF'])){
    header('location: index.php');
    };
    $nome = $_SESSION['nomePROF'];

    $data = $_POST['data'];
    $escola = $_POST['escola'];
    $serie = explode(',',$_POST['serie']);

    $disciplina = $_POST['disciplina'];
    $observacao = $_POST['observacao'];
   // $sql =  "insert into observacao values ('12/04/2000','Emef alguma coisa','Abobrinha','8','c','O aluno fez merda vei')";
    $sql = "insert into observacao(data,escola,professor,disciplina,serie,turma,observacao) values ('$data','$escola','$nome','$disciplina','$serie[0]','$serie[1]','$observacao')";
    $conexao->query($sql);

    if($conexao){
        header('location: menu.php');

    }else{
        echo 'Recarregue a página, erro ao inserir observações !';
        
    }

?>