    <?php 
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome   = isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '';
    $escola = isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '';
    $rg     = isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '';
?>
<html>
    <?php
        include 'includes/head.php';
    ?>
    <body class="mx-auto text-center">
        <input type="hidden" name="rg" id="rg" value="<?=$rg?>">
        <h2 class="m-3 display-4">Enviar atividade</h2>
        <form class="box row mx-auto" action="visualizar2.php" method="POST" style="box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
            <label>Data: </label><br>
            <input type='text' placeholder="Data..." name="data" class="datepicker-here form-control" data-language='pt-BR' inline="true"
                data-position="bottom left" required maxlength="10" onkeydown="return false;" id="data"/>
            <br><br>
            <label>Escola:</label><br>
            <select class="escola custom-select" name="escola" required id="escola">
                <option value="">Selecionar...</option>

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
                        echo 'ERROR: ' . $e->getMessage();
                    }
                ?>
            </select><br>
            <br><label>Série: </label>
            <br>
            <select class="custom-select" d="serie" name="serie" required id="serie">
                <option value="">Selecionar...</option>
            </select>
            <br><br>
            <label>Interação Padrão: </label><br>
            <select class="custom-select" name="interacaoPadrao" id="intPadrao">
                <option> - </option>
                <option>Facebook</option>
                <option>Whatsapp</option>
                <option>Outro</option>
                <option>Classroom</option>
                <option>Aula</option>
                <option>Impresso</option>
            </select><br><br>

            <label>Situação Padrão: </label><br>
            <select class="custom-select" name="situacaoPadrao" id="sitPadrao">
                <option> - </option>
                <option>Não devolvido</option>
                <option>Devolvido</option>
                <option>C</option>
                <option>F</option>
            </select>
            <input id="btnModalAviso" class="btn btn-outline-primary btn-block m-4" type="submit" data-toggle="modal" name="submit"/>
        </form> 
        
        <div class="modal fade" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" id="modalAviso" role="dialog">
            <div class="modal-dialog" style="background-color: rgb(255,255,255,0.9); border-radius: 25px; position: relative; top: 50%; transform: translateY(-50%);">
                <div class="modal-content" style="border: none;">
                    </div style="text-align: center;">
                    <br><br>
                        <p><img src="images/loading.gif" style="width: 30%;"></p>
                        <p style="color: black; font-size: 20px">Carregando, aguarde...</p> <br>
                    </div>
                </div>
            </div>
        </div>

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
                        console.log('erro ao obter series');
                    }
                });
                
                // ATIVA MODAL
                $('#btnModalAviso').click(function(e) {
                    let data      = $('#data').val();
                    let escola    = $('#escola').val();
                    let serie     = $('#serie').val();
                    let interacao = $('#intPadrao').val();
                    let situacao  = $('#sitPadrao').val();

                    let campos = [
                        data,
                        escola,
                        serie,
                        interacao,
                        situacao
                    ]

                    var camposVazios = 0;
                    campos.forEach(function(item){
                        console.log(item);
                        item == '' ? camposVazios++ : '';
                    })

                    camposVazios == 0  ? $('#modalAviso').modal('show') : $('#modalAviso').modal('hide'); 
                })
            });
        </script>

    </body>
</html>