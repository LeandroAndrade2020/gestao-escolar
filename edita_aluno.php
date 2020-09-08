 <?php
    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    }

    // var_dump($_POST);
    $escola = $_SESSION['escolaPROF'];

    $nome_aluno     = $_POST['nome'];
    $ra             = $_POST['ra'];
    $digito         = $_POST['digito'];
    $serie          = $_POST['serie'];
    $turma          = $_POST['turma'];
    $periodo        = $_POST['periodo'];
    $numero_chamada = $_POST['numero_chamada'];
    $situacao       = $_POST['situacao'];
    $data_situacao  = $_POST['data_situacao'];
    $id = $_POST['id'];

    include 'conecta_mysql.php';

    // Verifica se existe um registro no banco
    $registros = $conexao->query("select * from matricula where ra = '$ra'");

    $registros = $registros->num_rows;

    if($registros >= 1){
        $conexao->query(
            "UPDATE matricula SET
                nome           = '$nome_aluno', 
                digito         = '$digito', 
                escola         = '$escola', 
                serie          = '$serie', 
                turma          = '$turma', 
                periodo        = '$periodo', 
                numero_chamada = '$numero_chamada', 
                situacao       = '$situacao', 
                data_situacao  = '$data_situacao' 
                WHERE ra = '$ra' and escola = '$escola' and serie = '$serie' and turma = '$turma' and id = '$id'"
            );

    }

    // Não há necessidade de utilizar um laço de repetição
   //  foreach($_POST as $ra => $aluno)
   //  {
   //      echo $ra.'<br>';
   //      $verificar = "select * from matricula where ra = '$ra'";
   //      $resultado = $conexao->query($verificar);
   

   //      if(mysqli_num_rows($resultado) >=1){
   //          $sqlUpdate = "update matricula set nome = '$nome_aluno', digito = '$digito', escola = '$escola_2', serie = '$serie', turma = '$turma', periodo = '$periodo', numero_chamada = '$numero_chamada', situacao = '$situacao', data_situacao = '$data_situacao' where ra = '$ra'";
   //          $conexao->query($sqlUpdate);

   //      }
   // }

   echo " <form action='view_conteudo2.php' name='nome_do_seu_form'> 
   <input name='serie' type='hidden' value='$serie'>
   <input name='turma' type='hidden' value='$turma'></form>
   
    <input type='submit'  class='btn btn-danger' value='Apagar Professor'> 
   <script type='text/javascript'>
   document.nome_do_seu_form.submit()
   </script>";

?>