 <?php
    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    }

    // Não sei para que serve , estava dando erro pois não encontra a sessão 'dia' :)
    // $nome = $_SESSION['nomePROF'];
    // $escola = $_SESSION['escolaPROF'];
    // $rg = $_SESSION['rgPROF'];
    // $dia = $_SESSION['dia'];
   
    $id = $_GET['id'];
   
include 'conecta_mysql.php';

    // Verifica se existe um registro no banco
    $registros = $conexao->query("select * from professor where id = '$id'")->num_rows;

    if($registros === 1){

        $conexao->query(


            
            "DELETE FROM professor  WHERE id = '$id'"
           );

    }

    header('Location: view_conteudo3.php');
  
?>

