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
?>

<html>
<head>
    <?php include 'includes/head.php'; ?>
</head>

<body class="container-fluid">

    <h1><?php echo $escola; ?></h1>
    <p>Serie : <?php echo $serie ?> | Turma : <?php echo $turma ?><br>

        <a href="menugestao.php" id="salvar" class="btn btn-primary mt-4 mb-4">Voltar ao menu</a>
        <a href="form.php" id="salvar" class="btn btn-secondary mt-4 mb-4">Cadastrar Aluno</a>

        </div>
        <table class='table table-hover'>
            <tr>
                <th style="text-align: center;">Nome</th>
                <!-- <th>Disciplina</th> -->
                <th style="text-align: center;">Ra</th>
                <th style="text-align: center;">Digito</th>
                <th style="text-align: center;">Série</th>
                <th style="text-align: center;">Turma</th>
                <th style="text-align: center;">Período</th>
                <th style="text-align: center;">Número de Chamada</th>
                <th style="text-align: center;">Situação do Aluno</th>
                <th style="text-align: center;">Data da Situação</th>
            </tr>

            <?php 
        $sql = "select nome, ra, digito, serie, turma, periodo, numero_chamada, situacao, data_situacao,escola from matricula where serie = '$serie' and turma = '$turma' and escola = '$escola' ";
        $result = $conexao->query($sql);

        foreach($result as $consultas){
            echo '<div class="container"><tr>';
            echo "
            <td>
                <form action='edita_aluno.php'> 
                <input name='nome' type='text' value='{$consultas['nome']}'>
                
            </td> 
            <td>
                <input name='ra' style='max-width: 120px; margin: auto;' type='text' readonly value='{$consultas['ra']} '>
                <small class='form-text text-muted text-center'>Este campo não pode ser editado!</small>
            </td>
            <td>
                <input name='digito' style='max-width: 50px;' type='text' value='{$consultas['digito']}'>
            </td>              
            <td>
                <select name='serie' style='max-width: 70px;'>
                    <option value='{$consultas['serie']}'>{$consultas['serie']}</option>
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
                    <option value='{$consultas['turma']}'>{$consultas['turma']}</option>
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
                    <option value='{$consultas['periodo']}'>{$consultas['periodo']}</option>
                    <option value='Manhã'>Manhã</option>
                    <option value='Tarde'>Tarde</option>
                    <option value='Noite'>Noite</option> 
                </select>
            </td>
            <td>
                <select  name='numero_chamada' style='max-width: 75px; margin-right: auto; margin-left: auto;'>
                    <option value='{$consultas['numero_chamada']}'>{$consultas['numero_chamada']}</option>
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
                <select  name='situacao'>
                    <option value='{$consultas['situacao']}'>{$consultas['situacao']}</option>
                    <option value='Matriculado'>Matriculado</option>
                    <option value='Transferido'>Transferido</option>
                </select>
            </td>

            <td>
                <input name='data_situacao' type='text' value='{$consultas['data_situacao']}'>
                <input name='escola' type='hidden' value='{$consultas['escola']}'></td>             
            <td>
                <input type='submit' class='btn btn-success' value='Salvar'> 
        </form> 
            <form action='apaga_aluno.php'> 
                <input name='nome' type='hidden' value='{$consultas['nome']}'>
                <input name='escola' type='hidden' value='$escola'>
                <input name='ra' type='hidden' value='{$consultas['ra']}' readonly>
                <input name='serie' type='hidden' value='{$consultas['serie']}'>
                <input name='turma' type='hidden' value='{$consultas['turma']}'>
                <br>
                <input type='submit' class='btn btn-danger' value='Apagar'>      
            </form>  
                </td>";
            echo '</tr>';
        };
    echo '</table>';
    ?>
</body>
</html>