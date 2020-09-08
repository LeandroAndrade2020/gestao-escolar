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
    $escola          = $_POST['escola'];


     $serie = explode(',',$_POST['serie']);

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


    
       
    



    
    $sqlOb = "select * from matricula where escola = '$escola' and serie = '$serie[0]' and turma = '$serie[1]' order by nome asc";
    $resultOb = $conexao->query($sqlOb);

    $sqlVerifica = "select * from nota_bimestre where escola = '$escola' and serie = '$serie[0]' and turma = '$serie[1]' and rg_professor = '$rg' order by nome asc";
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
        <li><b> RG do Professor : </b> <span id="rgPROF"><?php echo $rg ?></span><br></li>
            <li><b> Classe : </b> <span id="serie"><?php echo $serie[0] ?></span>° <span id="turma"><?php echo $serie[1] ?></span> <br></li>
        
    </ul>

    <form action='insert_notas22.php' method='post'>
      
        <div class="text-center">
          
                </div>
     
            <input type="hidden" name="serie" value="<?=$serie[0] ?>">
            <input type="hidden" name="turma" value="<?=$serie[1] ?>">
            <input type="hidden" name="escola" value="<?=$escola ?>">
            <input type="hidden" name="bimestre" value="<?=$bimestre ?>">

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover m-2'>"
            . '<tr>'
                . '<th class="text-center">Nome</th>'
                . '<th class="text-center">R.A</th>'
                . '<th class="text-center">% de Devolvidos</th>'
                . '<th class="text-center">Diagnóstico I</th>'
                . '<th class="text-center">Diagnóstico II </th>'
                . '<th>5º Conceito</th>'
                
            . '</tr>';

            while($row = $result->fetch_assoc()) {
                // var_dump($row);
                if($row['situacao'] == 'Transferido') {
                    echo '<tr class="table-danger">';
                } else {






                    $result_grafico = "select * from atividades where escola = '$escola' and serie = '$serie[0]' and turma = '$serie[1]' and impresso = 'Devolvido' and rg_professor = '$rg' and ra = '{$row['ra']}'";
                    $result_novo = $conexao->query($result_grafico);
                
                
                $devolvidos = $result_novo->num_rows;
                
                         
                
                
                
                $result_grafico_totais = "SELECT * FROM `atividades` WHERE escola = '$escola' and turma = '$serie[1]' and serie = '$serie[0]' and rg_professor = '$rg' and ra = '{$row['ra']}' ";  
                $result_novo_2 = $conexao->query($result_grafico_totais);
                
                
                $totais = $result_novo_2->num_rows;
                
                             
                
                $resultado_devolvido = ($devolvidos/ $totais) * 100;
                
                $resultado_final_final = number_format($resultado_devolvido,2,",","."); 
            $resultado_final_final;
                



                    echo '<tr class="table-active">';
                }
                        echo '<td>' . $row['nome'] . '</td>'
                        .'<td class="text-center">' . $row['ra'] . '</td>'
                        
                        . "<td class='text-center'> <b>  $resultado_final_final %</b>                  
                                            </td>"


                       . "<th>
                            <select name=\"{$row['ra']}[]\">
                                <option>" . (isset($row['diagnostico_1']) ? $row['diagnostico_1'] : "-") . "</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </th>"
                    . "<th>
                                  <select name=\"{$row['ra']}[]\">
                                <option>" . (isset($row['diagnostico_2']) ? $row['diagnostico_2'] : "-") . "</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </th>"
                    . "<th>
                                  <select name=\"{$row['ra']}[]\">
                                <option>" . (isset($row['5_conceito']) ? $row['5_conceito'] : "-") . "</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </th>"


                    . "<th>
                       <input type='hidden' name=\"{$row['ra']}[]\" value='{$row['nome']}'>
                                           </th>"


                    
                . '</tr>';

            }
            echo '</table>';
        } else {
            echo "Turma não encontrada<br>";
        }

        $conexao->close(); ?>
        <div class="text-center m-4">
            <hr>
            <input class="btn btn-outline-primary mr-4" type="submit" value="Terminar e enviar">
            <a href="menu.php" id="salvar" class="btn btn-outline-primary">Voltar ao menu</a>
            <input class="btn btn-outline-primary mr-4" type="submit" value="Imprimir" onClick="window.print()">
  
        </div>
    </form>

   
</body>

</html>