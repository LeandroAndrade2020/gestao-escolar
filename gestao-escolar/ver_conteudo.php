<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome   = isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '';
    $escola = isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '';
    $rg     = isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '';
?>

<html>

<head>
<?php include 'includes/head.php'; ?>
</head>
<body class="mx-auto text-center">

    <h2 class="display-4">Visualizar Conteúdo</h2>
    <form class="box mx-auto tex-center mt-5 mb-5" action="view_conteudo.php" method="POST" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);"> 
        <label>Escola:</label><br>

        <select class="escola custom-select" name="escola">
            <option value="" selected>Selecionar...</option>
            <?php
                include('conexaoPDO.php');
                try {
                    $stmt = $conection->prepare("SELECT DISTINCT escola FROM professor WHERE rg = :rg");
                    $stmt->bindParam(':rg', $rg, PDO::PARAM_INT);
                    $stmt->execute();

                    $resultado = $stmt->fetchAll();
                    if(count($resultado)) {
                        foreach($resultado as $row){
                            echo "<option value='".$row["escola"]."'>".$row["escola"]."</option>";
                        }
                    }
                } catch (PDOException $e) {
                    echo 'ERROR' . $e->getMessage();
                }
            ?>
        </select>

        <br>
        <label>Série: </label><br>
        <select class="custom-select" required id="serie" name="serie">
            <option value="">Selecionar...</option>
        </select>
     
        <hr>
        <input type="hidden" id="rg" name="rgprof" value="<?php echo htmlentities($rg) ?>">
        <button type="submit" class="btn btn-outline-primary">Enviar</button>
    </form>
        <?php 
            if($_SESSION['discPROF'] == 'ADM') {
                echo "<a href='menugestao.php' id='salvar' class='btn btn-outline-primary'>Voltar ao menu</a>";
            } else {
                echo "<a href='menu.php' id='salvar' class='btn btn-outline-primary'>Voltar ao menu</a>";
            }
        ?>

        <script>
        
            $(document).ready(function() {
                
                $('.escola').click(function () {
                let escola = $(this).val();
                console.log(escola);
                let rg = $("#rg").val();

                $('#serie').children('option').remove();

                $.post({
                    url: 'obterTurmas.php',
                    data: {
                        'escola': escola,
                        'rg': rg
                    },

                    success: function (res) {
                        console.log(res);
                        let response = JSON.parse(res);
                        console.log(Object.values(response));

                        function getValues(item, index) {
                            $('#serie').append(
                                `<option value="${item.serie},${item.turma}, ">${item.serie}º${item.turma}</option>`
                            )}
                        response.forEach(getValues);
                    },
                    error: function () {
                        console.log('Erro ao obter Séries...');
                    }
                })
            })

            })
            

        </script>
    </body>

</html>