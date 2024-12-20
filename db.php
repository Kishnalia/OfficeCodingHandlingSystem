<?php

    $local='localhost';
    $password='';
    $user='root';
    $dbname ='handling';

    $conn = new mysqli($local, $user, $password, $dbname);

    if ($conn->connect_error){
        die("connection error" . $conn->connect_error);
    }

?>