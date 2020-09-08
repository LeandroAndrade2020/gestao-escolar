<?php 
    include('conexaoPDO.php');

    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome       = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $escola     = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');
    $rg         = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');
    $disciplina = (isset($_SESSION['discPROF']) && (!empty($_SESSION['discPROF'])) ? $_SESSION['discPROF'] : '');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<?php include 'includes/head.php'; ?>
    <body class="menu mx-auto text-center">
        <table class='table table-hover'>
        <?php 
            try {
                $stmt = $conection->prepare("SELECT * FROM professor WHERE escola = :escola GROUP BY nome HAVING COUNT(*)>0");
                $stmt->bindParam(':escola', $escola, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetchAll();

                ?> 
                <div class="display-flex">
                
                <?php foreach($resultado as $row) {
                    if($row['disciplina'] == 'ADM') {
                        echo '<tr class="table-success">';
                    } else{
                        echo '<tr class="table-active">';
                    }
                        echo "<td style='max-width: 100%;'>
                                <form action='validaprofessor.php'  method='post'> 
                                    <input name='professor' type='hidden' value='{$row['rg']}'>
                                    <input name='senha' type='hidden' value='{$row['data_nascimento']}'>
                                    <input type='submit' onclick='openNewTab()' class='btn btn-outline-primary' value='{$row['nome']}'> 
                                </form> 
                            </td>";
                    echo '</tr>';
                }
                echo '</div></table>';
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
        ?>

        <script>
            function openNewTab() {
                window.open(url, "_blank");
            }
        </script>
    </body>
</html>