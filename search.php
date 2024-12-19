<?php


include 'db.php';

$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';



if ($searchQuery !== ''){
    $sql = "select * from employees where first_name Like ? or last_name Like ? or middle_name like ?";

    
}














?>