<?php 
    include 'conecta_mysql.php';

    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
    $disciplina = $_SESSION['discPROF'];
    
    $serie = explode(',',$_POST['serie']);
    $escola = ($_POST['escola']);


?>

<html>
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body class="container-fluid">
    

    <h1><?php echo $escola ?></h1>
    <p>Serie : <?php echo $serie[0] ?> | Turma : <?php echo $serie[1] ?> | Professor : <?php echo $nome ?></p>
    
    <a href="gestaomenuprofessor.php" id="salvar" class="btn btn-primary">Voltar ao menu.</a>
    <br><br>
   
   
  
    <table class='table table-hover'>
    <tr>
    <th>Data</th>
    <!-- <th>Disciplina</th> -->

    <th>Experiência / Habilidade</th>
    <th>Editar</th>
    </tr>

    <?php 
        $sql = "select dia, conteudo from conteudo where rg_professor = '$rg' and serie = '$serie[0]' and turma = '$serie[1]' ";
        $result = $conexao->query($sql);
    

        foreach($result as $consultas){
            echo '<tr>';
                echo "<td>{$consultas['dia']}</td>";
                // echo "<td>$disciplina</td>";

                echo "<td>{$consultas['conteudo']}</td>";
                echo "<td> <form method='post' action='gestaovisualizar.php'> 
                    
                    <input name='data' type='hidden' value='{$consultas['dia']}'>
                    <input name='escola' type='hidden' value='$escola'>
                    <input name='conteudo' type='hidden' value='{$consultas['conteudo']}'>
                    <input name='serie'type='hidden' value='$serie[0],$serie[1]'>
                    <input type='submit' value='Editar'> 


                    </form> 
                  <form method='post' action='gestaovisualizar_del.php'> 
                    <input name='data' type='hidden' value='{$consultas['dia']}'>
                    <input name='escola' type='hidden' value='$escola'>
                    <input name='conteudo' type='hidden' value='{$consultas['conteudo']}'>
                    <input name='serie'type='hidden' value='$serie[0],$serie[1]'>
                     <input type='submit' class='btn btn-danger' value='Apagar'> 


                    </form> 
                    
                </td>";
            echo '</tr>';
        };
    echo '</table>';
    ?>
    </body>
   
</html>