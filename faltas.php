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
    <h1 class="mb-3">Ver faltas</h1>
    <form class="box row mx-auto" action="ver_faltas.php" method="POST">
        <br>
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
        Serie:       
        <br>
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
        <br>
    
        
        Disciplina: <br>
        <select name="disciplina">
        <?php 
                include "conecta_mysql.php";
                
                $sql = "select distinct serie from professor where rg = '".$rg."'";
                $result = $conexao->query($sql);
                while($row = $result->fetch_assoc()){
                    if($row['serie']<6){
                        echo "<option value='PEB1'>PEB I</option>";
                    }else{
                        $sql = "select distinct disciplina, CONVERT(disciplina using utf8) from professor where rg = '".$rg."'";
                        $result = $conexao->query($sql);
        
                        while($row = $result->fetch_assoc()) {
                           echo "<option value='".$row["disciplina"]."'>".$row["disciplina"]."</option>";
        
                        }; 
                    };

                };


            ?>
        </select><br>
        
        <!-- <input type='number' name="qtd_aulas" place="qtd_aulas" value="1" /><br> -->
        

        <input class="btn btn-primary" type="submit" name="submit" />
    </form>





    <!-- Include English language -->
    <script src="plugins\datepicker\js\i18n\datepicker.pt-BR.js"></script>

    <script>
        var disabledDays = [0, 6];

        $('.datepicker-here').datepicker({
            language: 'pt-BR',
            onRenderCell: function (date, cellType) {
                if (cellType == 'day') {
                    var day = date.getDay(),
                        isDisabled = disabledDays.indexOf(day) != -1;

                    return {
                        disabled: isDisabled
                    }
                }
            }
        })
    </script>



    </body>

</html>