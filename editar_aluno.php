

    <?php include 'includes/head.php'; ?>
</head>
<body class="container-fluid">


  

    </div>

    <?php 

include "conecta_mysql.php";

    $ra = $_GET['ra']; 


        $sql = "select * from matricula where ra = '$ra'";
        $result = $conexao->query($sql);
    

        foreach($result as $consultas){ echo "<form method='post' action='edita_aluno.php'> 
                
                  <br> Nome: <input name='nome' type='text' value='{$consultas['nome']}'><br>
                  <br>RA <input name='ra' type='text' value='{$consultas['ra']}'>
               <br>digito <input name='digito' type='text' value='{$consultas['digito']}'>
                <br>escola <input name='escola' type='text' value='{$consultas['escola']}'>
 <br>série <input name='serie' type='text' value='{$consultas['serie']}'>
 <br>turma <input name='turma' type='text' value='{$consultas['turma']}'>
 <br>periodo <input name='periodo' type='text' value='{$consultas['periodo']}'>
 <br>numero_chamada <input name='numero_chamada' type='text' value='{$consultas['numero_chamada']}'>
 <br>situacao <input name='situacao' type='text' value='{$consultas['situacao']}'>
 <br>data situacao <input name='data_situacao' type='text' value='{$consultas['data_situacao']}'>


              
                    
                    <br><input type='submit' value='Editar'>    


                    </form> ";
           
        };
  
    ?>
    </body>




