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

<input type="hidden" name="rg" id="rg" value="<?=$rg?>">

    <h1 class="mb-1">Ver Conteúdo</h1>
    <form class="box mx-auto tex-center" action="view_conteudo.php" method="POST"> 
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
            <option value="">Selecionar...</option>
            <?php 
                include "conecta_mysql.php";
                $sql = "select * from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);

                while($row = $result->fetch_assoc()) {
                echo "<option value='{$row["serie"]},{$row["turma"]},{$row['codigo_classe']}'>"." {$row['serie']} - {$row['turma']} Classe: {$row['codigo_classe']} "."</option>";
                };
            ?>
        </select>
        <br>

        <!-- Disciplina: <br><select  name="disciplina"> -->
        <?php 
                // include "conecta_mysql.php";
                // $sql = "select distinct serie from professor where rg = '".$rg."'";
                // $result = $conexao->query($sql);
                // while($row = $result->fetch_assoc()){
                //     if($row['serie']<6){
                //         echo "<option value='PEB1'>PEB I</option>";
                //     }else{
                //         $sql = "select distinct disciplina, CONVERT(disciplina using utf8) from professor where rg = '".$rg."'";
                //         $result = $conexao->query($sql);
        
                //         while($row = $result->fetch_assoc()) {
                //            echo "<option value='".$row["disciplina"]."'>".$row["disciplina"]."</option>";
        
                //         }; 
                //     };

                // };


            ?>
        <!-- </select><br> -->

    
        <br>
     
  <hr>
        <input type="hidden" id="rg" name="rgprof" value="<?php echo $rg ?>">
        <input class="btn btn-primary" type="submit" name="submit" />
    </form>
    <a href="menu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>
    </body>

</html>