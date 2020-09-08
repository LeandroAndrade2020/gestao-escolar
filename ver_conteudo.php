<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome   = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg     = $_SESSION['rgPROF'];
?>

<html>

<head>
<?php include 'includes/head.php'; ?>
</head>
<body class="mx-auto text-center">

    <h2 class="display-4">Visualizar Conteúdo</h2>
    <form class="box mx-auto tex-center mt-4" action="view_conteudo.php" method="POST"> 
        <label>Escola:</label><br>

        <select name="escola">
            <?php 
                include "conecta_mysql.php";
                $sql = "select distinct escola from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {
                   echo "<option value='".$row["escola"]."'>".$row["escola"]."</option>";
                }
            ?>
        </select>
        <br>
        <label>Série: </label><br>
        <select name="serie">
            <?php 
                include "conecta_mysql.php";
                $sql = "select * from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {
                   echo "<option value='{$row["serie"]},{$row["turma"]}'>"." {$row['serie']} - {$row['turma']}"."</option>";
                };
            ?>
        </select>
     
        <hr>
        <input type="hidden" id="rg" name="rgprof" value="<?php echo $rg ?>">
        <button type="submit" class="btn btn-outline-primary">Enviar</button>
    </form>
    <a href="menu.php" id="salvar" class="btn btn-outline-primary">Voltar ao menu</a>
    </body>

</html>