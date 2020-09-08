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
    $serie = $_GET['serie'];
    $turma = $_GET['turma'];

    // var_dump($_SESSION);
?>

<html>
<head>
    <?php include 'includes/head.php'; ?>
</head>

<body class="container-fluid">

    <h1><?php echo $escola; ?></h1>
    <p>Serie : <?php echo $serie ?> | Turma : <?php echo $turma ?><br>

        <a href="menugestao.php" id="salvar" class="btn btn-outline-primary mt-4 mb-4">Voltar ao menu</a>
        <a href="form.php" id="salvar" class="btn btn-outline-secondary mt-4 mb-4">Cadastrar Aluno</a>

        </div>
        <table class='table table-hover'>
            <tr>
                <th style="text-align: center;">Nome</th>
                <th style="text-align: center;">Ra</th>
                <th style="text-align: center;">Digito</th>
                <th style="text-align: center;">Série</th>
                <th style="text-align: center;">Turma</th>
                <th style="text-align: center;">Período</th>
                <th style="text-align: center;">Número de Chamada</th>
                <th style="text-align: center;">Situação do Aluno</th>
                <th style="text-align: center;">Data da Situação</th>
                <th style="text-align: center;">Ações</th>
            </tr>

            <?php 
        // $sql = "select nome, ra, digito, serie, turma, periodo, numero_chamada, situacao, data_situacao,escola from matricula where serie = '$serie' and turma = '$turma' and escola = '$escola' ";
        $sql = "select * from matricula where serie = '$serie' and turma = '$turma' and escola = '$escola' order by nome asc";
        $result = $conexao->query($sql);

        foreach($result as $consultas) {

            ?>
            <div class="container">

        <?php 
            $situacao = $consultas['situacao'];
            $serie    = $consultas['serie'];
            $turma    = $consultas['turma'];
            if($consultas['situacao'] == 'Transferido' || $consultas['situacao'] == 'Remanejado'){    
        ?>
        <tr class="table-danger">
            <?php } else {?>
                <tr class="table-active">
            <?php }?>

            <td>
                <form method="post" action='edita_aluno.php'>
                <input name='nome' type='text' value='<?php echo $consultas['nome'] ?>'>
            </td> 
            <td>
                <input name='ra' style='max-width: 120px; margin: auto;' type='text' readonly value='<?php echo $consultas['ra'] ?> '>
                <small class='form-text text-muted text-center'>Este campo não pode ser editado!</small>
            </td>
            <td>
                <input name='digito' style='max-width: 50px;' type='text' value='<?php echo $consultas['digito'] ?>'>
                <input type="hidden" name='id' value='<?php echo $consultas['id']?>'>
            </td>              
            <td>
                <select name='serie' style='max-width: 70px;'>
                    <option value='<?php echo $serie?>'><?php echo $serie?></option>
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
                </select>
            </td>
            <td>
                <select  name='turma' style='min-width: 80px;'>
                    <option value='<?php echo $turma?>' selected><?php echo $consultas['turma']?></option>
                    <option value='A'>A</option>
                    <option value='B'>B</option>
                    <option value='C'>C</option>
                    <option value='D'>D</option>
                    <option value='E'>E</option>
                    <option value='F'>F</option>
                    <option value='G'>G</option>
                    <option value='H'>H</option>
                </select>
            </td>
            <td>
                <select  name='periodo'>
                    <option value='<?php $consultas['periodo']?>'><?php echo $consultas['periodo']?></option>
                    <option value='Manhã'>Manhã</option>
                    <option value='Tarde'>Tarde</option>
                    <option value='Noite'>Noite</option> 
                </select>
            </td>
            <td>
                <select  name='numero_chamada' style='max-width: 75px; margin-right: auto; margin-left: auto;'>
                    <option value='<?php echo $consultas['numero_chamada']?>'><?php echo $consultas['numero_chamada']?></option>
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
            
            <select name='situacao'>
                    <option value='<?php echo $consultas['situacao'] ?>' selected><?php echo $consultas['situacao']?></option>
                    <option value='Matriculado'>Matriculado</option>
                    <option value='Transferido'>Transferido</option>
                    <option value='Reclassificado'>Reclassificado</option>
                    <option value='Remanejado'>Remanejado</option>
                    <option value='-'>-</option>
                </select>
            </td>

            <td>
                <input name='data_situacao' type='text' value='<?php echo $consultas['data_situacao']?>'>
                <input name='escola' type='hidden' value='<?php echo $consultas['escola']?>'></td>             
            <td>
                <input type='submit' class='btn btn-outline-success' value='Salvar'> 
        </form> 

            <form action='apaga_aluno.php' method="post"> 
                <input name='nome' type='hidden' value='<?php echo $consultas['nome']?>'>
                <input name='escola' type='hidden' value='<?php echo $consultas['escola']?>'>
                <input name='ra' type='hidden' value='<?php echo $consultas['ra']?>' readonly>
                <input name='serie' type='hidden' value='<?php echo $consultas['serie']?>'>
                <input name='turma' type='hidden' value='<?php echo $consultas['turma']?>'>
                <input name='id' type='hidden' value='<?php echo $consultas['id']?>'>
                <br>
                <input type='submit' class='btn btn-outline-danger' value='Apagar'>      
            </form>  
                </td>
        </tr>
        <?php }; ?>

</table>
</body>
</html>