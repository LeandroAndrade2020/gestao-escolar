<?php
    session_start();
    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $nome   = $_SESSION['nomePROF'];
    $escola = $_POST['escola'];
    $rg     = $_SESSION['rgPROF'];

    include('conexaoPDO.php');

    try {
        $stmt = $conection->prepare("SELECT serie, turma FROM professor WHERE rg = :rg AND escola = :escola");
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':escola', $escola);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    echo json_encode($resultado);
?>