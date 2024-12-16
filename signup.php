<?php
include 'db.php';
if($_SERVER["REQUEST_METHOD"]=='POST'){
    $inputEmail = $_POST['email'];
    $inputPass = $_POST['password'];

    $sql_check = "SELECT * FROM users WHERE email = '$inputEmail'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0){
        echo "ukitnam bobo ka!!!!! magpalit ka ng email bawal yan!!!";
    } else {
        $passHash = password_hash($inputPass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$inputEmail','$passHash')";
        if($conn->query($sql)){
            echo"done gumana ang iyong code ugok ka marunong kana! mag signup";

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
    <form action="signup.php" method="post">
        <label for="email">email</label>
        <input name="email" id="email" type="email">
        <label for="password">password</label>
        <input name="password" id="password" type="password">
        <button type="submit">sign up</button>
    </form>
</body>
</html>