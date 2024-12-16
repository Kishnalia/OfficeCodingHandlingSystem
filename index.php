<?php

session_start();

$email="neri";
$password="neri";


if ($_SERVER["REQUEST_METHOD"]=='POST'){
    $inputEmail=$_POST['email'];
    $inputPassword = $_POST['password'];
    
    if ($inputEmail == $email && $inputPassword == $password){
        $_SESSION['email'] = $email;
        header('location:index.php');
        exit();
    }

}

if (isset($_SESSION['email'])){
    echo"welcome" . $_SESSION['email'];
    echo"<form action='logout.php' method='post'><button type='submit'>logout</button></form>";
}else {
    echo "error credentials";
}
















?>