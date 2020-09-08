<?php 

include "crud.php";
// // $consultas = selecionar("SELECT cliente_nome from cliente ;");
$consultas = consultar("cliente"," id = 141");
if($consultas){
foreach($consultas as $consulta){
    echo "<p>".$consulta["cliente_nome"]."</p>";
    echo "<p>".$consulta["id"]."</p>";
}
}else{
    echo "Ninguem Foi enconrado com esse ID";
}
//--------------------------------------------------------------------------
//altera dados do cliente

// $dados = array(
// "cliente_nome" => "Pedro",
// "cliente_cpf" => "999999999"
// );

// $altera = alterar("cliente",$dados,"id=141")

///--------------------------------


$id = $_GET['id_funcionario'];
// $exclui = deletar("cliente","id=$id");




?>