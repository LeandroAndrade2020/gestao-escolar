<?php 
    
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
<?php
    include_once('conecta_mysql.php');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }
    // Dados do form
    $nome_escola =  $_POST['escola'];
    $serie = explode(',',$_POST['serie']);
    $disciplina = $_SESSION['discPROF'];
    $cod_classe = $_SESSION['cod_classePROF'];


    $sql = "SELECT matricula.ra,matricula.nome, notas5.* FROM matricula LEFT JOIN notas5 ON matricula.ra = notas5.ra_aluno_notas where matricula.escola = '$nome_escola' and matricula.serie = '$serie[0]' and matricula.turma = '$serie[1]' and matricula.codigo_classe='$serie[2]' order by nome asc ";
    $result = $conexao->query($sql);


    echo '<h1>' . $nome_escola . ' | 5º Conceito</h1>';
    echo '<b> Classe: </b>'.  $serie[0] . '°' . $serie[1] . ' | <b>Disciplina : </b>'.$disciplina.'<br>';


    

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

            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['nmat']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['ning']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['nport']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['ncie']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['nhist']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['ngeo']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['nart']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['nedf']}' class='nota'/> </th>"
            . "<th> <input type='text' name=". $row['ra'] . " value='{$row['nemp']}' class='nota'/> </th>"

            . '</tr>';
        }
        echo '</table>';
    } else {
        echo "Turma não encontrada <br>";
    }

    $conexao->close();
    ?>

    <a href="#" id="salvar" class="btn btn-primary">Salvar</a>
    <a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>


    <script>
        $(document).ready(function(){



            $('#salvar').click(function(){
                var notas = $('input[type=text]').map(function(idx, elem) {
                return $(elem).val();
                }).get();
                console.log(notas);

                var ra = $('tr').map(function(idx, elem) {
                return $(elem).attr('id');
                }).get();

                console.log(ra)

                $.post({
                    url: 'salvar_notas5.php',
                    data :{
                        notas: notas,
                        ra : ra
                    }
                });
            });
        
            
        })
    </script>

    

</body>
</html>