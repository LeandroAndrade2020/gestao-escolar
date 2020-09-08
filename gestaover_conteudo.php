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

    <h1 class="mb-3">Ver Conteúdo</h1>
    <form class="box mx-auto tex-center" action="gestaoview_conteudo.php" method="POST"> 
        Escola:<br>
        <select class="escola" name="escola" required>
            <option value="">Selecionar...</option>
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
        <select id="serie" name="serie" required>
            <option value="">Selecionar...</option>
            <?php 
                // include "conecta_mysql.php";
                // $sql = "select * from professor where rg = '".$rg."'";
                // $result = $conexao->query($sql);

                // while($row = $result->fetch_assoc()) {
                //    echo "<option value='{$row["serie"]},{$row["turma"]},{$row['codigo_classe']}'>"." {$row['serie']} - {$row['turma']} Classe: {$row['codigo_classe']} "."</option>";
                // };
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

        <input class="btn btn-primary btn-block " type="submit" name="submit" /><br>

    </form>

    <!-- Include English language -->
    <script src="plugins\datepicker\js\i18n\datepicker.pt-BR.js"></script>

    <script>
        $(document).ready(function () {
            $('#peb1').hide();
            $('#peb2').hide();
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

            $('#serie').on('change', function () {
                var string = this.value;
                var serie = string.split(",");
                if (serie[0] > 5) {
                    console.log('PEB II');

                    $('#peb1').hide();
                    $('#peb2').show();
                } else {
                    console.log('PEB I / Ed. Infantil');
                    $('#peb2').hide();
                    $('#peb1').show();
                }
            });
        });

        $('#submit').hide();
    </script>

    <script>
        $('.escola').change(function(){

            let escola = $(this).val();
            console.log(escola);
            let rg = $("#rg").val();

            $('#serie').children('option').remove();

            $.post({
                url: 'obterTurmas.php',
                data: { 
                    'escola': escola,
                    'rg'    : rg
                 },

                success: function(res){

                    let response = JSON.parse(res);
                    console.log(Object.values(response));

                    function getValues(item, index){
                        $('#serie').append(`<option value="${item.serie},${item.turma}, ">${item.serie}º${item.turma}</option>`)
                    }

                    response.forEach(getValues);
                },
                error : function(){
                    console.log('erro ao obter series')
                } 
            })

        });
    </script>
</body>
</html>