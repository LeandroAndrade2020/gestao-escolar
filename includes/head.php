<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestão Escolar</title>
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css">
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css" media="screen" />

    <link href="plugins/datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="plugins/datepicker/js/datepicker.min.js"></script>
    <script src="assets/js/scripts.js"></script>    

    <div id="nav" style="width: 100%; margim-bottom: 100px;">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0,96,186,0.9); text-align: center;">
            <img src="images/BrasaoCaragua.png" alt="Brasão Caraguatatuba" width="35px" heigth="35px" class="mr-2"><a class="navbar-brand text-white" href="#" style="opacity: 1 !important;">Registro de Atividades</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item dropdown text-white">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu mb-2" aria-labelledby="navbarDropdownMenuLink" style="max-width: 500px; margin: auto;">
                            <a class="dropdown-item text-center" href="calendario.php">Enviar atividades</a>
                            <a class="dropdown-item text-center" href="ver_conteudo.php">Visualizar ou Editar atividades</a>
                            <a class="dropdown-item text-center" href="relatorio_geral.php">Gráficos e Relatórios</a>
                        </div>
                    </li>
                </ul>
                <span class="navbar-text">
                    <?php 
                        if(!isset($_SESSION['nomePROF'])) { 
                            echo '<div class="text-center pt-0 pb-0">
                                    <p class="text-center m-auto text-white">Você ainda não se identificou.</p>
                                </div>';
                        } else {
                            echo '<label class="text-white">' . $_SESSION['nomePROF'] . '</label>';
                            echo '<span class="navbar-text ml-3">
                                    <a href="logout.php" class="btn btn-danger text-white"><b>Sair</b></a>
                                </span>';
                        }
                    ?>
                </span>
            </div>
        </nav>
    </div>

   </br></br></br>



<script>
function makeDate(id) {
    obj = document.getElementById(id);
    vl = obj.value;
    l = vl.toString().length;
    switch(l) {
        case 2:
        obj.value = vl + "/";
        break;
    case 5:
        obj.value = vl + "/";
        break;
    }
}
</script>

</head>