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
    <h1 class="mb-1">Ver notas</h1>
    <form class="box mx-auto tex-center" action="view_notas.php" method="POST"> 
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
                $sql = "select distinct serie from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {

                   echo "<option value='".$row["serie"]."'>".$row["serie"]."</option>";

                };
            
            ?>
        </select>
        <br>
        Turma: <br>
        <select name="turma">
        <?php 
                include "conecta_mysql.php";
                $sql = "select distinct turma from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {
                   echo "<option value='".$row['turma']."'>".$row["turma"]."</option>";

                };
            
            ?>
        </select><hr>
        Notas : <br>
        <select name="notas" onchange=>
                <option value='notas'>4º Bimestre</option>
                <option value='notas5'>5º Conceito</option>

        </select>
        <br>
        <input type="hidden" id="rg" name="rgprof" value="<?php echo $rg ?>">
        <input class="btn btn-primary" type="submit" name="submit" action="view_notas5.php" />
        <a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>
    </form>
    
    </body>

</html>