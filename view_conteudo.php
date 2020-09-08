<?php 
    include 'conecta_mysql.php';

    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome       = $_SESSION['nomePROF'];
    $rg         = $_SESSION['rgPROF'];
    $disciplina = $_SESSION['discPROF'];
    $escola     = $_POST['escola'];
    $serie = explode(',', $_POST['serie']);
    // $serie = $tmp[0];
    // $turma = $tmp[1];

    // var_dump($_SESSION);

?>

<html>
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body >
<div class="container-fluid">
    <h1><?php echo $escola; ?></h1>
    <p><b>Série : </b><?php echo $serie[0] ?> | <b>Turma : </b><?php echo $serie[1] ?> | <b>Professor : </b><?php echo $nome ?></p>
    
    <a href="menu.php" id="salvar" class="btn btn-outline-primary">Voltar ao menu</a>
    <br><br>
   
    <table class='table table-hover'>
    <tr>
    <th class="text-center">Data</th>
    <th class="text-center">Experiência / Habilidade</th>
    <th class="text-center">Ações</th>
    </tr>

    <?php
        $sql = "select dia, conteudo from conteudo where rg_professor = '$rg' and serie = '$serie[0]' and turma = '$serie[1]' and escola = '$escola' order by dia asc";
        $result = $conexao->query($sql);
        
        foreach($result as $consultas) {
            echo '<tr>';
                echo "<td class='text-center'>{$consultas['dia']}</td>";
                // echo "<td>$disciplina</td>";

                echo "<td class='text-center'>{$consultas['conteudo']}</td>";
                echo "
                <td class='text-center' style='display: flex;'>
                    <form method='post' action='visualizar2.php'>
                        <input name='escola' type='hidden' value='{$escola}'>
                        <input name='conteudo' type='hidden' value='{$consultas['conteudo']}'>
                         <input name='data' type='hidden' value='{$consultas['dia']}'>
                        <input name='serie'type='hidden' value='{$serie[0]},{$serie[1]}'>
                        <input type='submit' class='btn btn-outline-primary mr-1' value='Editar'> 
                    </form> 

                    <form method='post' action='delet_faltas.php'>
                        <input name='data' type='hidden' value='{$consultas['dia']}'>
                        <input name='escola' type='hidden' value='{$escola}'>
                        <input name='conteudo' type='hidden' value='{$consultas['conteudo']}'>
                        <input name='serie'type='hidden' value='{$serie[0]},{$serie[1]}'>
                        <input type='submit' class='btn btn-outline-danger' value='Apagar'>
                    </form>  
                </td>";
            echo '</tr>';
        };
    echo '</table>';
    ?>
    </div>
    </body>
</html>