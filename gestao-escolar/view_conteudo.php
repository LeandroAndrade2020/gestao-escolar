<?php 
    include('conexaoPDO.php');
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome       = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $escola     = (isset($_POST['escola']) && (!empty($_POST['escola'])) ? $_POST['escola'] : '');
    $serie      = (!empty($_POST['serie']) ? explode(',', $_POST['serie']) : '');

    $rg         = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');
    $disciplina = (isset($_SESSION['discPROF']) && (!empty($_SESSION['discPROF'])) ? $_SESSION['discPROF'] : '');
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
   
    <table class='table table-hover table-responsive-sm'>
    <tr>
        <th class="text-center">Data</th>
        <th class="text-center">Experiência / Habilidade</th>
        <th class="text-center">Ações</th>
    </tr>

    <?php
        try {
            $stmt = $conection->prepare("SELECT * FROM conteudo WHERE rg_professor = :rgPROF AND serie = :serie AND turma = :turma AND escola = :escola ORDER BY str_to_date(`dia`, '%d/%m/%Y') DESC");
            $stmt->bindParam(':rgPROF', $rg);
            $stmt->bindParam(':serie', $serie[0]);
            $stmt->bindParam(':turma', $serie[1]);
            $stmt->bindParam(':escola', $escola);
            $stmt->execute();
            
            $resultado = $stmt->fetchAll();
            $countResultado = count($resultado);
            if($countResultado == 1) {
                echo '<ul>
                <li>
                    <p><b>' . count($resultado) . '</b> atividade lançada.</p>
                </li>
            </ul>';
            } else if($countResultado > 1){
                echo '<ul>
                    <li>
                        <p><b>' . count($resultado) . '</b> atividades lançadas.</p>
                    </li>
                </ul>';
            } else if($countResultado == 0) {
                echo '<ul>
                    <li>
                        <p><b>Nenhuma atividade lançada.</b></p>
                    </li>
                </ul>';
            }

            if($countResultado > 0) {
                foreach($resultado as $row) {
                    echo '<tr>';
                        echo "<td class='text-center align-middle'>{$row['dia']}</td>";                    
                        echo "<td class='text-center align-middle'>{$row['conteudo']}</td>";
                        echo "<div style='display: flex' class='align-middle'>
                        <td class='text-center align-middle' style='display: flex;'>
                            <form method='post' action='visualizar2.php'>
                                <input name='escola' type='hidden' value='{$escola}'>
                                <input name='conteudo' type='hidden' value='{$row['conteudo']}'>
                                <input name='data' type='hidden' value='{$row['dia']}'>
                                <input name='serie'type='hidden' value='{$serie[0]},{$serie[1]}'>
                                <input type='submit' class='btn btn-outline-primary mr-1' value='Editar'> 
                            </form>
                            <form method='post' action='delet_faltas.php'>
                                <input name='data' type='hidden' value='{$row['dia']}'>
                                <input name='escola' type='hidden' value='{$escola}'>
                                <input name='conteudo' type='hidden' value='{$row['conteudo']}'>
                                <input name='serie'type='hidden' value='{$serie[0]},{$serie[1]}'>
                                <input type='submit' class='btn btn-outline-danger' value='Apagar'>
                            </form> 
                        </td></div>";
                    echo '</tr>';
                }
                echo "</table>";
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    ?>
    </div>
    </body>
</html>