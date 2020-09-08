<?php 
    include('conexaoPDO.php');   
    include 'crud/crud.php';
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome   = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $serie  = (isset($_SESSION['seriePROF']) && (!empty($_SESSION['seriePROF'])) ? $_SESSION['seriePROF'] : '');
    $escola = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<?php include 'includes/head.php'; ?>
    
    <body class="menu mx-auto text-center">
        <h1 class="display-4 mt-3">Bem-Vindo (a)</h1>
        <p class="lead"> <i class="fas fa-user"></i> <?php echo htmlentities($nome); ?> </p>
        <b>RG: </b><?= htmlentities($_SESSION['rgPROF'])?>
        <div class="box mx-auto" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
            <a class='btn d-block btn-outline-success' href='calendario.php' role='button'> <i class='fas fa-clipboard-list'></i>
            Envios de atividades</a>
            <a class="btn d-block btn-outline-warning" href=ver_conteudo.php role="button"> <i class="fas fa-list-alt"></i> Visualizar ou Editar atividades</a>
            <!-- <a class="btn d-block btn-outline-info" href=relatorio_geral.php role="button"> <i class="fas fa-graduation-cap"></i>Gráficos e Relatórios</a> -->
            
            <table class='table table-hover'>
            <?php 
                echo '<tr>';
                    echo "<td style='border: none'>
                            <form action='valida.php'  method='post'>
                                <input name='professor' type='hidden' value='{$_SESSION['cieESCOLA']}'>
                                <input name='senha' type='hidden' value='{$_SESSION['telESCOLA']}'>
                                <input type='submit' class='btn btn-outline-danger' value='Voltar para a Escola'> 
                            </form> 
                        </td>";
                    echo '</tr>';
                echo '</table>';
            ?>
        </div>
        <!-- <script langauge="JavaScript">
            function newWindow(fileName,windowName) { 
                msgWindow =  window.open(fileName,windowName);
            }
        </script>

            <a href="javascript:newWindow('1.html','window1')">Open Window</a> -->

    </body>
</html>