<?php
include 'db.php';

// // if ($_SERVER["REQUEST_METHOD"] == 'POST') {
// //     $inputEmail = $_POST['email']; // Get the email from the form
// //     $inputPass = $_POST['password']; // Get the password from the form

// //     // Check if the email already exists in the database
// //     $sql_check = "SELECT * FROM users WHERE email = '$inputEmail'";
// //     $result = $conn->query($sql_check);

// //     if ($result->num_rows > 0) {
// //         // If email already exists, show an error
// //         echo "Email already exists. Please use a different email.";
// //     } else {
// //         // Hash the password using password_hash()
// //         $hashedPassword = password_hash($inputPass, PASSWORD_DEFAULT);

// //         // Insert the new user into the database
// //         $sql = "INSERT INTO users (email, password) VALUES ('$inputEmail', '$hashedPassword')";

// //         if ($conn->query($sql) === TRUE) {
// //             echo "Account registered successfully!";
// //         } else {
// //             echo "Error: " . $conn->error;
// //         }
// //     }
// // }









if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $inputEmail = $_POST['email'];
    $inputPass = $_POST['password'];

    $sql_check = "select * from users where email = '$inputEmail'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0){
        echo "kupal gamit ka ibang email!";
    } else 

    $hashpass = password_hash($inputPass, PASSWORD_DEFAULT);
    
    $sql ="INSERT INTO users (email,password) VALUES ('$inputEmail','$hashpass')";

    if($conn->query($sql)){
        echo"nice gumana ang iyong code";
    } else {
        echo "error gague" . $conn->error;
    }

    
}
































?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form action="signup.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
