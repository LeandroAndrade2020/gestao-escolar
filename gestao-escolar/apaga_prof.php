 <?php
    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    }
   
    $id = (isset($_POST['id']) && (!empty($_POST['id'])) ? $_POST['id'] : '');
    
    try {
        include('conexaoPDO.php');
        
        $stmt = $conection->prepare("SELECT * FROM professor WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        
        if(count($resultado) == 1){
            $delete = $conection->prepare("DELETE FROM professor WHERE id = :id");
            $delete->bindParam(':id', $id, PDO::PARAM_STR);
            $delete->execute();
        }

        echo "<script type='text/javascript'>
                alert('Professor excluído com sucesso!');
                window.location.href = 'view_conteudo3.php';
            </script>";
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>