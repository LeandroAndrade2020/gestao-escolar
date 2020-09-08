<?php 
    
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
    $cod_classe = $_SESSION['cod_classePROF'];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
</head>
<body class="m-3">

<?php
    include_once('conecta_mysql.php');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    };
    // Dados do form
    $nome_escola =  $_POST['escola'];
    $serie = $_POST['serie'];
    $turma = $_POST['turma'];
    $notas = $_POST['notas'];



    if($notas == 'notas5'){
        header('location: view_notas5.php');
        $_SESSION['escolaNotas'] = $nome_escola;
        $_SESSION['serieNotas'] = $serie;
        $_SESSION['turmaNotas'] = $turma;
    };
    


    $sql = "SELECT matricula.ra,matricula.nome, notas.* FROM matricula LEFT JOIN notas ON matricula.ra = notas.ra_aluno_notas where matricula.escola = '$nome_escola' and matricula.serie = '$serie' and matricula.turma = '$turma' order by nome asc ";
    $result = $conexao->query($sql);


    echo '<h1>' . $nome_escola . '</h1>';
    echo '<b> Classe: </b>'.  $serie . '°' . $turma . '<br>';
    echo '<a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu.</a>';

    

    if ($result->num_rows > 0) {
        echo "<table class='table table-hover'>"
        . '<tr>'
        . '<th>Nome</th>'
        . '<th>R.A</th>'
        . "<th>Mat</th>"
        . "<th>Ing</th>"
        . "<th>Por</th>"
        . "<th>Cie</th>"
        . "<th>His</th>"
        . "<th>Geo</th>"
        . "<th>Art</th>"
        . "<th>Ed. Fis</th>"
        . "<th>Emp</th>"

        . '</tr>';

        while($row = $result->fetch_assoc()) {
            echo "<tr id='{$row['ra']}'>"
            .'<td>'.$row['nome'].'</td>'
            .'<td>'.$row['ra'].'</td>'

            . "<td> {$row['nmat']} </td>"
            . "<td> {$row['ning']} </td>"
            . "<td> {$row['nport']} </td>"
            . "<td> {$row['ncie']} </td>"
            . "<td> {$row['nhist']} </td>"
            . "<td> {$row['ngeo']} </td>"
            . "<td> {$row['nart']} </td>"
            . "<td> {$row['nedf']} </td>"
            . "<td> {$row['nemp']} </td>"

            . '</tr>';
        }
        echo '</table>';
    } else {
        echo "Turma não encontrada <br>";
    }

    $conexao->close();
    ?>

    


   
    

</body>
</html>