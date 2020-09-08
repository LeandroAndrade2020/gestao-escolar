<?php
    // error_reporting(0);
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    include("conexaoPDO.php");
    include 'includes/head.php';

    $nome   = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $escola = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');
    $rg     = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');

    $nome_aluno = (isset($_POST['nome']) && (!empty($_POST['nome'])) ? $_POST['nome'] : '');
    $ra = (isset($_POST['ra']) && (!empty($_POST['ra'])) ? $_POST['ra'] : '');
    $digito = (isset($_POST['digito']) && (!empty($_POST['digito'])) ? $_POST['digito'] : '');
    $serie = (isset($_POST['serie']) && (!empty($_POST['serie'])) ? $_POST['serie'] : '');
    $turma = (isset($_POST['turma']) && (!empty($_POST['turma'])) ? $_POST['turma'] : '');
    $periodo = (isset($_POST['periodo']) && (!empty($_POST['periodo'])) ? $_POST['periodo'] : '');
    $numero = (isset($_POST['numero']) && (!empty($_POST['numero'])) ? $_POST['numero'] : '');
    $situacao = (isset($_POST['situacao']) && (!empty($_POST['situacao'])) ? $_POST['situacao'] : '');
    $data_situacao = (isset($_POST['data_situacao']) && (!empty($_POST['data_situacao'])) ? $_POST['data_situacao'] : '');

    try {
        $stmt = $conection->prepare("SELECT * FROM matricula WHERE ra = :ra AND escola = :escola AND serie = :serie AND turma = :turma AND
            situacao = :situacao");
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->bindParam(':escola', $escola, PDO::PARAM_STR);
        $stmt->bindParam(':serie', $serie, PDO::PARAM_STR);
        $stmt->bindParam(':turma', $turma, PDO::PARAM_STR);
        $stmt->bindParam(':situacao', $situacao, PDO::PARAM_STR);
        $stmt->execute();
        
        $resultadoVerifica = $stmt->fetchAll();
        if (count($resultadoVerifica) > 0) { ?>
        <div class="text-center m-5"> 
            <h2 class="text-center">Já existe um aluno(a) cadastrado com os dados informados!</h2>
            <p style="font-size: 20px;">Se deseja apagar ou editar o aluno(a), <br> vá para a página de edição.</p>
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
                        <li class="list-group-item"><b>Dígito: </b> <?= empty($digito) ? "Não informado" : $digito?></li>
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
            </div>

        <?php 
            $stmtInsert = $conection->prepare("insert into matricula (nome, ra, digito, cie, escola, serie, turma, codigo_classe, periodo, numero_chamada, 
            situacao, data_situacao) values (:nome_aluno, :ra, :digito, '', :escola, :serie, :turma, '', :periodo, :numero, :situacao, :data_situacao)");
            $stmtInsert->execute(array(
                ':nome_aluno' => $nome_aluno,
                ':ra' => $ra,
                ':digito' => $digito,
                ':escola' => $escola,
                ':serie' => $serie,
                ':turma' => $turma,
                ':periodo' => $periodo,
                ':numero' => $numero,
                ':situacao' => $situacao,
                ':data_situacao' => $data_situacao
            ));
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' .$e->getMessage();
    }
?>