<?php 
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome       = $_SESSION['nomePROF'];
    $rg         = $_SESSION['rgPROF'];
    $cod_classe = $_SESSION['cod_classePROF'];
    
    $conteudo        = $_POST['conteudo'];
    $interacao       = $_POST['interacao'];
    $escola          = $_POST['escola'];
    $interacaoPadrao = $_POST['interacaoPadrao'];
    $situacaoPadrao  = $_POST['situacaoPadrao'];
    $dia             = $_POST['data'];

    $_SESSION['dia'] = $dia;
    $serie = explode(',',$_POST['serie']);

    // echo 'Interação Padrão: ' . $interacaoPadrao . '<br>';
    // echo 'Situacao Padrão: ' . $situacaoPadrao . '<br>';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'includes/head.php' ?>
</head>
<body class="m-2">

<?php
    include_once('conecta_mysql.php');
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    $date = mb_substr($dia,0 ,2);
    if($date > 31) {
        header('location: calendario.php');
    }
    
    $month = mb_substr($dia,2 ,2);
    if($month > 12) {
        header('location: calendario.php');
    }
    
    $sqlOb = "select * from matricula where escola = '$escola' and serie = '$serie[0]' and turma = '$serie[1]'  order by numero_chamada asc";
    $resultOb = $conexao->query($sqlOb);

    $sqlVerifica = "select * from atividades where escola = '$escola' and serie = '$serie[0]' and turma = '$serie[1]' and dia ='$dia' and rg_professor = '$rg'"; 
    $resultVerifica = $conexao->query($sqlVerifica);
    // echo $sqlVerifica;

    if(mysqli_num_rows($resultVerifica) >= 1){
        $result = $resultVerifica;
        $edit = true;
        echo '<div>
            <p class="text-danger" style="margin: auto; text-align: center; font-size: 20px;">Você está editando</p>
        </div>';
        $sqlConteudo = "select * from conteudo where escola = '$escola' and serie = '$serie[0]' and turma = '$serie[1]' 
            and rg_professor = '$rg' and dia = '$dia'";
        $resultConteudo = $conexao->query($sqlConteudo);
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
        <h1 id=escola><?php echo $escola ?></h1>
    </div>
    <ul>
        <li><b> RG do Professor : </b> <span id="rgPROF"><?php echo $rg ?></span><br></li>
        <li><b> Dia selecionado : </b> <span id="dia"><?php echo $dia ?></span><br></li>
        <li><b> Classe : </b> <span id="serie"><?php echo $serie[0] ?></span>° <span id="turma"><?php echo $serie[1] ?></span> <br></li>
        <li><b> Experiência / Habilidade : </b></li>
    </ul>
    
    <form action='insert_faltas.php' method='post'>
        <div class="form-group m-4">
        
            <?php if($edit) { 
                while($row = $resultConteudo->fetch_assoc()) { ?>
                    <textarea class="form-control" placeholder="Digite a Experiência / Habilidade..." name="conteudo" cols="25" rows="5" value="<?php echo $row['conteudo'] ?>"><?= $row['conteudo'] ?></textarea>
            <?php }
        } else { ?>
            <textarea class="form-control" placeholder="Digite a Experiência / Habilidade..." name="conteudo" cols="25" rows="5" value="<?php echo $conteudo ?>"><?= $row['conteudo'] ?></textarea>
        <?php }?>

        </div>
        <div class="text-center">
           <a class="btn btn-primary text-center" href="https://drive.google.com/drive/folders/1kvRct4QH1OgJ68vfthGGL1ofF5mbfgJf?usp=sharing" target="_blank">Visualizar Habilidades/Experiências</a>
        </div>
                <input type="hidden" name="serie" value="<?=$serie[0] ?>">
                <input type="hidden" name="turma" value="<?=$serie[1] ?>">
                <input type="hidden" name="escola" value="<?=$escola ?>">
                <input type="hidden" name="dia" value="<?=$dia ?>">

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-hover m-3'>"
            . '<tr>'
                . '<th class="text-center">Nome</th>'
                . '<th class="text-center">R.A</th>'
                . '<th class="text-center">Interação</th>'
                . '<th class="text-center">Situação</th>'
                . '<th></th>'
            . '</tr>';

            while($row = $result->fetch_assoc()) {
                // var_dump($row);
                if($row['situacao'] == 'Transferido') {
                    echo '<tr class="table-danger">';
                } else {
                    echo '<tr class="table-active">';
                }
                        echo '<td>' . $row['nome'] . '</td>'
                        .'<td class="text-center">' . $row['ra'] . '</td>'
                    
                        . "<th>
                            <select name=\"{$row['ra']}[]\">
                                <option>" . (isset($row['online']) ? $row['online'] : $interacaoPadrao) . "</option>
                                <option>Facebook</option>
                                <option>-</option>
                                <option>Whatsapp</option>
                                <option>Outro</option>
                                <option>Classroom</option>
                                <option>Aula</option>
                                <option>Impresso</option>
                            </select>
                        </th>"
                    . "<th>
                        <select name=\"{$row['ra']}[]\">
                            <option>" . (isset($row['impresso']) ? $row['impresso'] : $situacaoPadrao) . "</option>
                            <option>-</option>
                            <option>Não Devolvido</option>
                            <option>Devolvido</option>
                            <option>C</option>
                            <option>F</option>
                        </select>
                    </th>"
                    . "<th class='d-none w-0'>
                        <select name=\"{$row['ra']}[]\">
                            <option>{$row['nome']}</option>
                        </select>
                    </th>"
                . '</tr>';
            }
            echo '</table>';
        } else {
            echo "Turma não encontrada<br>";
        }

        $conexao->close(); ?>
        <div class="text-center m-5">
            <input class="btn btn-primary mr-4" type="submit" value="Terminar e enviar">
            <a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Dados do formulário
            var conteudo = $('#conteudo').text();
            var dia = $('#dia').text();
            var serie =  $('#serie').text();
            var turma =  $('#turma').text();
            var escola =  $('#escola').text();
            var rg_professor = $('#rgPROF').text();

            $("#terminar_chamada").click(function(){

            });
        });
    </script>
</body>
</html>