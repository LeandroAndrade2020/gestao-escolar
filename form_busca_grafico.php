<!DOCTYPE html>
<html lang="pt-br">

<?php 



 error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $nome_escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
 
?>


    <?php include 'includes/head.php' ?>
</head>


<div class="container" style="max-width: 800px;">
    <div class="mt-4 mb-4">
      <h2>Busca por turma </h2>
    </div>

    <div style="background-color: rgba(0,0,0,.05); border-radius: 15px; padding: 20px;">
      <form action="relatorio_geral2.php">
          <div class="form-group">
            <label>Série: </label><br>
            <select name="serie">
                <option value="EJA 1">EJA 1</option>
                <option value="EJA 2">EJA 2</option>
                <option value="Fase 1">Fase 1</option>
                <option value="Fase 2">Fase 2</option>
                <option value="Berçário 1">Berçário 1</option>
                <option value="Berçário 2">Berçário 2</option>
                <option value="Maternal 1">Maternal 1</option>
                <option value="Maternal 2">Maternal 2</option>
                <option value="1">1</option>s
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
          </div>

          <div class="form-group">
            <label>Turma: </label><br>
            <select name="turma">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
              <option value="F">F</option>
              <option value="G">G</option>
              <option value="H">H</option>
            <option value="I">I</option>
            <option value="J">J</option>
            <option value="K">K</option>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="N">N</option>
            </select>
          </div>

          <input type="hidden" name="escola" value="<?=$nome_escola?>">


          <div class="text-center">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
          </div>



      </form>




<table class='table table-hover'>
    <tr>
    <th>Dados da escola <?php echo $nome_escola;?></th>
    <!-- <th>Disciplina</th> --> </tr></table>
    
    <table class='table table-hover'>
    
    <tr>
      
    <td><b>Série</b></td>
    <td><b>Descrição</b></td>
        <td><b>Quantidade</b></td>
       
        
    </tr>
    
	<?php
    include_once('conecta_mysql.php');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

