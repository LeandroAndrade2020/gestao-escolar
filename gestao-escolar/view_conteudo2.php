<?php 
    include('conexaoPDO.php');
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $turma = (isset($_POST['turma'])  && (!empty($_POST['turma'])) ? $_POST['turma'] : '');
    $serie = (isset($_POST['serie'])  && (!empty($_POST['serie'])) ? $_POST['serie'] : '');

    $nome       = (isset($_SESSION['nomePROF'])  && (!empty($_SESSION['nomePROF'])) ? $_SESSION['nomePROF'] : '');
    $escola     = (isset($_SESSION['escolaPROF'])  && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');
    $rg         = (isset($_SESSION['rgPROF'])  && (!empty($_SESSION['rgPROF'])) ? $_SESSION['rgPROF'] : '');
    $disciplina = (isset($_SESSION['discPROF'])  && (!empty($_SESSION['discPROF'])) ? $_SESSION['discPROF'] : '');
?>

<html>
    <?php include 'includes/head.php'; ?>
    <body>
        <div class="m-2">
            <h1><?php echo $escola; ?></h1>
            <p>Serie : <?php echo $serie ?> | Turma : <?php echo $turma ?><br>

                <a href="menugestao.php" id="salvar" class="btn btn-outline-primary mt-4 mb-4">Voltar ao menu</a>
                <a href="form.php" id="salvar" class="btn btn-outline-secondary mt-4 mb-4">Cadastrar Aluno</a>

                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Importante: </strong> Altere e salve um Aluno(a) por vez!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <table class='table table-hover table-sm'>
                        <tr>
                            <th style="text-align: center;">Nome</th>
                            <th style="text-align: center;">Ra</th>
                            <th style="text-align: center;">Digito</th>
                            <th style="text-align: center;">Série</th>
                            <th style="text-align: center;">Turma</th>
                            <th style="text-align: center;">Período</th>
                            <th style="text-align: center;">Número</th>
                            <th style="text-align: center;">Situação</th>
                            <th style="text-align: center;">Data da Situação</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>

                        <?php
                        try {
                            $stmt = $conection->prepare("SELECT * FROM matricula WHERE serie = :serie AND turma = :turma AND escola = :escola ORDER BY nome ASC");
                            $stmt->bindParam(':serie', $serie, PDO::PARAM_STR);
                            $stmt->bindParam(':turma', $turma, PDO::PARAM_STR);
                            $stmt->bindParam(':escola', $escola, PDO::PARAM_STR);
                            $stmt->execute();
                            
                            $resultado = $stmt->fetchAll();
                            if(count($resultado) >= 1) {
                                foreach($resultado as $row) {
                                    if($row['situacao'] == 'Transferido' || $row['situacao'] == 'Remanejado'){    
                        ?>
                        <tr class="table-danger m-0">
                            <?php } else {?>
                                <tr class="table-active m-0">
                            <?php }?>

                            <td>
                                <form method="post" action="edita_aluno.php">
                                <input name='nome' class="form-control form-control-sm" type='text' value="<?php echo $row['nome'] ?>">
                                <input name='id' type='hidden' value="<?php echo $row['id']?>">
                            </td> 
                            <td style="min-width: 50px;">
                                <div class="d-flex align-items-center">
                                    <input name='ra' class="form-control form-control-sm mr-1" type='text' readonly value="<?php echo $row['ra'] ?>">
                                    <i class="fas fa-lock m-auto" style="color: gray;  cursor: pointer;" data-toggle='tooltip' data-placement='top' title='Esse campo não pode ser editado!'></i>
                                </div>
                            </td>
                            <td>
                                <input name='digito' class="form-control form-control-sm m-auto" style='max-width: 35px;' type='text' value="<?php echo $row['digito'] ?>">
                                <input type="hidden" value="<?php echo $row['id']?>">
                            </td>              
                            <td>
                                <select name='serie' readonly class="form-control form-control-sm" style='max-width: 70px; min-width: 80px;'>
                                    <option value="<?php echo $row['serie']?>" selected><?php echo $row['serie']?></option>
                                    <!-- <option value='EJA 1 - T1'>EJA 1 - T1</option>
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
                                    <option value='9'>9</option> -->
                                </select>
                            </td>
                            <td>
                                <select name='turma' class="form-control form-control-sm" readonly style='min-width: 30px;'>
                                    <option value='<?php echo $row['turma']?>' selected><?php echo $row['turma']?></option>
                                    <!-- <option value='A'>A</option>
                                    <option value='B'>B</option>
                                    <option value='C'>C</option>
                                    <option value='D'>D</option>
                                    <option value='E'>E</option>
                                    <option value='F'>F</option>
                                    <option value='G'>G</option>
                                    <option value='H'>H</option> -->
                                </select>
                            </td>
                            <td>
                                <select class="form-control form-control-sm" name='periodo'>
                                    <option value="<?= $row['periodo']?>"><?php echo $row['periodo']?></option>
                                    <option value='Manhã'>Manhã</option>
                                    <option value='Tarde'>Tarde</option>
                                    <option value='Noite'>Noite</option> 
                                </select>
                            </td>
                            <td>
                                <select class="form-control form-control-sm" name='numero_chamada' style='max-width: 75px; margin-right: auto; margin-left: auto;'>
                                    <option value="<?php echo $row['numero_chamada']?>"><?php echo $row['numero_chamada']?></option>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option> 
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                    <option value='6'>6</option>
                                    <option value='7'>7</option>
                                    <option value='8'>8</option> 
                                    <option value='9'>9</option>
                                    <option value='10'>10</option>
                                    <option value='11'>11</option>
                                    <option value='12'>12</option>
                                    <option value='13'>13</option> 
                                    <option value='14'>14</option>
                                    <option value='15'>15</option>
                                    <option value='16'>16</option>
                                    <option value='17'>17</option>
                                    <option value='18'>18</option> 
                                    <option value='19'>19</option>
                                    <option value='20'>20</option>
                                    <option value='21'>21</option>
                                    <option value='22'>22</option>
                                    <option value='23'>23</option> 
                                    <option value='24'>24</option>
                                    <option value='25'>25</option>
                                    <option value='26'>26</option>
                                    <option value='27'>27</option>
                                    <option value='28'>28</option>
                                    <option value='29'>29</option> 
                                    <option value='30'>30</option>
                                    <option value='31'>31</option>
                                    <option value='32'>32</option>
                                    <option value='33'>33</option>
                                    <option value='34'>34</option> 
                                    <option value='35'>35</option>
                                    <option value='36'>36</option>
                                    <option value='37'>37</option> 
                                    <option value='38'>38</option>
                                    <option value='39'>39</option>
                                    <option value='40'>40</option>
                                    <option value='41'>41</option>
                                    <option value='42'>42</option> 
                                    <option value='43'>43</option>
                                    <option value='44'>44</option>
                                    <option value='45'>45</option>
                                    <option value='46'>46</option>
                                    <option value='47'>47</option> 
                                    <option value='48'>48</option>
                                    <option value='49'>49</option>
                                    <option value='50'>50</option>
                                </select>
                            </td>
                            <td>
                            
                            <select name='situacao' class="form-control form-control-sm">
                                    <option value="<?php echo $row['situacao'] ?>" selected><?php echo $row['situacao']?></option>
                                    <option value='Matriculado'>Matriculado</option>
                                    <option value='Transferido'>Transferido</option>
                                    <option value='Reclassificado'>Reclassificado</option>
                                    <option value='Remanejado'>Remanejado</option>
                                    <option value='-'>-</option>
                                </select>
                            </td>

                            <td>
                                <input name="data_situacao" class="form-control form-control-sm" type='text' value="<?php echo $row['data_situacao']?>">
                                <input name='escola' class="form-control form-control-sm" type='hidden' value="<?php echo $row['escola']?>"></td>             
                            <td>
                            <div class="d-flex">
                                <input type='submit' class='btn btn-outline-success form-control form-control-sm mr-1' value='Salvar'> 
                        </form> 

                            <form action='apaga_aluno.php' method="post"> 
                                <input name='nome' type='hidden' value="<?php echo $row['nome']?>">
                                <input name='escola' type='hidden' value="<?php echo $row['escola']?>">
                                <input name='ra' type='hidden' value="<?php echo $row['ra']?>" readonly>
                                <input name='serie' type='hidden' value="<?php echo $row['serie']?>">
                                <input name='turma' type='hidden' value="<?php echo $row['turma']?>">
                                <input name='id' type='hidden' value="<?php echo $row['id']?>">
                                <input type='submit' class='btn btn-outline-danger form-control form-control-sm' value='Apagar'>      
                            </form>  
                        </div>
                                </td>
                        </tr>
                        <?php }
                    } else {
                        echo "<div class='text-center m-5'> 
                                <h2 class='text-center'>Não há alunos nesta turma.<h2><br>
                                <a href='form_busca.php' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>Voltar</a>
                            </div>";
                    }?>
                    </table>
                <?php } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                } ?>
            </div>
    </body>
</html>