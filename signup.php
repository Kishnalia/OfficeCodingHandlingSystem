<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $inputEmail = $_POST['email'];
    $inputPass = $_POST['password'];


    $sql_check = "SELECT * FROM users WHERE email = '$inputEmail'";
    $result = $conn->query($sql_check);



    if($result -> num_rows > 0){
        echo "hello!! paki ayus email mneron na yan!";
    } else 

    $passhash = password_hash($inputPass , PASSWORD_DEFAULT);
    $sql = "insert into users (email, password) values ('$inputEmail','$passhash')";

    if($conn->query($sql)){
        echo"nalagay na sa database bubu!!!!";
    } else {
     echo "error" . $conn->error;
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
    <form action ="signup.php" method="post">

        <label for="email">email</label>
        <input name="email" id="email" type="email">
        <label for="email">password</label>
        <input name="password" id="password" type="password" >
        <button type="submit">sign up </button>

    </form>
</body>
</html>