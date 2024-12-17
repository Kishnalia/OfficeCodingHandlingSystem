<?php
session_start();
include 'db.php';

if($_SERVER["REQUEST_METHOD"]='POST'){
    $inputFname = $_POST['first_name'];
    $inputMname = $_POST['middle_name'];
    $inputLname = $_POST['last_name'];
    $inputDofhired = $_POST['date_of_hired'];
    $inputTin = $_POST['tin_number'];
    $inputSSS = $_POST['sss_number'];
    $inputPhil = $_POST['philhealth_number'];
    $inputPagibig = $_POST['pag_ibig_number'];
    $inputDbirth = $_POST['date_of_birth'];
    $inputCname = $_POST['contact_name'];
    $inputCadd = $_POST['contact_address'];
    $inputContact = $_POST['contact_number'];



    $sql = "insert into employees (first_name,middle_name,last_name,date_of_hired,tin_number,sss_number,philhealth_number,pag_ibig_number,date_of_birth,contact_name,contact_address,contact_number) values ('$inputFname','$inputMname','$inputLname','$inputDofhired',' $inputTin','$inputSSS','$inputPhil','$inputPagibig','$inputDbirth','$inputCname','$inputCadd','$inputContact')";


    if($conn->query($sql)===TRUE){
        echo"The employee has been created!";
        header('location:index.php');
        exit();
    } else {
        echo "error";
    }



}







?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Create Employee</h2>
    <form method="POST" action="create.php">
        <label>First Name:</label> <input type="text" name="first_name" required><br>
        <label>Middle Name:</label> <input type="text" name="middle_name"><br>
        <label>Last Name:</label> <input type="text" name="last_name" required><br>
        <label>Date of Hired:</label> <input type="date" name="date_of_hired" required><br>
        <label>TIN Number:</label> <input type="text" name="tin_number"><br>
        <label>SSS Number:</label> <input type="text" name="sss_number"><br>
        <label>PhilHealth Number:</label> <input type="text" name="philhealth_number"><br>
        <label>PAG-IBIG Number:</label> <input type="text" name="pag_ibig_number"><br>
        <label>Date of Birth:</label> <input type="date" name="date_of_birth" required><br>
        <label>Contact Name:</label> <input type="text" name="contact_name"><br>
        <label>Contact Address:</label> <input type="text" name="contact_address"><br>
        <label>Contact Number:</label> <input type="text" name="contact_number"><br>
        <button type="submit">Create Employee</button>
    </form>

  
</body>
</html> -->