//$nome_escola

  
if ($result1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and impresso = 'Devolvido'")) {

    /* determine number of rows result set */
    $devolvida = $result1->num_rows;

    printf("

  <tr><td>Toda escola</td>  <td>Atividades Devolvidas</td>  <td>%d</td> 
 
     </tr>\n ", $devolvida);


    /* close result set */
    $result1->close();
}



    if ($result2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and impresso != 'Devolvido'")) {

    /* determine number of rows result set */
    $ndevolvida = $result2->num_rows;

    printf("  <tr>  <td>Toda escola</td> <td>Atividades não Devolvidas</td>  <td>%d</td>      </tr>\n", $ndevolvida);


    /* close result set */
    $result2->close();
}

    if ($result3 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Impresso'")) {

    /* determine number of rows result set */
    $impresso = $result3->num_rows;

    printf("  <tr>  <td>Toda escola</td>    <td>Atividades Disponibilizadas na forma Impressa</td>  <td>%d</td>       </tr>\n", $impresso);


    /* close result set */
    $result3->close();
}




    if ($result5 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Facebook'")) {

    /* determine number of rows result set */
    $facebook = $result5->num_rows;

    printf("  <tr>  <td>Toda escola</td> 
    <td>Atividades disponibilizadas via Facebook®</td>
     <td>%d</td> </tr>\n", $facebook);


    /* close result set */
    $result5->close();
}


    if ($result6 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Whatsapp'")) {

    /* determine number of rows result set */
    $whatsapp = $result6->num_rows;

    printf(" <tr>  <td>Toda escola</td>  
    <td>Atividades disponibilizadas via Whatsapp®</td><td>%d</td>
     </tr>\n", $whatsapp);


    /* close result set */
    $result6->close();
}


    if ($result7 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and online = 'Outro'")) {

    /* determine number of rows result set */
    $outro = $result7->num_rows;

    printf(" <tr>  <td>Toda escola</td> 
    <td>Atividades disponibilizadas de outras formas®</td>
    <td>%d</td></tr>
     \n", $outro);


    /* close result set */
    $result7->close();
}



if ($resultbercario2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'Berçário 2'") ) {

  /* determine number of rows result set */
  $Bercario2 = $resultbercario2->num_rows;

  printf(" <tr>  <td>Berçário 2</td>  
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n", $Bercario2);


  /* close result set */
  $resultbercario2->close();
}



if ($resultbercario1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'Berçário 1'") ) {

  /* determine number of rows result set */
  $Bercario1 = $resultbercario1->num_rows;

  printf(" <tr>  <td>Berçário 1</td> 
  <td>Atividades Devolvidas</td>
   <td>%d</td> </tr>\n", $Bercario1);


  /* close result set */
  $resultbercario1->close();
}



if ($resultmateral1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'Maternal 1'") ) {

  /* determine number of rows result set */
  $Maternal1 = $resultmaternal1->num_rows;

  printf(" <tr>   <td>Maternal 1</td>  
  <td>Atividades Devolvidas</td>
 <td>%d</td> </tr>\n", $Maternal1);


  /* close result set */
  $resultmateral1->close();
}


if ($resultmateral2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'Maternal 2'") ) {

  /* determine number of rows result set */
  $Maternal2 = $resultmaternal2->num_rows;

  printf(" <tr>  <td>Maternal 2</td>   
  <td>Atividades Devolvidas</td><td>%d</td>
  </tr>\n", $Maternal2);


  /* close result set */
  $resultmateral2->close();
}



if ($resultfase2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'Fase 2'") ) {

  /* determine number of rows result set */
  $fase2 = $resultfase2->num_rows;

  printf(" <tr>   <td>Fase 2</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n", $fase2);


  /* close result set */
  $resultfase2->close();
}







if ($resultfase1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'Fase 1'") ) {

  /* determine number of rows result set */
  $fase1 = $resultfase1->num_rows;

  printf("<tr>   <td>Fase 1</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n", $fase1);


  /* close result set */
  $resultfase1->close();
}




if ($result1ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '1'") ) {

  /* determine number of rows result set */
  $primeiroano = $result1ano->num_rows;

  printf("<tr>   <td>1º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n", $primeiroano);


  /* close result set */
  $result1ano->close();
}




if ($result2ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '2'") ) {

  /* determine number of rows result set */
  $segundoano = $result2ano->num_rows;

  printf("<tr>   <td>2º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n", $segundoano);


  /* close result set */
  $result2ano->close();
}



if ($result3ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '3'") ) {

  /* determine number of rows result set */
  $terceiroano = $result3ano->num_rows;

  printf("<tr>   <td>3º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n", $terceiroano);


  /* close result set */
  $result3ano->close();
}


if ($result4ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '4'")) {

  /* determine number of rows result set */
  $quartoano = $result4ano->num_rows;

  printf("<tr>   <td>4º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $quartoano);


  /* close result set */
  $result4ano->close();
}


if ($result5ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '5'")) {

  /* determine number of rows result set */
  $quintoano = $result5ano->num_rows;

  printf("<tr>   <td>5º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $quintoano);


  /* close result set */
  $result5ano->close();
}



if ($result6ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '6'")) {

  /* determine number of rows result set */
  $sextoano = $result6ano->num_rows;

  printf("<tr>   <td>6º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $sextoano);


  /* close result set */
  $result6ano->close();
}


if ($result7ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '7'")) {

  /* determine number of rows result set */
  $setimoano = $result7ano->num_rows;

  printf("<tr>   <td>7º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $setimoano);


  /* close result set */
  $result7ano->close();
}


if ($result8ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '8'")) {

  /* determine number of rows result set */
  $oitavoano = $result8ano->num_rows;

  printf("<tr>   <td>8º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $oitavoano);


  /* close result set */
  $result8ano->close();
}


if ($result9ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = '9'")) {

  /* determine number of rows result set */
  $nonoano = $result9ano->num_rows;

  printf("<tr>   <td>9º Ano</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $nonoano);


  /* close result set */
  $result9ano->close();
}


if ($resulteja1t1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 1 - T1'")) {

  /* determine number of rows result set */
  $eja1t1 = $resulteja1t1->num_rows;

  printf("<tr>   <td>EJA 1 - T1</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja1t1);


  /* close result set */
  $resulteja1t1->close();
}

if ($resulteja1t2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 1 - T2'")) {

  /* determine number of rows result set */
  $eja1t2 = $resulteja1t2->num_rows;

  printf("<tr>   <td>EJA 1 - T2</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja1t2);


  /* close result set */
  $resulteja1t2->close();
}

if ($resulteja1t3 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 1 - T3'")) {

  /* determine number of rows result set */
  $eja1t3 = $resulteja1t3->num_rows;

  printf("<tr>   <td>EJA 1 - T3</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja1t3);


  /* close result set */
  $resulteja1t3->close();
}

if ($resulteja1t4 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 1 - T4'")) {

  /* determine number of rows result set */
  $eja1t4 = $resulteja1t4->num_rows;

  printf("<tr>   <td>EJA 1 - T4</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja1t4);


  /* close result set */
  $resulteja1t4->close();
}


if ($resulteja2t1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 2 - T1'")) {

  /* determine number of rows result set */
  $eja2t1 = $resulteja2t1->num_rows;

  printf("<tr>   <td>EJA 2 - T1</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja2t1);


  /* close result set */
  $resulteja2t1->close();
}


if ($resulteja2t2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 2 - T2'")) {

  /* determine number of rows result set */
  $eja2t2 = $resulteja2t2->num_rows;

  printf("<tr>   <td>EJA 2 - T2</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja2t2);


  /* close result set */
  $resulteja2t2->close();
}

if ($resulteja2t3 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 2 - T3'")) {

  /* determine number of rows result set */
  $eja2t3 = $resulteja2t3->num_rows;

  printf("<tr>   <td>EJA 2 - T3</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja2t3);


  /* close result set */
  $resulteja2t3->close();
}


if ($resulteja2t4 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso = 'Devolvido' and serie = 'EJA 2 - T4'")) {

  /* determine number of rows result set */
  $eja2t4 = $resulteja2t4->num_rows;

  printf("<tr>   <td>EJA 2 - T4</td> 
  <td>Atividades Devolvidas</td>
  <td>%d</td> </tr>\n",  $eja2t3);


  /* close result set */
  $resulteja2t4->close();
}




if ($nresultbercario2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'Berçário 2'") ) {

  /* determine number of rows result set */
  $Bercario22 = $nresultbercario2->num_rows;




  /* close result set */
  $nresultbercario2->close();
}



if ($nresultbercario1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'Berçário 1'") ) {

  /* determine number of rows result set */
  $Bercario12 = $nresultbercario1->num_rows;

  


  /* close result set */
  $nresultbercario1->close();
}



if ($nresultmateral1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'Maternal 1'") ) {

  /* determine number of rows result set */
  $Maternal12 = $nresultmaternal1->num_rows;




  /* close result set */
  $nresultmateral1->close();
}


if ($nresultmateral2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'Maternal 2'") ) {

  /* determine number of rows result set */
  $Maternal22 = $nresultmaternal2->num_rows;



  /* close result set */
  $nresultmateral2->close();
}



if ($nresultfase2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'Fase 2'") ) {

  /* determine number of rows result set */
  $fase22 = $nresultfase2->num_rows;




  /* close result set */
  $nresultfase2->close();
}







if ($nresultfase1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'Fase 1'") ) {

  /* determine number of rows result set */
  $fase12 = $nresultfase1->num_rows;




  /* close result set */
  $nresultfase1->close();
}




if ($nresult1ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '1'") ) {

  /* determine number of rows result set */
  $primeiroano2 = $nresult1ano->num_rows;

 
  /* close result set */
  $nresult1ano->close();
}




if ($nresult2ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '2'") ) {

  /* determine number of rows result set */
  $segundoano2 = $nresult2ano->num_rows;



  /* close result set */
  $nresult2ano->close();
}



if ($nresult3ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '3'") ) {

  /* determine number of rows result set */
  $terceiroano2 = $nresult3ano->num_rows;




  /* close result set */
  $nresult3ano->close();
}


if ($nresult4ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '4'")) {

  /* determine number of rows result set */
  $quartoano2 = $nresult4ano->num_rows;




  /* close result set */
  $nresult4ano->close();
}


if ($nresult5ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '5'")) {

  /* determine number of rows result set */
  $quintoano2 = $nresult5ano->num_rows;




  /* close result set */
  $nresult5ano->close();
}



if ($nresult6ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '6'")) {

  /* determine number of rows result set */
  $sextoano2 = $nresult6ano->num_rows;




  /* close result set */
  $nresult6ano->close();
}


if ($nresult7ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '7'")) {

  /* determine number of rows result set */
  $setimoano2 = $nresult7ano->num_rows;




  /* close result set */
  $nresult7ano->close();
}


if ($nresult8ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '8'")) {

  /* determine number of rows result set */
  $oitavoano2 = $nresult8ano->num_rows;



  /* close result set */
  $nresult8ano->close();
}


if ($nresult9ano = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = '9'")) {

  /* determine number of rows result set */
  $nonoano2 = $nresult9ano->num_rows;




  /* close result set */
  $nresult9ano->close();
}

/* close connection */




if ($nresulteja1t1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA1 - T1'")) {

  /* determine number of rows result set */
  $eja1t11 = $nresulteja1t1->num_rows;




  /* close result set */
  $nresulteja1t1->close();
}

/* close connection */

if ($nresulteja1t2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA1 - T2'")) {

  /* determine number of rows result set */
  $eja1t22 = $nresulteja1t2->num_rows;




  /* close result set */
  $nresulteja1t2->close();
}

/* close connection */

if ($nresulteja1t3 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA1 - T3'")) {

  /* determine number of rows result set */
  $eja1t32 = $nresulteja1t3->num_rows;




  /* close result set */
  $nresulteja1t3->close();
}

/* close connection */
if ($nresulteja1t4 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA1 - T4'")) {

  /* determine number of rows result set */
  $eja1t42 = $nresulteja1t4->num_rows;




  /* close result set */
  $nresulteja1t4->close();
}

/* close connection */



if ($nresulteja2t1 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA2 - T1'")) {

  /* determine number of rows result set */
  $eja2t11 = $nresulteja2t1->num_rows;




  /* close result set */
  $nresulteja2t1->close();
}

/* close connection */

if ($nresulteja2t2 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA2 - T2'")) {

  /* determine number of rows result set */
  $eja2t22 = $nresulteja2t2->num_rows;




  /* close result set */
  $nresulteja2t2->close();
}

/* close connection */

if ($nresulteja2t3 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA2 - T3'")) {

  /* determine number of rows result set */
  $eja2t32 = $nresulteja2t3->num_rows;




  /* close result set */
  $nresulteja2t3->close();
}

/* close connection */
if ($nresulteja2t4 = $conexao->query("SELECT * FROM atividades WHERE escola = '$nome_escola' and Impresso != 'Devolvido' and serie = 'EJA2 - T4'")) {

  /* determine number of rows result set */
  $eja2t42 = $nresulteja2t4->num_rows;




  /* close result set */
  $nresulteja2t4->close();
}

/* close connection */




?>


   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Tipo de avidade', 'Quantidade'],
          ['Atividades via Facebook',     <?php echo $facebook; ?> ],
          ['Atividades Whtasapp',     <?php echo $whatsapp; ?> ],
          ['Atividades de Outras formas Online',     <?php echo $outro; ?> ],
          ['Atvidade Impressa',    <?php echo $impresso; ?>]
        ]);

        var options = {
          title: 'Gráfico da escola '
        };

        var chart = new google.visualization.PieChart(document.getElementById('escola'));

        chart.draw(data, options);
      }
    </script>
<br><br>
<div id="primeiro" ></div>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Situação', 'Quantidade'],
          ['Devolvido',     <?php echo $primeiroano; ?> ],
          ['Não Devolvido',     <?php echo $primeiroano2; ?> ]
    
        ]);

        var options = {
          title: 'Gráfico 1º Ano'
        };

        var chart = new google.visualization.PieChart(document.getElementById('primeiro'));

        chart.draw(data, options);
      }
    </script>
<br><br>
<div id="segundo" ></div>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Situação', 'Quantidade'],
          ['Devolvido',     <?php echo $segundoano; ?> ],
          ['Não Devolvido',     <?php echo $segundoano2; ?> ]
    
        ]);

        var options = {
          title: 'Gráfico 2º Ano'
        };

        var chart = new google.visualization.PieChart(document.getElementById('segundo'));

        chart.draw(data, options);
      }
    </script>
   

   <br><br>
    <div id="terceiro" ></div>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Situação', 'Quantidade'],
          ['Devolvido',     <?php echo $terceiroano; ?> ],
          ['Não Devolvido',     <?php echo $terceiroano2; ?> ]
    
        ]);

        var options = {
          title: 'Gráfico 3º Ano'
        };

        var chart = new google.visualization.PieChart(document.getElementById('terceiro'));

        chart.draw(data, options);
      }
    </script>

<br><br>
<div id="quarto" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $quartoano; ?> ],
         ['Não Devolvido',     <?php echo $quartoano2; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico 4º Ano'
       };

       var chart = new google.visualization.PieChart(document.getElementById('quarto'));

       chart.draw(data, options);
     }
   </script>
<br><br>
<div id="quinto" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $quintoano; ?> ],
         ['Não Devolvido',     <?php echo $quintoano2; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico 5º Ano'
       };

       var chart = new google.visualization.PieChart(document.getElementById('quinto'));

       chart.draw(data, options);
     }
   </script>

<br><br>

<div id="sexto" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $sextoano; ?> ],
         ['Não Devolvido',     <?php echo $sextoano2; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico 6º Ano'
       };

       var chart = new google.visualization.PieChart(document.getElementById('sexto'));

       chart.draw(data, options);
     }
   </script>
<br><br>

<div id="setimo" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $setimoano; ?> ],
         ['Não Devolvido',     <?php echo $setimoano2; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico 7º Ano'
       };

       var chart = new google.visualization.PieChart(document.getElementById('setimo'));

       chart.draw(data, options);
     }
   </script>
<br><br>
<div id="oitavo" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $oitavoano; ?> ],
         ['Não Devolvido',     <?php echo $oitavoano2; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico 8º Ano'
       };

       var chart = new google.visualization.PieChart(document.getElementById('oitavo'));

       chart.draw(data, options);
     }
   </script>
