<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Collect and sanitize form inputs
    $inputFname = trim($_POST['first_name']);
    $inputMname = trim($_POST['middle_name']);
    $inputLname = trim($_POST['last_name']);
    $inputDofhired = trim($_POST['date_of_hired']);
    $inputTin = trim($_POST['tin_number']);
    $inputSSS = trim($_POST['sss_number']);
    $inputPhil = trim($_POST['philhealth_number']);
    $inputPagibig = trim($_POST['pag_ibig_number']);
    $inputDbirth = trim($_POST['date_of_birth']);
    $inputCname = trim($_POST['contact_name']);
    $inputCadd = trim($_POST['contact_address']);
    $inputContact = trim($_POST['contact_number']);

    // Initialize error messages array
    $errors = [];

    // Validation checks
    if (empty($inputFname)) {
        $errors[] = "First Name is required.";
    } elseif (preg_match('/\d/', $inputFname)) {
        $errors[] = "First Name should not contain numbers.";
    }

    if (empty($inputMname)) {
        $errors[] = "Middle Name is required.";
    } elseif (preg_match('/\d/', $inputMname)) {
        $errors[] = "Middle Name should not contain numbers.";
    }

    if (empty($inputLname)) {
        $errors[] = "Last Name is required.";
    } elseif (preg_match('/\d/', $inputLname)) {
        $errors[] = "Last Name should not contain numbers.";
    }

    if (empty($inputTin) || !is_numeric($inputTin) || strlen($inputTin) != 12) {
        $errors[] = "TIN is required and should be a 12-digit number.";
    }

    if (empty($inputSSS) || !is_numeric($inputSSS) || strlen($inputSSS) != 10) {
        $errors[] = "SSS is required and should be a 10-digit number.";
    }

    if (empty($inputPhil) || !is_numeric($inputPhil) || strlen($inputPhil) != 12) {
        $errors[] = "PhilHealth is required and should be a 12-digit number.";
    }

    if (empty($inputPagibig) || !is_numeric($inputPagibig) || strlen($inputPagibig) != 12) {
        $errors[] = "Pag-IBIG is required and should be a 12-digit number.";
    }

    if (empty($inputDofhired)) {
        $errors[] = "Date of Hire is required.";
    }

    if (empty($inputDbirth)) {
        $errors[] = "Date of Birth is required.";
    }

    if (empty($inputCname)) {
        $errors[] = "Contact Name is required.";
    }

    if (empty($inputCadd)) {
        $errors[] = "Contact Address is required.";
    }

    if (empty($inputContact) || !is_numeric($inputContact)) {
        $errors[] = "Contact Number is required and should be numeric.";
    }

   
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        $modalOpen = true;
        include('index.php');
        exit();
    } else {
      
        $sql = "INSERT INTO employees (first_name, middle_name, last_name, date_of_hired, tin_number, sss_number, philhealth_number, pag_ibig_number, date_of_birth, contact_name, contact_address, contact_number) 
                VALUES ('$inputFname', '$inputMname', '$inputLname', '$inputDofhired', '$inputTin', '$inputSSS', '$inputPhil', '$inputPagibig', '$inputDbirth', '$inputCname', '$inputCadd', '$inputContact')";

        if ($conn->query($sql) === TRUE) {
            echo "The employee has been created!";
            header('location:index.php');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
