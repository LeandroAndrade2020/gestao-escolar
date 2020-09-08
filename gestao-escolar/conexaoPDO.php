<?php
    $username = 'u804592639_edu';
    $password = 'Seduc@2020';
    
    // $username = 'root';
    // $password = '';
    
    $host = 'localhost';
    $dbname = 'u804592639_edu';
    $conection = new PDO('mysql:host=localhost;dbname=u804592639_edu', $username, $password);
    $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // ini_set('display_errors', true);
?>