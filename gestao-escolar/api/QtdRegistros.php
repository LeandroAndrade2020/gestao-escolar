<?php 
    include('../conexaoPDO.php');

    try {
        $stmt = $conection->prepare("SELECT COUNT(*) as total from atividades");
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        echo  json_encode(['total' => $resultado[0]['total']]);

    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>