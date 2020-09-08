 <?php
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }
    
    $nome_professor   = (isset($_POST['nome']) && (!empty($_POST['nome'])) ? $_POST['nome'] : '');
    $id               = (isset($_POST['id']) && (!empty($_POST['id'])) ? $_POST['id'] : '');
    $rg               = (isset($_POST['rg']) && (!empty($_POST['rg'])) ? $_POST['rg'] : '');
    $escola_2         = (isset($_POST['escola']) && (!empty($_POST['escola'])) ? $_POST['escola'] : '');
    $serie            = (isset($_POST['serie']) && (!empty($_POST['serie'])) ? $_POST['serie'] : '');
    $turma            = (isset($_POST['turma']) && (!empty($_POST['turma'])) ? $_POST['turma'] : '');
    $data_nascimento  = (isset($_POST['data_nascimento']) && (!empty($_POST['data_nascimento'])) ? $_POST['data_nascimento'] : '');
    $disciplina       = (isset($_POST['disciplina']) && (!empty($_POST['disciplina'])) ? $_POST['disciplina'] : '');
    
   include('conexaoPDO.php');

    try {
        $stmt = $conection->prepare("SELECT * FROM professor WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
    
        if(count($resultado) == 1) {
            $update = $conection->prepare("UPDATE professor SET nome = :nome_professor, escola = :escola2, serie = :serie, turma = :turma, data_nascimento = 
                :data_nascimento, rg = :rg, disciplina = :disciplina WHERE id = :id");
            $update->execute(array(
                ':nome_professor'  => $nome_professor,
                ':escola2'         => $escola_2,
                ':serie'           => $serie,
                ':turma'           => $turma,
                ':data_nascimento' => $data_nascimento,
                ':rg'              => $rg,
                ':disciplina'      => $disciplina,
                ':id' => $id
            ));
        }
    
        header('Location: view_conteudo3.php');
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>

