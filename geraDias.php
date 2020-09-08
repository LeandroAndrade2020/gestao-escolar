<?php
session_start();
if(!isset($_SESSION['nomePROF'])){
    header('location: index.php');
};
$nome = $_SESSION['nomePROF'];
$escola = $_SESSION['escolaPROF'];
$rg = $_SESSION['rgPROF'];


echo date('d-m-Y', strtotime(' + 2 weekdays'));

include 'conecta_mysql.php';
$y = 0 ;
$z = 0;
    for ($i=10; $i <= 12 ; $i++) { 
        for ($j=1; $j <= 31 ; $j++) {
            if (($i == 12)&&($j == 1)) {
                $z = 0;
                $j = 2;
            }
            $diaGerado = $j."/".$i."/2019";
            echo $y." ".$diaGerado ;
            echo "<br>";



            $y++;
            $z++;
            
            if (($i == 11 )&&($j+1 == 31)) {
                break;
            };
            if (($i == 10)&& $j == 4 ) {
                $z = 0;
                $j = $j + 2;
            }
            if ($z == 5) {
                $z = 0;
                $j = $j + 2 ;
            }
        }

    }

 ?>

