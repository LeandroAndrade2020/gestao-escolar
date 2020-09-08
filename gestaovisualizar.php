<?php 
    /** 
     * 
     *  Faltas = entregue online 
     * 
     * **/

    error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
</head>
<body class="m-3">
<form action="gestaoinsert_faltas.php" method="post">
<?php
    include_once('conecta_mysql.php');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }
    // Dados do form
    $nome_escola =  $_POST['escola'];
    $dia = $_POST['data'];
    $_SESSION['dia'] = $dia;
    $serie = explode(',',$_POST['serie']);

    $date = mb_substr($dia,0 ,2);
    if($date > 31){
        header('location: calendario.php');
    };
    
    $month = mb_substr($dia,2 ,2);
    if($month > 12){
        header('location: calendario.php');
    };
    
    // $year =mb_substr($senha,4 ,4);
    // if ($year != 2019 ) {
    //     header('location: calendario.php');
    // }

    // $disciplina = $_POST['disciplina'];
    $conteudo = $_POST['conteudo'];
    $cod_classe = $_SESSION['cod_classePROF'];
  $interacao = $_POST['interacao'];



    $sqlOb = "select * from matricula where escola = '$nome_escola' and serie = '$serie[0]' and turma = '$serie[1]'  order by nome asc ";
    $resultOb = $conexao->query($sqlOb);

    $sqlVerifica = "select * from atividades where escola = '$nome_escola' and serie = '$serie[0]' and turma = '$serie[1]' and dia ='$dia' "; 
    $resultVerifica = $conexao->query($sqlVerifica);

    if(mysqli_num_rows($resultVerifica) >= 1){
        $result = $resultVerifica;
        $edit = true;

    }
    else {
       $result = $resultOb;
       $edit= false ;
    }
 

    echo '<h1 id=escola>' . $nome_escola . '</h1>';
    echo '<b> RG do Professor: </b>'. '<span id=rgPROF>'.  $rg . '</span>' . '</span><br>';
    echo '<b> Dia selecionado: </b>'. '<span id=dia>'.  $dia . '</span>' . '</span><br>';
    echo '<b> Classe: </b>'. '<span id=serie>' .  $serie[0]. '</span>' . '°' . '<span id=turma>'.  $serie[1] . '</span>' . '<br>';
    // echo '<b> Disciplina: </b>'. '<span id=disciplina>'.  $disciplina . '</span>' . '<br>';

    // echo '<b> Conteúdo: </b>'.  '<span id=conteudo>'.  $conteudo. '</span>' . '<br>';
    echo '<b> Experiência / Habilidade: </b>'. "<input type='text' name='conteudo' value='$conteudo'>" . '<br>';


    echo "<input type='hidden' name='serie' value='$serie[0]'>";
    echo "<input type='hidden' name='turma' value='$serie[1]'>";
    


    if ($result->num_rows > 0) {
        echo "<table class='table table-hover'>"
        . '<tr>'
        . '<th>Nome</th>'
        . '<th>R.A</th>'
        . "<th>Interação</th>"
        . "<th>Situação</th>"
        . '</tr>';

        while($row = $result->fetch_assoc()) {
            echo '<tr>'
            .'<td>'.$row['nome'].'</td>'
            .'<td>'.$row['ra'].'</td>'

            . "<th> <select name=\"{$row['ra']}[]\" > <option>". (isset($row['online']) ? $row['online'] : '-') ." </option> <option>Facebook</option>  <option>Whatsapp</option>  <option>Outro</option>  <option>Classroom</option>   <option>Aula</option> <option>Impresso</option> </select> </th>"
            
            . "<th> <select name=\"{$row['ra']}[]\" > <option>". (isset($row['impresso']) ? $row['impresso'] : '-')."</option> <option>Não Devolvido</option><option>Devolvido</option> <option>C</option> <option>F</option>   </select>  </th>"
           
            . "<th class='d-none'> <select name=\"{$row['ra']}[]\" > <option>{$row['nome']}</option> </select> </th>"

            . '</tr>';
        }
        echo '</table>';
    } else {
        echo "Turma não encontrada <br>";
    }

    $conexao->close();
    ?>
    <input class="btn btn-primary" type="submit" value="Terminar e enviar">
    <a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>
</form>



    <script>
    $(document).ready(function() {
        // Dados do formulário
        var conteudo = $('#conteudo').text();
        var dia = $('#dia').text();
        var serie =  $('#serie').text();
        var turma =  $('#turma').text();
        var escola =  $('#escola').text();
        var rg_professor = $('#rgPROF').text();

        $("#terminar_chamada").click(function(){

        });
    });
</script>

</body>
</html>