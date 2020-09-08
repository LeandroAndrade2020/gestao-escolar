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
<html lang="en">

<head>
	<?php include 'includes/head.php'; ?>
</head>

<body class="menu container mx-auto text-center">
	



    <table class='table table-hover'>

    <?php 
        $sql = "select nome, rg, id, serie, turma, disciplina, data_nascimento from professor where escola = '$escola' GROUP BY nome HAVING COUNT(*)>0 ";
        $result = $conexao->query($sql);
    

        foreach($result as $consultas){
            echo '<tr>';
       
                echo "<td> <form action='validaprofessor.php'  method='post'> 
                     <input name='professor' type='hidden' value='{$consultas['rg']}'>
                                     <input name='senha' type='hidden' value='{$consultas['data_nascimento']}'>
                    <input type='submit' value='{$consultas['nome']}'> 
                    </form> 
               

                    
                </td>";
            echo '</tr>';
        };
    echo '</table>';
    ?>



	</div>
</body>

</html>