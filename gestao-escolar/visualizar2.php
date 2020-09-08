<?php 
    // error_reporting(0);
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome       = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $rg         = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');
    $cod_classe = (isset($_SESSION['cod_classePROF']) && (!empty($_SESSION['cod_classePROF'])) ? $_SESSION['cod_classePROF'] : '');
    
    $conteudo        = (isset($_POST['conteudo']) && (!empty($_POST['conteudo'])) ? $_POST['conteudo'] : '');
    $interacao       = (isset($_POST['interacao']) && (!empty($_POST['interacao'])) ? $_POST['interacao'] : '');
    $escola          = (isset($_POST['escola']) && (!empty($_POST['escola'])) ? $_POST['escola'] : '');
    $interacaoPadrao = (isset($_POST['interacaoPadrao']) && (!empty($_POST['interacaoPadrao'])) ? $_POST['interacaoPadrao'] : '');
    $situacaoPadrao  = (isset($_POST['situacaoPadrao']) && (!empty($_POST['situacaoPadrao'])) ? $_POST['situacaoPadrao'] : '');
    $dia             = (isset($_POST['data']) && (!empty($_POST['data'])) ? $_POST['data'] : '');

    $_SESSION['dia'] = $dia;
    $serie = explode(',', $_POST['serie']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php include 'includes/head.php' ?>
    <body style="width: 100%;">

        <?php
            include_once('conexaoPDO.php');
    
            $date = mb_substr($dia,0 ,2);
            if($date > 31) {
                header('location: calendario.php');
            }
            
            $month = mb_substr($dia,2 ,2);
            if($month > 12) {
                header('location: calendario.php');
            }
            
            try {
                $stmt = $conection->prepare("SELECT * FROM matricula WHERE escola = :escola AND serie = :serie0 AND turma = :serie1 order by nome asc");
                $stmt->bindParam(':escola', $escola, PDO::PARAM_STR);
                $stmt->bindParam(':serie0', $serie[0], PDO::PARAM_STR);
                $stmt->bindParam('serie1', $serie[1], PDO::PARAM_STR);
                $stmt->execute();
                $resultado  = $stmt->fetchAll();
                
                $stmt2 = $conection->prepare("SELECT * FROM atividades WHERE escola = :escola AND serie = :serie0 AND turma = :serie1 AND dia = :dia AND rg_professor = :rg ORDER BY nome ASC");
                $stmt2->bindParam(':escola', $escola, PDO::PARAM_STR);
                $stmt2->bindParam(':serie0', $serie[0], PDO::PARAM_STR);
                $stmt2->bindParam(':serie1', $serie[1], PDO::PARAM_STR);
                $stmt2->bindParam(':dia', $dia, PDO::PARAM_STR);
                $stmt2->bindParam(':rg', $rg, PDO::PARAM_STR);
                $stmt2->execute();
                $resultado2 = $stmt2->fetchAll();

                if(count($resultado2) >= 1) {
                    $result = $resultado2;
                    $edit = true;
                    echo '<div class="alert alert-danger p-2 mb-2" role="alert" style="text-align: center; margin: auto; font-size: 90%; border-radius: 25px; width: 50%;">
                        Você está editando esta atividade.
                    </div>';

                    $sqlConteudo = $conection->prepare("SELECT * FROM conteudo WHERE escola = :escola AND serie = :serie0 AND turma = :serie1 AND rg_professor = :rg AND dia = :dia");
                    $sqlConteudo->bindParam(':escola', $escola, PDO::PARAM_STR);
                    $sqlConteudo->bindParam(':serie0', $serie[0], PDO::PARAM_STR);
                    $sqlConteudo->bindParam(':serie1', $serie[1], PDO::PARAM_STR);
                    $sqlConteudo->bindParam(':rg', $rg, PDO::PARAM_STR);
                    $sqlConteudo->bindParam(':dia', $dia, PDO::PARAM_STR);
                    $sqlConteudo->execute();
                    $resultConteudo = $sqlConteudo->fetchAll();
                } else {
                    $result = $resultado;
                    $edit= false;
                    echo '<div class="alert alert-danger p-2 mb-4 mt-4" role="alert" style="text-align: center; margin: auto; font-size: 90%; border-radius: 25px; width: 50%;">
                        Você está inserindo uma nova atividade.
                    </div>';
                }
                ?>
                
                <div class="modal fade" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" id="modalAviso" role="dialog">
                    <div class="modal-dialog" style="background-color: rgb(255,255,255,0.5); border-radius: 25px; top: 50%; transform: translateY(-50%);">
                        <div class="modal-content" style="position: relative; border: none;">
                            <br><br>
                            <div style="position: relative; width: 100%; text-align: center; padding: none;">
                                <img src="images/loading.gif" style="width: 30%;">
                                <p style="color: black; font-size: 20px">Carregando, aguarde...</p> <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ml-4">
                    <h3 class="display-5" id="escola"><?php echo $escola ?></h3>
                </div>
                <ul>
                    <li><b> RG do Professor : </b> <span id="rgPROF"><?php echo $rg ?></span><br></li>
                    <li><b> Dia selecionado : </b> <span id="dia"><?php echo $dia ?></span><br></li>
                    <li><b> Classe : </b> <span id="serie"><?php echo $serie[0] ?></span>° <span id="turma"><?php echo $serie[1] ?></span> <br></li>
                    <li><b> Experiência / Habilidade : </b></li>
                </ul>
        
                <form action='insert_faltas.php' method='post'>
                    <div class="form-group m-4">
                        <?php 
                            if ($edit) { 
                                foreach ($resultConteudo as $row) {
                                    ?>
                                        <textarea id="habilidade" class="form-control" placeholder="Digite a Experiência / Habilidade..." required name="conteudo" cols="25" rows="5" value="<?php echo $row["conteudo"] ?>"><?= $row["conteudo"] ?></textarea>
                                    <?php
                                }
                            } else {
                                ?>
                                <textarea id="habilidade" class="form-control" placeholder="Digite a Experiência / Habilidade..." required name="conteudo" cols="25" rows="5" value="<?php echo $conteudo ?>"></textarea>
                        <?php } ?>

                    </div>
                    <div class="text-center">
                        <a class="btn btn-outline-primary text-center" href="https://drive.google.com/drive/folders/1kvRct4QH1OgJ68vfthGGL1ofF5mbfgJf?usp=sharing" target="_blank">Visualizar Habilidades/Experiências</a>
                    </div>
                    <input type="hidden" name="serie" value="<?=$serie[0] ?>">
                    <input type="hidden" name="turma" value="<?=$serie[1] ?>">
                    <input type="hidden" name="escola" value="<?=$escola ?>">
                    <input type="hidden" name="dia" value="<?=$dia ?>">

                <?php
                    if (count($result) > 0) {
                        echo "<table class='table table-hover m-3 table-responsive-sm'>"
                        . '<tr>'
                            . '<th class="text-center">Nome</th>'
                            . '<th class="text-center">R.A</th>'
                            . '<th class="text-center">Interação</th>'
                            . '<th class="text-center">Situação</th>'
                            . '<th></th>'
                        . '</tr>';

                        foreach ($result as $row) {
                            if ($row['situacao'] == 'Transferido') {
                                echo '<tr class="table-danger">';
                            } else {
                                echo '<tr class="table-active">';
                            }
                                    echo '<td>' . $row['nome'] . '</td>'
                                    .'<td class="text-center">' . $row['ra'] . '</td>'
                                
                                    . "<th>
                                        <select class='custom-select custom-select-sm' name=\"{$row['ra']}[]\">
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
                                    <select class='custom-select custom-select-sm' name=\"{$row['ra']}[]\">
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
                        echo "<div class='text-center'>
                                <h3 class='display-5'>Turma não encontrada</h3>
                            </div>";
                    }
                ?>
                <div class="text-center m-4">
                    <hr>
                    <button id="btnModalAviso" class="btn btn-outline-primary mr-4" type="submit" data-toggle="modal" value="Terminar e enviar">Enviar</button>
                    <a href="menu.php" id="salvar" class="btn btn-outline-primary">Voltar ao menu</a>
                </div>
                </form> <?php
            } catch (PDOException $e) { 
                echo 'ERROR: ' . $e->getMessage();
            } ?>
        <script>
            $(document).ready(function() {
                var conteudo = $('#conteudo').text();
                var dia = $('#dia').text();
                var serie =  $('#serie').text();
                var turma =  $('#turma').text();
                var escola =  $('#escola').text();
                var rg_professor = $('#rgPROF').text();

                $("#terminar_chamada").click(function(){

                });

                // ATIVA MODAL
                $('#btnModalAviso').click(function(e) {
                    let habilidade = $('#habilidade').val();

                    let campos = [
                        habilidade
                    ]

                    var camposVazios = 0;
                    campos.forEach(function(item){
                        console.log(item);
                        item == '' ? camposVazios++ : '';
                    })

                    camposVazios == 0  ? $('#modalAviso').modal('show') : $('#modalAviso').modal('hide'); 
                })
            });
        </script>
    </body>
</html>