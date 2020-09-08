<?php 
    include ('conexaoPDO.php');

    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome       = (isset($_SESSION['nomePROF']) && (!empty($_SESSION['nomePROF'])) ?  $_SESSION['nomePROF'] : '');
    $escola     = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ?  $_SESSION['escolaPROF'] : '');
    $rg         = (isset($_SESSION['rgPROF']) && (!empty($_SESSION['rgPROF'])) ?  $_SESSION['rgPROF'] : '');
    $disciplina = (isset($_SESSION['discPROF']) && (!empty($_SESSION['discPROF'])) ?  $_SESSION['discPROF'] : '');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include 'includes/head.php'; ?>

    <body>
        <div class="container-fluid">
            <div class="mt-4 mb-4">
                <h2> <?php echo $escola; ?> </h2>
            </div>
            <div class="mt-4 mb-4">
                <a href="menugestao.php" id="salvar" class="btn btn-outline-primary">Voltar ao menu</a>
                <a href="form_adicionar_prof.php" id="salvar" class="btn btn-outline-secondary">Cadastrar Professor</a>
            </div>
        </div>

        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>Importante: </strong> Altere e salve um professor(a) por vez!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <table class='table table-hover table table-active table-responsive-sm'>
            <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">RG</th>
                <th class="text-center">Data de Nascimento</th>
                <th class="text-center">Série</th>
                <th class="text-center">Turma</th>
                <th class="text-center">Disciplina</th>
                <th class="text-center">Ações</th>
            </tr>

            <?php 
                try{

                    $stmt = $conection->prepare("SELECT * FROM professor WHERE escola = :escola ORDER BY nome ASC");
                    $stmt->bindParam(':escola', $escola, PDO::PARAM_STR);
                    $stmt->execute();
                    $resultado = $stmt->fetchAll();
                    
                    foreach($resultado as $row){ 
                        if($row['disciplina'] == 'ADM') {
                            echo '<tr class="table-success">';
                        } else {
                            echo '<tr class="table-active">';
                        }
                            echo "<td>
                                    <form action='edita_prof.php' method='POST'> 
                                    <input class='form-control form-control-sm' name='nome' type='text' value='{$row['nome']}'>
                                </td>";  
                            echo "<td>
                                    <div class='d-flex align-items-center'>
                                        <input class='form-control form-control-sm' name='rg' type='text' readonly value='{$row['rg']}'> &nbsp
                                        <i class='fas fa-lock m-auto ' style='color: gray; cursor: pointer;' data-toggle='tooltip' data-placement='top' title='Esse campo não pode ser editado!'></i>
                                    </div>
                                </td>";
                            echo "<td> 
                                    <input class='form-control form-control-sm' type='text' name='data_nascimento' class='form-control' data-language='pt-BR' inline='true' 
                                    data-position='bottom left' value='{$row['data_nascimento']}'>
                                </td>";
                            echo "<td>
                                    <select class='custom-select custom-select-sm' name='serie'>
                                        <option value='{$row['serie']}'>{$row['serie']}</option>
                                        <option value='EJA 1 - T1'>EJA 1 - T1</option>
                                        <option value='EJA 1 - T2'>EJA 1 - T2</option>
                                        <option value='EJA 1 - T3'>EJA 1 - T3</option>
                                        <option value='EJA 1 - T4'>EJA 1 - T4</option>
                                        <option value='EJA 2 - T1'>EJA 2 - T1</option>
                                        <option value='EJA 2 - T2'>EJA 2 - T2</option>
                                        <option value='EJA 2 - T3'>EJA 2 - T3</option>
                                        <option value='EJA 2 - T4'>EJA 2 - T4</option>
                                        
                                        <option value='Fase 1'>Fase 1</option>
                                        <option value='Fase 2'>Fase 2</option>
                                        <option value='Berçário 1'>Berçário 1</option>
                                        <option value='Berçário 2'>Berçário 2</option>
                                        <option value='Maternal 1'>Maternal 1</option>
                                        <option value='Maternal 2'>Maternal 2</option>
                                        <option value='1'>1</option>
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
                                    <select class='form-control form-control-sm' name='turma'>
                                        <option class='form-control form-control-sm' value='{$row['turma']}'>{$row['turma']}</option>
                                        <option value='A'>A</option>
                                        <option value='B'>B</option>
                                        <option value='C'>C</option>
                                        <option value='D'>D</option>
                                        <option value='E'>E</option>
                                        <option value='F'>F</option>
                                        <option value='G'>G</option>
                                        <option value='H'>H</option>
                                        <option value='-'>-</option>
                                    </select>
                                </td>";
                            echo "<td>
                                    <select class='form-control form-control-sm' name='disciplina'>
                                        <option value='{$row['disciplina']}'>{$row['disciplina']}</option>
                                        <option value='ADM'>ADM</option>
                                        <option value='-'>-</option>
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
                                        <option value='Ingles'>Ingles</option>
                                        <option value='PROFESSOR ADJUNTO I'>PROFESSOR ADJUNTO I</option>
                                        <option value='PROFESSOR ADJUNTO II'>PROFESSOR ADJUNTO II</option>
                                        <option value='SEDUC'>SEDUC</option>
                                    </select>
                                    <input class='form-control form-control-sm' name='escola' type='hidden' value='$escola'>
                                    <input class='form-control form-control-sm' name='id' type='hidden' value='{$row['id']}'>
                                </td>";
                            echo "<td style='display: flex;'>
                                    <input type='submit' class='btn btn-sm btn-outline-success mr-1' value='Salvar'>
                                    </form>
                                    <form action='apaga_prof.php' method='post'> 
                                        <input class='form-control form-control-sm' name='id' type='hidden' value='{$row['id']}'>
                                        <input type='submit' class='btn btn-sm btn-outline-danger' value='Apagar' style=''>
                                    </form> 
                                </td>";
                        echo '</tr>';
                    }
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
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