<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $employee_id = $_POST['employee_id'];

    $sql = "UPDATE employees set is_deleted = 1 where employee_id = ?";
    $result = $conn->prepare($sql);
    $result->bind_param("i",$employee_id);

    if($result->execute()){
        header('location:index.php');
        exit();
    }
     else {
        echo $conn->error;
     }

}

?>