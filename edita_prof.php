 <?php
    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    }
    
    $nome_professor  = $_POST['nome'];
    $id              = $_POST['id'];
    $rg              = $_POST['rg'];
    $escola_2        = $_POST['escola'];
    $serie           = $_POST['serie'];
    $turma           = $_POST['turma'];
    $data_nascimento = $_POST['data_nascimento'];
    $disciplina      = $_POST['disciplina'];
    
   include 'conecta_mysql.php';

    // Verifica se existe um registro no banco
    $registros = $conexao->query("select * from professor where id = '$id'")->num_rows;

    if($registros === 1) {
        $conexao->query(
            "UPDATE professor SET 
                nome            = '$nome_professor', 
                escola          = '$escola_2', 
                serie           = '$serie', 
                turma           = '$turma', 
                data_nascimento = '$data_nascimento', 
                rg              = '$rg', 
                disciplina      = '$disciplina' 
                WHERE id = '$id'"
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

    header('Location: view_conteudo3.php');
?>

