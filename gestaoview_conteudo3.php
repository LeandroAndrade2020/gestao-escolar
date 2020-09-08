<?php 
    include 'conecta_mysql.php';

    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];
    $disciplina = $_SESSION['discPROF'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>

<body>
    <div class="container-fluid">
        <div class="mt-4 mb-4">
            <h2><?php echo $escola; ?></h2>
        </div>

        <div class="mt-4 mb-4">
            <a href="gestaomenu.php" id="salvar" class="btn btn-primary">Voltar ao menu</a>
            <a href="gestaoform_adicionar_prof.php" id="salvar" class="btn btn-secondary">Cadastrar Professor</a>
        </div>

    </div>
    <table class='table table-hover'>
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">RG</th>
            <th class="text-center">Data de Nascimento</th>
            <th class="text-center">Série</th>
            <th class="text-center">Turma</th>
            <th class="text-center">Disciplina</th>
        </tr>

        <?php 
        $sql = "select nome, rg, id, serie, turma, disciplina, data_nascimento from professor where escola = '$escola' ";
        $result = $conexao->query($sql);
    
        foreach($result as $consultas){
            echo '<tr>';
            echo "<td>
            <form action='gestaoedita_prof.php' method='POST'> 
                <input name='nome' type='text' value='{$consultas['nome']}'></td>";
                // echo "<td>$disciplina</td>";

                echo "<td>
                    <input name='rg' type='text' readonly value='{$consultas['rg']}'>
                    <small class='form-text text-muted text-center'>Este campo não pode ser editado!</small>
                </td>";

                echo "<td> <input type='text' name='data_nascimento' class='form-control' data-language='pt-BR' inline='true' 
                     data-position='bottom left' value='{$consultas['data_nascimento']}'></td>";

                echo "<td>
                <select name='serie'>
                    <option value='{$consultas['serie']}'>{$consultas['serie']}</option>
                    <option value='Fase 1'>Fase 1</option>
                    <option value='Fase 2'>Fase 2</option>
                    <option value='Berçário 1'>Berçário 1</option>
                    <option value='Berçário 2'>Berçário 2</option>
                    <option value='Maternal 1'>Maternal 1</option>
                    <option value='Maternal 2'>Maternal 2</option>
                    <option value='1'>1</option>s
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    <option value='6'>6</option>
                    <option value='7'>7</option>
                    <option value='8'>8</option>
                    <option value='9'>9</option>
                    <option value='-'>-</option>
                </select>
                </td>";
                echo "<td>
                <select  name='turma'>
                    <option value='{$consultas['turma']}'>{$consultas['turma']}</option>
                    <option value='A'>A</option>
                    <option value='B'>B</option>
                    <option value='C'>C</option>
                    <option value='D'>D</option>
                    <option value='E'>E</option>
                    <option value='F'>F</option>
                    <option value='G'>G</option>
                    <option value='H'>H</option>
                    <option value='-'>-</option>
                </select></td>";
                echo "<td>
                    <select  name='disciplina'>
                        <option value='{$consultas['disciplina']}'>{$consultas['disciplina']}</option>
                        <option value='ADM'>ADM</option>
                        <option value='Arte'>Arte</option>
                        <option value='Ciencias'>Ciências</option>
                        <option value='Matematica'>Matemática</option>
                        <option value='Portugues'>Portugues</option>
                        <option value='Ed. Fisica'>Ed. Fisica</option>
                        <option value='Empreendedorismo'>Empreendedorismo</option>
                        <option value='FUND I'>FUND I</option>
                        <option value='Geografia'>Geografia</option>
                        <option value='Historia'>Historia</option>
                        <option value='Infantil'>Infantil</option>
                        <option value-'Ingles'>Ingles</option>
                        <option value='PROFESSOR ADJUNTO I'>PROFESSOR ADJUNTO I</option>
                        <option value='PROFESSOR ADJUNTO II'>PROFESSOR ADJUNTO II</option>
                        <option value='SEDUC'>SEDUC</option>
                    </select>
                    <input name='escola' type='hidden' value='$escola'>
                    <input name='id' type='hidden' value='{$consultas['id']}'>
                    </td>";
                    echo "<td>
                        <input type='submit' class='btn btn-success' value='Salvar alteração'><br>
                </form><br>

                <form action='gestaoapaga_prof.php'> 
                    <input name='id' type='hidden' value='{$consultas['id']}'>
                    <input type='submit'  class='btn btn-danger' value='Apagar Professor'><br>
                </td>
                    </form> 
                </td>";
            echo '</tr>';
        };
    echo '</table>';
    ?>

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
        </div>
</body>

</html>