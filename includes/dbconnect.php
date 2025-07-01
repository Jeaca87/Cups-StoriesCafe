<?php
    $dbServername = "localhost" ;
    $dbEmail = "root";
    $dbPassword = "";
    $dbName = "cs";


    $conn = new mysqli($dbServername, $dbEmail, $dbPassword, $dbName);
    if ($conn->connect_error){
        die ("Failed" .$conn->connect_error);
    }
    else{
        echo "";
    }
?>
