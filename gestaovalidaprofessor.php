<?php 
    include 'conecta_mysql.php';
    include 'crud/crud.php';
    session_cache_expire(60);
    session_start();

    $login = $_POST['professor'];
    $senha = $_POST['senha'];


 
    //$sql = "select rgPROF from professor where rgPROF =".$login."and nascimentoPROF =".$senha ;
    $sql = "select * from professor where rg ='".$login."' and data_nascimento ='".$senha."' ";
    $result = $conexao->query($sql);
 
    $a = 0;
    $go = false ;
    if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row['rg'] == $login && $row['data_nascimento']==$senha){
            $go = true;
            
        }
      
    }
    }
    if($go == true){
        $sql = "select * from professor where rg = '".$login."'";
        $consultas = $conexao->query($sql);
        
        foreach($consultas as $consulta){
            $_SESSION["nomePROF"] = $consulta['nome'];
            $_SESSION["escolaPROF"] = $consulta['escola'];
            $_SESSION["seriePROF"] = $consulta['serie'];
            $_SESSION["turmaPROF"] = $consulta['turma'];
            $_SESSION["discPROF"] = $consulta['disciplina'];
            $_SESSION["rgPROF"] = $consulta['rg'];
            $_SESSION["cod_classePROF"] = $consulta['codigo_classe'];
        };

        if ($_SESSION["discPROF"] == "ADM")
           {header('location: menu2.php');} 
       else {header('location: menu3.php');}

    

    }else{
        $_SESSION["nomePROF"] = null;
        header('location: index.php');
    }
    
    $conexao->close();


?>