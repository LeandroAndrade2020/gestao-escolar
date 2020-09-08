<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_SESSION['escolaPROF'];
    $rg = $_SESSION['rgPROF'];


    include 'conecta_mysql.php';





    $notas = $_POST['notas'];
    $ras = $_POST['ra'];
    $divisor = 0;
    $rg_professor = $rg;
    $i = 0;
    $y = 0;
    $alunos_nota = [];

   

    //Separar as notas em um array bidimemsional
    foreach($notas as $nota){
        #echo $nota . '<br>';
        $i++;
        $alunos_nota[$ras[$y]][$i] = $nota;

        if($i > 8){
            #echo $ras[$y] . '<hr>';
            $y++;
            $i =0;
        }
    }




    foreach($alunos_nota as $aluno){
        echo $ras[$i] . '<br>';

        echo $aluno[1] . '<br>';
        echo $aluno[2] . '<br>';
        echo $aluno[3] . '<br>';
        echo $aluno[4] . '<br>';
        echo $aluno[5] . '<br>';
        echo $aluno[6] . '<br>';
        echo $aluno[7] . '<br>';
        echo $aluno[8] . '<br>';
        echo $aluno[9] . '<br>';
        echo '<hr>';

        //Verifica se o aluno existe na table:
        $sqlVerifica = "SELECT ra_aluno_notas from notas where ra_aluno_notas = '{$ras[$i]}'";
        $res = $conexao->query($sqlVerifica);
        if(mysqli_num_rows($res) >= 1){
            // $sql = "UPDATE notas SET nmat='999' WHERE ra_aluno_notas = {$ras[$i]}";
            // $conexao->query($sql);
            // $i++;
    
        }
        else{

        }
        
        //Deleta
        $del = "DELETE FROM notas WHERE ra_aluno_notas = '{$ras[$i]}'";
        $conexao->query($del);

        $sql = "INSERT INTO notas(ra_aluno_notas,rg_professor,nmat,ning,nport,ncie,nhist,ngeo,nart,nemp,nedf)  
        VALUES('{$ras[$i]}','$rg_professor','{$aluno[1]}','{$aluno[2]}','{$aluno[3]}','{$aluno[4]}','{$aluno[5]}','{$aluno[6]}','{$aluno[7]}','{$aluno[8]}','{$aluno[9]}')";
        $conexao->query($sql);
        $i++;


    }

    echo '<hr>';
    var_dump($_POST);
    

    