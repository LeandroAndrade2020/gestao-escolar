<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php 
        session_start();
        date_default_timezone_set('America/Sao_Paulo');

        if(!isset($_SESSION['nomePROF'])){
            header('location: index.php');
        };
        
        include 'includes/head.php';
        $nome = $_SESSION['nomePROF'];
        $escola = $_POST['escola'];
        $rg = $_SESSION['rgPROF'];
        $serie = explode(',',$_POST['serie']);
        $dia = "01/10/2019";
        $disciplina = $_POST['disciplina'];
        $dis = "nmat";
     ?>
</head>
<body class="container-fluid">
<h1>Diário de Faltas</h1>

<?php

    include 'conecta_mysql.php';


    $d = 54;

    $data = str_replace('/','-',$dia);
    echo '<h1>'.$escola.'</h1>';
    echo "<table class='table table-sm table-striped'>";

    echo '<tr>';
    echo '<th>Nome</th>';
    for($i = 0; $i < $d; $i++){
        $diaF = date('d/m/Y', strtotime("+$i weekdays",strtotime($data))); // Dia increnentado e formatado
        echo '<th>'.date('d/m', strtotime("+$i weekdays",strtotime($data))). '</th>';
    }
    echo '<th>Total</th>';
    
    if($serie[0]<6){
       echo "<th>Mat</th>"
        . "<th>Ing</th>"
        . "<th>Por</th>"
        . "<th>Cie</th>"
        . "<th>His</th>"
        . "<th>Geo</th>"
        . "<th>Art</th>"
        . "<th>Ed. Fis</th>"
        . "<th>Emp</th>" ;

    }else{
        switch($disciplina){
            case "Língua Portuguesa":
                $dis = "nport";
                echo "<th>Português</th>";
                break;
            case "Ciências":
                $dis = "ncie";
                echo "<th>Ciências</th>";
                break;
            case "Arte":
                $dis = "nart";
                echo "<th>Artes</th>";
                break;
            case "Matemática":
                $dis = "nmat";
                echo "<th>Matemática</th>";
                break;
            case "Geografia":
                $dis = "ngeo";
                echo "<th>Geografia</th>";
                break;
            case "Língua Estrangeira I":
                $dis = "ning";
                echo "<th>Língua Estrangeira I</th>";
                break;
            case "História":
                $dis = "nhist";
                echo "<th>História</th>";
                break;
            case "Educação Física":
                $dis = "nedf";
                echo "<th>Educação Física</th>";
                break;
            case "PEB 1":
                header('location: faltas.php');
                break;
        }
    }
        echo '</tr>';

    $d = 54;
    for($i = 0; $i < $d; $i++){
        $diaF = date('d/m/Y', strtotime("+$i weekdays",strtotime($data))); // Dia increnentado e formatado
        #echo '<h5>'.date('d/m/Y', strtotime("+$i weekdays",strtotime($data))). '</h5>';

        $sqlFaltas = "SELECT distinct matricula.nome, matricula.ra
        from matricula left join faltas on matricula.ra = faltas.ra_aluno_falta where matricula.serie = '$serie[0]' and
        turma = '$serie[1]' and escola = '$escola' order by matricula.nome";
        $rows = $conexao->query($sqlFaltas);
        $res = $rows->fetch_all();
        
        
    }
    if($serie[0]<6){
        //Calcula Faltas do PEB 1
        for($x=0; $x < count($res); $x++ ){
            echo '<tr>';
            echo '<td>' . $res[$x][0] . '</td>';
            for($i = 0; $i < $d; $i++){
                $diaF = date('d/m/Y', strtotime("+$i weekdays",strtotime($data))); // Dia increnentado e formatado
                #echo '<h5>'.date('d/m/Y', strtotime("+$i weekdays",strtotime($data))). '</h5>';
                 //Calcula Faltas por dia
                $sqlFaltas = "SELECT distinct matricula.nome, matricula.ra,
                (SELECT sum(if(dia = '$diaF',if(peb1='$disciplina',1,0),0))
                from faltas where faltas.ra_aluno_falta = matricula.ra) as TotalFaltas
                from matricula left join faltas on matricula.ra = faltas.ra_aluno_falta where matricula.serie = '$serie[0]' and
                turma = '$serie[1]' and escola = '$escola' order by matricula.nome";
                $rows = $conexao->query($sqlFaltas);
                $res = $rows->fetch_all();
                if($res[$x][2] == null){
                    echo '<td>0</td>';
                }else{
                echo '<td>' . $res[$x][2] . '</td>';
                }
                
            }
            //Calcula total de faltas
            $sqlTotal = "select distinct matricula.nome,
            (select sum(faltas.peb1 is not null) from faltas where faltas.ra_aluno_falta = matricula.ra) as TotalFaltas 
            from matricula left join faltas on matricula.ra = faltas.ra_aluno_falta where matricula.serie = '$serie[0]' and
            turma = '$serie[1]' and escola = '$escola' order by matricula.nome ; ";
    
            $linhas = $conexao->query($sqlTotal);
            $resultado = $linhas->fetch_all();
            if ($resultado[$x][1] == null) {
            echo '<td>0</td>';
            }else{
            echo '<td>'.$resultado[$x][1].'</td>';
            }
            //Calcula a nota que já está na Database do PEB I
            $sqlNota = "SELECT matricula.nome, notas.* FROM matricula 
            LEFT JOIN notas ON matricula.ra = notas.ra_aluno_notas where matricula.escola = '$escola' 
            and matricula.serie = '$serie[0]' and matricula.turma = '$serie[1]' 
            and matricula.codigo_classe='$serie[2]' order by nome asc ";
            $notas = $conexao->query($sqlNota);
            $result = $notas->fetch_all();
            if ($result[$x][6] == null) {
            echo '<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>'
            .'<td>0</td>';
            }else{
            echo '<td>'.$result[$x][6].'</td>'
            .'<td>'.$result[$x][7].'</td>'
            .'<td>'.$result[$x][8].'</td>'
            .'<td>'.$result[$x][9].'</td>'
            .'<td>'.$result[$x][10].'</td>'
            .'<td>'.$result[$x][11].'</td>'
            .'<td>'.$result[$x][12].'</td>'
            .'<td>'.$result[$x][13].'</td>'
            .'<td>'.$result[$x][14].'</td>';
            }
            echo '</tr>';
            //echo $res[$x][2] . '<br>';
        
        }

    }else{
    //Calcula Faltas do PEB 2
    //Calcula Tudo
    for($x=0; $x < count($res); $x++ ){
        echo '<tr>';
        echo '<td>' . $res[$x][0] . '</td>';
        for($i = 0; $i < $d; $i++){
            $diaF = date('d/m/Y', strtotime("+$i weekdays",strtotime($data))); // Dia increnentado e formatado
            #echo '<h5>'.date('d/m/Y', strtotime("+$i weekdays",strtotime($data))). '</h5>';
             //Calcula Faltas por dia
            $sqlFaltas = "SELECT distinct matricula.nome, matricula.ra,
            (SELECT sum(if(dia = '$diaF',if(a1='$disciplina',1,0),0)+if(dia = '$diaF',if(a2='$disciplina',1,0),0)
            +if(dia = '$diaF',if(a3='$disciplina',1,0),0)+if(dia like '$diaF',if(a4='$disciplina',1,0),0)
            +if(dia = '$diaF',if(a5='$disciplina',1,0),0)+if(dia = '$diaF',if(a6='$disciplina',1,0),0))
            from faltas where faltas.ra_aluno_falta = matricula.ra) as TotalFaltas
            from matricula left join faltas on matricula.ra = faltas.ra_aluno_falta where matricula.serie = '$serie[0]' and
            turma = '$serie[1]' and escola = '$escola' order by matricula.nome";
            $rows = $conexao->query($sqlFaltas);
            $res = $rows->fetch_all();
            //Se a falta for nula, então coloca zero para poder entender que o aluno veio no dia citado
            if($res[$x][2] == null){
                echo '<td>0</td>';
            }else{
            echo '<td>' . $res[$x][2] . '</td>';
            }
            
        }
        //Calcula total de faltas
        $sqlTotal = "select matricula.nome,
        (select sum(if(a1='$disciplina',1,0 )+if(a2='$disciplina',1,0 )+if(a3='$disciplina',1,0 )+if(a4='$disciplina',1,0 )+if(a5='$disciplina',1,0 )+if(a6='$disciplina',1,0 )) 
        from faltas where faltas.ra_aluno_falta = matricula.ra) as TotalFaltas
        from matricula left join faltas on matricula.ra = faltas.ra_aluno_falta where matricula.serie = '$serie[0]' and
        turma = '$serie[1]' and escola = '$escola'
        order by matricula.nome ";

        $linhas = $conexao->query($sqlTotal);
        $resultado = $linhas->fetch_all();
        if ($resultado[$x][1] == null) {
        echo '<td>0</td>';
        }else{
        echo '<td>'.$resultado[$x][1].'</td>';
        }

        //Calcula a nota que já está na Database do PEB II
        $sqlNota = "SELECT matricula.nome, notas.$dis FROM matricula 
        LEFT JOIN notas ON matricula.ra = notas.ra_aluno_notas where matricula.escola = '$escola' 
        and matricula.serie = '$serie[0]' and matricula.turma = '$serie[1]' 
        and matricula.codigo_classe='$serie[2]' order by nome asc ";
        $notas = $conexao->query($sqlNota);
        $result = $notas->fetch_all();
        if ($result[$x][1] == null) {
            echo '<td>0</td>';
            }else{
            echo '<td>'.$result[$x][1].'</td>';
            }


        echo '</tr>';
        //echo $res[$x][2] . '<br>';
    
    }
}
    
    
    
    
    

    // for($x=0; $x < count($res); $x++ ){
    //     echo '<tr>';
    //     echo '<td>' . $res[$x][0] . '</td>';
    //     echo '<td>' . $res[$x][2] . '</td>';
    //     echo '</tr>';
    //     //echo $res[$x][2] . '<br>';
    // }
    // echo "</table>";
    

    ?>
</body>
</html>