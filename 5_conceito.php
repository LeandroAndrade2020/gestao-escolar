<?php 

    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];

?>



<html>

<head>
<?php include 'includes/head.php'; ?>
</head>
<body class="mx-auto text-center">
    <h1 class="mb-1">Lançar 5º Conceito</h1>
    <form class="box mx-auto tex-center" action="insert_5_conceito.php" method="POST"> 
        Escola:<br> 
        <select name="escola">
            <?php 
                include "conecta_mysql.php";
                $sql = "select distinct escola from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {
                   echo "<option value='".$row["escola"]."'>".$row["escola"]."</option>";

                };
            
            ?>
        </select>
        <br>
        Serie: <br>
        <select name="serie">
            <?php 
                include "conecta_mysql.php";
                $sql = "select * from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {

                   echo "<option value='{$row["serie"]},{$row["turma"]},{$row['codigo_classe']}'>"." {$row['serie']} - {$row['turma']} Classe: {$row['codigo_classe']} "."</option>";

                };
            
            ?>
        </select>
        <br><hr>
        <input type="hidden" id="rg" name="rgprof" value="<?php echo $rg ?>">
        <input class="btn btn-primary" type="submit" name="submit" />
        <a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>
    </form>

    </body>

</html>