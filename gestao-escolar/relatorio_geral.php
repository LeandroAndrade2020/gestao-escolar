 <?php 

//  error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $nome_escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
</head>
<body class="container-fluid">
<table class='table table-hover'>
    <tr>
    <th>Dados</th>
    <!-- <th>Disciplina</th> -->

    
	<?php
    include_once('conecta_mysql.php');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

//$nome_escola

    Echo "<h1>$nome_escola</h1>";
if ($result1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and devolvido = 'Sim'")) {

    /* determine number of rows result set */
    $jane_devolvida = $result1->num_rows;

    printf("<table class='table table-hover'>

  <tr> <b>%d</b> atividades entregues.\n ", $jane_devolvida);


    /* close result set */
    $result1->close();
}



    if ($result2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and devolvido != 'Sim'")) {

    /* determine number of rows result set */
    $jane_ndevolvida = $result2->num_rows;

    printf("<br><b>%d</b> atividades não entregues.\n", $jane_ndevolvida);


    /* close result set */
    $result2->close();
}

    if ($result3 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and impresso = 'Sim'")) {

    /* determine number of rows result set */
    $jane_impresso = $result3->num_rows;

    printf("<br><b>%d</b> atividades impressas.\n", $jane_impresso);


    /* close result set */
    $result3->close();
}




    if ($result5 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Facebook'")) {

    /* determine number of rows result set */
    $jane_facebook = $result5->num_rows;

    printf("<br><b>%d</b> fizeram atividade via facebook.\n", $jane_facebook);


    /* close result set */
    $result5->close();
}


    if ($result6 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Whatsapp'")) {

    /* determine number of rows result set */
    $jane_whatsapp = $result6->num_rows;

    printf("<br><b>%d</b> fizeram atividades via Whatsapp.\n", $jane_whatsapp);


    /* close result set */
    $result6->close();
}


    if ($result7 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Outro'")) {

    /* determine number of rows result set */
    $jane_outro = $result7->num_rows;

    printf("<br><b>%d</b> via outras formas online.\n</tr>", $jane_outro);


    /* close result set */
    $result7->close();
}

/* close connection */
$conexao->close();
?>

<!-- <th>Gráfico</th><td><div id="jane" style="width: 500px; height: 500px;"></td></div> -->
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Tipo de avidade', 'Quantidade'],
          ['Atividades via Facebook',     <?php echo $jane_facebook; ?> ],
          ['Atividades Whtasapp',     <?php echo $jane_whatsapp; ?> ],
          ['Atividades de Outras formas Online',     <?php echo $jane_outro; ?> ],
          ['Atvidade Impressa',    <?php echo $jane_impresso; ?>]
        ]);

        var options = {
          title: 'Gráfico de Atividades '
        };

        var chart = new google.visualization.PieChart(document.getElementById('jane'));

        chart.draw(data, options);
      }
    </script>
  </head>
      
</table>

</html>






