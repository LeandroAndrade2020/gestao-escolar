 <?php 

 error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $nome_escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
    $serie = $_GET['serie'];
    $turma = $_GET['turma'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
</head>


<div class="container" style="max-width: 800px;">
    <div class="mt-4 mb-4">
      
    </div>

    <div style="background-color: rgba(0,0,0,.05); border-radius: 15px; padding: 20px;">



<table class='table table-hover'>
    <tr>
    <th>Dados da turma <?php echo $serie;  echo $turma; ?> </th>
    <!-- <th>Disciplina</th> -->

    
	<?php
    include_once('conecta_mysql.php');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

//$nome_escola

?>


<div class="container" style="max-width: 800px;">
    <div class="mt-4 mb-4">

  <?php



if ($result1_turma = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and impresso = 'Devolvido' and serie = '$serie' and turma = '$turma'")) {

    /* determine number of rows result set */
   $devolvida_turma = $result1_turma->num_rows;

    printf("<table class='table table-hover'>

  <tr> <b>%d</b> atividades entregues.\n ",$devolvida_turma);


    /* close result set */
    $result1_turma->close();
}



 if ($result2_turma = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and impresso != 'Devolvido'  and serie = '$serie' and turma = '$turma'")) {

    /* determine number of rows result set */
    $ndevolvida_turma = $result2_turma->num_rows;

    printf("<br><b>%d</b> atividades não entregues.\n", $ndevolvida_turma);


    /* close result set */
    $result2_turma->close();
}

    if ($result3_turma = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Impresso' and serie = '$serie' and turma = '$turma'")) {

    /* determine number of rows result set */
    $impresso_turma = $result3_turma->num_rows;

    printf("<br><b>%d</b> atividades impressas.\n", $impresso_turma);


    /* close result set */
    $result3_turma->close();
}




    if ($result5_turma = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Facebook' and serie = '$serie' and turma = '$turma'")) {

    /* determine number of rows result set */
    $facebook_turma = $result5_turma->num_rows;

    printf("<br><b>%d</b> fizeram atividade via facebook.\n", $facebook_turma);


    /* close result set */
    $result5_turma->close();
}


    if ($result6_turma = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Whatsapp' and serie = '$serie' and turma = '$turma'")) {

    /* determine number of rows result set */
    $whatsapp_turma = $result6_turma->num_rows;

    printf("<br><b>%d</b> fizeram atividades via Whatsapp.\n", $whatsapp_turma);


    /* close result set */
    $result6_turma->close();
}


    if ($result7_turma = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Outro' and serie = '$serie' and turma = '$turma'")) {

    /* determine number of rows result set */
    $outro_turma = $result7_turma->num_rows;

    printf("<br><b>%d</b> via outras formas online.\n</tr>", $outro_turma);


    /* close result set */
    $result7_turma->close();
}

/* close connection */
$conexao->close();
?>





<div id="turma"></td>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Tipo de avidade', 'Quantidade'],
          ['Atividades via Facebook',     <?php echo $facebook_turma; ?> ],
          ['Atividades Whtasapp',     <?php echo $whatsapp_turma; ?> ],
          ['Atividades de Outras formas Online',     <?php echo $outro_turma; ?> ],
          ['Atvidade Impressa',    <?php echo $impresso_turma; ?>]
        ]);

        var options = {
          title: 'Gráfico da turma'
        };

        var chart = new google.visualization.PieChart(document.getElementById('turma'));

        chart.draw(data, options);
      }
    </script>
  </head>
      
</table>





</html>