<br><br>
<div id="nono" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $nonoano; ?> ],
         ['Não Devolvido',     <?php echo $nonoano2; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico 9º Ano'
       };

       var chart = new google.visualization.PieChart(document.getElementById('nono'));

       chart.draw(data, options);
     }
   </script>
<br><br>

<div id="bercario1" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $Bercario1; ?> ],
         ['Não Devolvido',     <?php echo $Bercario12; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico Berçário 1'
       };

       var chart = new google.visualization.PieChart(document.getElementById('bercario1'));

       chart.draw(data, options);
     }
   </script>
<br><br>
<div id="bercario2" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $Bercario2; ?> ],
         ['Não Devolvido',     <?php echo $Bercario22; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico Berçário 2'
       };

       var chart = new google.visualization.PieChart(document.getElementById('bercario2'));

       chart.draw(data, options);
     }
   </script>
<br><br>
<div id="maternal1" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $Maternal1; ?> ],
         ['Não Devolvido',     <?php echo $Maternal12; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico Maternal 1'
       };

       var chart = new google.visualization.PieChart(document.getElementById('maternal1'));

       chart.draw(data, options);
     }
   </script>
   <br><br>
<div id="maternal2" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $Maternal2; ?> ],
         ['Não Devolvido',     <?php echo $Maternal22; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico Maternal 2'
       };

       var chart = new google.visualization.PieChart(document.getElementById('maternal2'));

       chart.draw(data, options);
     }
   </script>

