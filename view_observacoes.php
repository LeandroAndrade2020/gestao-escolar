<?php 
    include 'conecta_mysql.php';

    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
    
    $serie = explode(',',$_POST['serie']);



?>

<html>
<head>
    <?php include 'includes/head.php'; ?>
</head>
    <body class="container">
        

    <h1><?php echo $escola; ?></h1>
    <p>Serie : <?php echo $serie[0] ?> | Turma : <?php echo $serie[1] ?> | Professor : <?php echo $nome ?></p>

    <table class='table table-hover'>
    <tr>
    <th>Data</th>
    <th>Professor</th>
    <th>Observação</th>
    </tr>

    <?php 
        $sql = "select data , professor, observacao from observacao where serie = '$serie[0]' and turma = '$serie[1]' and professor = '$nome' and escola = '$escola'";
        $result = $conexao->query($sql);
    

        foreach($result as $consultas){
            echo '<tr>';
                echo "<td>{$consultas['data']}</td>";
                echo "<td>{$consultas['professor']}</td>";
                echo "<td>{$consultas['observacao']}</td>";
            echo '</tr>';
        };
    echo '</table>';
    ?>
    <a class="btn btn-danger primary" href="menu.php" role="button"> <i class="fas fa-power-off"></i>Voltar para o menu</a>

    </body>
</html>