<?php 
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome       = $_SESSION['nomePROF'];
    $rg         = $_SESSION['rgPROF'];
    $cod_classe = $_SESSION['cod_classePROF'];
   
    $interacao       = $_POST['interacao'];
    $escola          = $_GET['escola'];


     $serie = $_GET['serie'];
     $turma = $_GET['turma'];

    // echo 'Interação Padrão: ' . $interacaoPadrao . '<br>';
    // echo 'Situacao Padrão: ' . $situacaoPadrao . '<br>';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'includes/head.php' ?>
</head>
<body style="width: 100%;">

<?php
    include_once('conecta_mysql.php');
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);





    }


  
    

   
    $sqlOb = "select * from matricula where escola = '$escola' and serie = '$serie' and turma = '$turma'";
    $resultOb = $conexao->query($sqlOb);

    $sqlVerifica = "select * from nota_bimestre where escola = '$escola' and serie = '$serie' and turma = '$turma' order by nome asc";
    $resultVerifica = $conexao->query($sqlVerifica);
    // echo $sqlVerifica;

    if(mysqli_num_rows($resultVerifica) >= 1){
        $result = $resultVerifica;
        $edit = true;
        echo '<div>
            <p class="text-danger" style="margin: auto; text-align: center; font-size: 20px;">Você está editando</p>
        </div>';
       
        // echo $sqlConteudo . '<br><br>';
    } else {
        $result = $resultOb;
        $edit= false ;
        echo  '<div>
            <p class="text-danger" style="margin: auto; text-align: center; font-size: 20px;">Você está inserindo</p>
        </div>';    
    }

   
    
   ?>

    <div class="ml-4">
        <h3 class="display-5" id=escola><?php echo $escola ?></h3>
    </div>
    <ul>

    
           <?php echo $serie ?>
            
           <li><b> Classe : </b>  <?php echo $turma ?></li>
        
    </ul>

    <form action='insert_notas22.php' method='post'>
      
        <div class="text-center">
          
                </div>
     
            <input type="hidden" name="serie" value="<?=$serie ?>">
            <input type="hidden" name="turma" value="<?=$turma ?>">
            <input type="hidden" name="escola" value="<?=$escola ?>">
            <input type="hidden" name="bimestre" value="<?=$bimestre ?>">

        <?php












        if ($result->num_rows > 0) {





           

            while($row = $result->fetch_assoc()) {
                // var_dump($row);
                if($row['situacao'] == 'Transferido') {
                    echo '<tr class="table-danger">';
                } else {


//grafico


                    $result_grafico = "select * from atividades where escola = '$escola' and serie = '$serie' and turma = '$turma' and impresso = 'Devolvido'  and ra = '{$row['ra']}'";
                    $result_novo = $conexao->query($result_grafico);
                
                
                $devolvidos = $result_novo->num_rows;
                
                         
                
                
                
                $result_grafico_totais = "SELECT * FROM `atividades` WHERE escola = '$escola' and turma = '$turma' and serie = '$serie' and ra = '{$row['ra']}' ";  
                $result_novo_2 = $conexao->query($result_grafico_totais);
                
                
                $totais = $result_novo_2->num_rows;
                
                             
                
                $resultado_devolvido = ($devolvidos/ $totais) * 100;
                
                $resultado_final_final = number_format($resultado_devolvido,2,",","."); 
            $resultado_final_final;



//termina grafico





            $nome_esse =  $row['nome']; 






//dia

              $sql_data = "SELECT * FROM `atividades` WHERE escola = '$escola' and turma = '$turma' and serie = '$serie' and ra = '{$row['ra']}' and impresso = 'Devolvido' "; 
    $con = $conexao->query($sql_data);

 while($dado = $con->fetch_array()) {  
    
    
    $dado =  $dado["dia"];
$nome_aluno =  $dado["nome"];

//termina dia 




    
   echo "<table> ";

   echo "<tr>";
   
   echo "<td>"; echo  "$dado  - </td>";
   echo "<td>"; echo $nome_esse; echo "</td>  </tr>  
   
   
   </table>";


        

            
 
             
                     
                        
                                                               
                               
             



                  
            }
        }
        } }


        ?>
        <div class="text-center m-4">
            <hr>
            <input class="btn btn-outline-primary mr-4" type="submit" value="Terminar e enviar">
            <a href="menu.php" id="salvar" class="btn btn-outline-primary">Voltar ao menu</a>
            <input class="btn btn-outline-primary mr-4" type="submit" value="Imprimir" onClick="window.print()">
  
        </div>
    </form>

   
</body>

  
</html>