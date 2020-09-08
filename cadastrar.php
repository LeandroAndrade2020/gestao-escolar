<?php
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    include 'conecta_mysql.php';
    include 'includes/head.php';

    $nome   = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg     = $_SESSION['rgPROF'];

    $nome_aluno    = $_POST['nome'];
    $ra            = $_POST['ra'];
    $digito        = $_POST['digito'];
    $serie         = $_POST['ano'];
    $turma         = $_POST['turma'];
    $periodo       = $_POST['periodo'];
    $numero        = $_POST['numero'];
    $situacao      = $_POST['situacao'];
    $data_situacao = $_POST['data_situacao'];


    $sqlVerifica = $conexao->query("select * from matricula where ra = '$ra' and escola = '$escola' 
        and serie = '$serie' and turma = '$turma' and situacao = '$situacao' ")->num_rows;

    if($sqlVerifica > 0) { ?>

        <div class="text-center m-5"> 
            <h2 class="text-center">Já existe um aluno cadastrado com os dados informados!</h2>
            <p style="font-size: 20px;">Se deseja apagar ou editar o aluno, <br> vá para a página de edição.</p>
            <div class="card text-center" style="width: 500px; margin: auto;">
                <div class="card-header"><datagrid>Dados informados</datagrid></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nome: </b> <?=$nome_aluno?></li>
                    <li class="list-group-item"><b>R.a: </b> <?= $ra?></li>
                    <li class="list-group-item"><b>Dígito: </b> <?= $digito?></li>
                    <li class="list-group-item"><b>Escola: </b> <?= $escola?></li>
                    <li class="list-group-item"><b>Série: </b> <?= $serie?></li>
                    <li class="list-group-item"><b>Turma: </b> <?= $turma?></li>
                    <li class="list-group-item"><b>Período: </b> <?= $periodo?></li>
                    <li class="list-group-item"><b>Número da Chamada: </b> <?= $numero?></li>
                    <li class="list-group-item"><b>Situação: </b> <?= $situacao?></li>
                    <li class="list-group-item"><b>Data da Situação: </b> <?= empty($data_situacao) ? "Não informado" : $data_situacao?></li>
                </ul>
            </div>
            <br>
            <a href="form_busca.php" class="btn btn-primary active" role="button" aria-pressed="true">Ir para a página de edição</a>
            <br><br>
            <a href="index.php" class="btn btn-primary active" role="button" aria-pressed="true">Voltar para a página inicial</a>
        </div>

        <?php } else { ?>

        <div class="text-center m-5"> 
            <h2 class="text-center">Aluno cadastrado com sucesso!</h2>
            <p style="font-size: 20px;">Agora o aluno já está disponível no sistema.</p>

            <div class="card text-center" style="width: 500px; margin: auto;">
                <div class="card-header"><datagrid>Dados informados</datagrid></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nome: </b> <?=$nome_aluno?></li>
                    <li class="list-group-item"><b>R.a: </b> <?= $ra?></li>
                    <li class="list-group-item"><b>Dígito: </b> <?= $digito?></li>
                    <li class="list-group-item"><b>Escola: </b> <?= $escola?></li>
                    <li class="list-group-item"><b>Série: </b> <?= $serie?></li>
                    <li class="list-group-item"><b>Turma: </b> <?= $turma?></li>
                    <li class="list-group-item"><b>Período: </b> <?= $periodo?></li>
                    <li class="list-group-item"><b>Número da Chamada: </b> <?= $numero?></li>
                    <li class="list-group-item"><b>Situação: </b> <?= $situacao?></li>
                    <li class="list-group-item"><b>Data da Situação: </b> <?= empty($data_situacao) ? "Não informado" : $data_situacao?></li>
                </ul>
            </div>
            <br><br>
            <a href="form_busca.php" class="btn btn-primary active" role="button" aria-pressed="true">Ir para a página de edição</a>
            <br><br>
            <a href="index.php" class="btn btn-primary active" role="button" aria-pressed="true">Voltar para a página inicial</a>
        </div>

        <?php $sql = "insert into matricula(nome,ra,digito,cie,escola,serie,turma,codigo_classe,periodo,numero_chamada,situacao,data_situacao) 
            values('$nome_aluno','$ra','$digito','','$escola','$serie','$turma','$codigo_classe','$periodo','$numero','$situacao','$data_situacao')";
        $conexao->query($sql);
    }

?>