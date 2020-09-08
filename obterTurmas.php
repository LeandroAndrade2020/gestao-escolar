<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    };

    $nome = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg = $_SESSION['rgPROF'];

    include 'conecta_mysql.php';

    $sql = "select serie, turma from professor where rg = '$rg' and escola = '$escola'";
    $resultado = $conexao->query($sql);

    echo json_encode($resultado->fetch_all(MYSQLI_ASSOC));


?>