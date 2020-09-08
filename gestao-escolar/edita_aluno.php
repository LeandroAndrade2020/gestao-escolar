 <?php
    session_start();

    if(!isset($_SESSION['nomePROF'])) {
        header('location: index.php');
    }

    $escola = (isset($_SESSION['escolaPROF']) && (!empty($_SESSION['escolaPROF'])) ? $_SESSION['escolaPROF'] : '');

    $nome_aluno  = (isset($_POST['nome']) && (!empty($_POST['nome'])) ? $_POST['nome'] : '');
    $ra          = (isset($_POST['ra']) && (!empty($_POST['ra'])) ? $_POST['ra'] : '');
    $digito      = (isset($_POST['digito']) && (!empty($_POST['digito'])) ? $_POST['digito'] : '');
    $serie       = (isset($_POST['serie']) && (!empty($_POST['serie'])) ? $_POST['serie'] : '');
    $turma       = (isset($_POST['turma']) && (!empty($_POST['turma'])) ? $_POST['turma'] : '');
    $periodo     = (isset($_POST['periodo']) && (!empty($_POST['periodo'])) ? $_POST['periodo'] : '');
    // $periodo = $_POST['periodo'];
    $numero_chamada = (isset($_POST['numero_chamada']) && (!empty($_POST['numero_chamada'])) ? $_POST['numero_chamada'] : '');
    $situacao       = (isset($_POST['situacao']) && (!empty($_POST['situacao'])) ? $_POST['situacao'] : '');
    $data_situacao  = (isset($_POST['data_situacao']) && (!empty($_POST['data_situacao'])) ? $_POST['data_situacao'] : '');
    $id             = (isset($_POST['id']) && (!empty($_POST['id'])) ? $_POST['id'] : '');
    // var_dump($_POST);

    include('conexaoPDO.php');

    try {
        $stmt = $conection->prepare("SELECT * FROM matricula WHERE ra = :ra");
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->execute();
        
        $resultado = $stmt->fetchAll();
        
        if(count($resultado)) {
            $update = $conection->prepare("UPDATE matricula SET nome = :nome, digito = :digito, escola = :escola, serie = :serie, turma = :turma, 
                periodo = :periodo, numero_chamada = :numero_chamada, situacao = :situacao, data_situacao = :data_situacao WHERE ra = :ra AND escola = :escola 
                AND serie = :serie AND turma = :turma AND id = :id");
            $update->execute(array(
                ':nome'           => $nome_aluno,
                ':digito'         => $digito,
                ':escola'         => $escola,
                ':serie'          => $serie,
                ':turma'          => $turma,
                ':periodo'        => $periodo,
                ':numero_chamada' => $numero_chamada,
                ':situacao'       => $situacao,
                ':data_situacao'  => $data_situacao,
                ':ra'             => $ra,
                ':id'             => $id
            ));
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
    echo "<form action='view_conteudo2.php' method='post' name='nome_do_seu_form'> 
            <input name='serie' type='hidden' value='$serie'>
            <input name='turma' type='hidden' value='$turma'>
        </form>

        <script type='text/javascript'>
            document.nome_do_seu_form.submit()
        </script>";
?>