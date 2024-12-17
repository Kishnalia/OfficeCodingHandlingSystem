<?php
include 'db.php';


session_start();

if(!isset($_SESSION['email'])){

    header("Location: login.php");
    exit();

}
echo "Welcome, " . htmlspecialchars($_SESSION['email']);

$email = $_SESSION['email'];


echo "welcome" . $email;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="logout.php" method="post"> <button type="submit">logout</button></form>
</body>
</html>