<br><br>
<div id="fase1" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $fase1; ?> ],
         ['Não Devolvido',     <?php echo $fase12; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico Fase 1'
       };

       var chart = new google.visualization.PieChart(document.getElementById('fase1'));

       chart.draw(data, options);
     }
   </script>

<br><br>

<div id="fase2" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $fase2; ?> ],
         ['Não Devolvido',     <?php echo $fase22; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico Fase 2'
       };

       var chart = new google.visualization.PieChart(document.getElementById('fase2'));

       chart.draw(data, options);
     }
   </script>

<br><br>

<div id="eja1t1" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja1t1; ?> ],
         ['Não Devolvido',     <?php echo $eja1t12; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 1 - T1'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja1t1'));

       chart.draw(data, options);
     }
   </script>
<br><br>

<div id="eja1t2" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja1t2; ?> ],
         ['Não Devolvido',     <?php echo $eja1t22; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 1 - T2'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja1t2'));

       chart.draw(data, options);
     }
   </script>
<br><br>

<div id="eja1t3" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja1t3; ?> ],
         ['Não Devolvido',     <?php echo $eja1t32; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 1 - T3'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja1t3'));

       chart.draw(data, options);
     }
   </script>
<br><br>

<div id="eja1t4" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja1t4; ?> ],
         ['Não Devolvido',     <?php echo $eja1t42; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 1 - T4'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja1t4'));

       chart.draw(data, options);
     }
   </script>
<br><br>

<div id="eja2t1" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja2t1; ?> ],
         ['Não Devolvido',     <?php echo $eja2t12; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 2 - T1'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja2t1'));

       chart.draw(data, options);
     }
   </script>


<br><br>

<div id="eja2t2" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja2t2; ?> ],
         ['Não Devolvido',     <?php echo $eja2t22; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 2 - T2'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja2t2'));

       chart.draw(data, options);
     }
   </script>


<br><br>

<div id="eja2t3" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja2t3; ?> ],
         ['Não Devolvido',     <?php echo $eja2t32; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 2 - T3'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja2t3'));

       chart.draw(data, options);
     }
   </script>

<br><br>

<div id="eja2t4" ></div>
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Situação', 'Quantidade'],
         ['Devolvido',     <?php echo $eja2t4; ?> ],
         ['Não Devolvido',     <?php echo $eja2t42; ?> ]
   
       ]);

       var options = {
         title: 'Gráfico EJA 2 - T4'
       };

       var chart = new google.visualization.PieChart(document.getElementById('eja2t4'));

       chart.draw(data, options);
     }
   </script>
    </tr></table></div></div>

</html>


