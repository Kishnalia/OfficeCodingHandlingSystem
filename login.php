<?php

include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"]=='POST'){
    $inputEmail = $_POST['email'];
    $inputPass = $_POST['password'];

    $sql_result = "select * from users where email = '$inputEmail'";
    $result = $conn->query($sql_result);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $hash = $row['password'];
        if(password_verify($inputPass,$hash)){
            $_SESSION['email'] = $row['email'];
            header('location:index.php');
            exit();
        } else {
            echo "yawa ayaw gumana" . $conn->error;
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="email" >email</label>
        <input name="email"  id="name">
        <label for="password" >password</label>
        <input name="password" type="password" id="password">
        <button type="submit">login</button>
    </form>
</body>

    

</html>