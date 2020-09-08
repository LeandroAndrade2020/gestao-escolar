 <?php
    include('includes/head.php');
    session_start();

    if(!isset($_SESSION['nomePROF'])){
        header('location: index.php');
    }

    $ra     = $_POST['ra'];
    $serie  = $_POST['serie'];
    $turma  = $_POST['turma'];
    $escola = $_POST['escola'];
    $id     = $_POST['id'];
   
    include('conexaoPDO.php');

    try {
        $stmt = $conection->prepare("select * from matricula where ra = :ra");
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
                
        if(count($resultado) >= 1) {
            $delete = $conection->prepare("delete from matricula where ra = :ra and escola = :escola and turma = :turma and serie = :serie and id = :id");
            $delete->bindParam(':ra', $ra);
            $delete->bindParam(':escola', $escola);
            $delete->bindParam(':turma', $turma);
            $delete->bindParam(':serie', $serie);
            $delete->bindParam(':id', $id);
            $delete->execute();
            
        } else {
            echo 'Erro. Tente novamente mais tarde!';
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
    echo "<form action='view_conteudo2.php' method='post' name='nome_do_seu_form'> 
            <input name='serie' type='hidden' value='$serie'>
            <input name='turma' type='hidden' value='$turma'>
        </form>

        <script type='text/javascript'>
        alert('Aluno excluído com sucesso!');
            document.nome_do_seu_form.submit()
        </script>";
?>