<?php
include 'db.php';
$errFN="";
$errLN="";
$errDofhired="";
$errTin="";
$errSSS="";
$errPhil="";
$errPagibig="";
$errDbirth="";
$errCname="";
$errCadd="";
$errContact="";
$hasError = false;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
 
    $inputFname = htmlspecialchars($_POST['first_name']);
    $inputMname = htmlspecialchars($_POST['middle_name']);
    $inputLname = htmlspecialchars($_POST['last_name']);
    $inputDofhired = $_POST['date_of_hired'];
    $inputTin = htmlspecialchars($_POST['tin_number']);
    $inputSSS = htmlspecialchars($_POST['sss_number']);
    $inputPhil = htmlspecialchars($_POST['philhealth_number']);
    $inputPagibig = htmlspecialchars($_POST['pag_ibig_number']);
    $inputDbirth = $_POST['date_of_birth'];
    $inputCname = htmlspecialchars($_POST['contact_name']);
    $inputCadd = htmlspecialchars($_POST['contact_address']);
    $inputContact = htmlspecialchars($_POST['contact_number']);

    
    if (empty($inputFname)) {
        $errFN = "First Name is required.";
        $hasError = true;
     } elseif (preg_match('/\d/', $inputFname)) {
         $errFN = "First Name should not contain numbers.";
         $hasError = true;
     }
    
    
     if (empty($inputLname)) {
         $errLN = "Last Name is required.";
         $hasError = true;
     } elseif (preg_match('/\d/', $inputLname)) {
         $errLN = "Last Name should not contain numbers.";
         $hasError = true;
     }
    
     if (empty($inputTin) || !is_numeric($inputTin) || strlen($inputTin) != 12) {
         $errTin = "TIN is required and should be a 12-digit number.";
         $hasError = true;
     }
    
     if (empty($inputSSS) || !is_numeric($inputSSS) || strlen($inputSSS) != 10) {
         $errSSS = "SSS is required and should be a 10-digit number.";
         $hasError = true;
     }
    
     if (empty($inputPhil) || !is_numeric($inputPhil) || strlen($inputPhil) != 12) {
         $errPhil = "PhilHealth is required and should be a 12-digit number.";
         $hasError = true;
     }
    
     if (empty($inputPagibig) || !is_numeric($inputPagibig) || strlen($inputPagibig) != 12) {
         $errPagibig = "Pag-IBIG is required and should be a 12-digit number.";
         $hasError = true;
     }
    
     if (empty($inputDofhired)) {
         $errDofhired = "Date of Hire is required.";
         $hasError = true;
     }
    
     if (empty($inputDbirth)) {
         $errDbirth = "Date of Birth is required.";
         $hasError = true;
     }
    
     if (empty($inputCname)) {
         $errCname = "Contact Name is required.";
         $hasError = true;
     }
    
     if (empty($inputCadd)) {
         $errCadd = "Contact Address is required.";
         $hasError = true;
     }
    
     if (empty($inputContact) || !is_numeric($inputContact)) {
         $errContact = "Contact Number is required and should be numeric.";
         $hasError = true;
     }
    
     if(!$hasError){

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-light bg-body-tertiary" style="margin-bottom:20px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">

      <img
        src="image/2.jpeg"
        class="me-2"
        height="50"
        alt="MDB Logo"
        loading="lazy"
      />
      <small>EMPLOYEE INFORMATION MANAGEMENT SYSTEM</small>
    </a>

    <form action="logout.php" method="post">
    <button type="submit" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-init  data-mdb-ripple-color="dark">LOGOUT</button>
    </form>
  </div>
</nav>
    <div style="padding:200px; padding-left:700px; padding-right:700px; ">
<form action="create.php" method="post" >
 

<h1>EMPLOYEE INFORMATION MANAGEMENT SYSTEM</h1>

  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
        <span style="color:red"><?php echo $errFN; ?></span>
      <div data-mdb-input-init class="form-outline">
        <input type="text" id="first_name"name="first_name" class="form-control" />
        <label class="form-label" for="first_name">First name</label>
      </div>
    </div>
    <div class="col">
    <span style="color:red">(optional)</span>
      <div data-mdb-input-init class="form-outline">
        
        <input type="text" id="middle_name" name="middle_name" class="form-control" />
        <label class="form-label" for="middle_name">Middle name</label>
      </div>
    </div>
    <div class="col">
    <span style="color:red"><?php echo $errLN; ?></span>
      <div data-mdb-input-init class="form-outline">
        <input type="text" id="last_name" name="last_name" class="form-control" />
        <label class="form-label" for="last_name">Last name</label>
      </div>
    </div>
  </div>


  <div class="row mb-4">
    <div class="col">
    <span style="color:red"><?php echo $errDbirth; ?></span>
      <div data-mdb-input-init class="form-outline">
        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth"/>
        <label class="form-label" for="date_of_birth" name="date_of_birth">Date of Birth</label>
      </div>
    </div>
    <div class="col">
    <span style="color:red"><?php echo $errDofhired; ?></span>
      <div data-mdb-input-init class="form-outline">
        <input type="date" id="date_of_hired" name="date_of_hired" class="form-control" />
        <label class="form-label" for="date_of_hired" name="date_of_hired">Date of Hired</label>
      </div>
    </div>

  </div>
  <!-- Text input -->
  <span style="color:red"><?php echo $errTin; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="tin_number" name="tin_number" class="form-control" />
    <label class="form-label" for="tin_number">TIN number</label>
  </div>


  <!-- Text input -->
  <span style="color:red"><?php echo $errSSS; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="sss_number" name="sss_number" class="form-control" />
    <label class="form-label" for="sss_number" name="sss_number">SSS number</label>
  </div>

  <!-- Email input -->
  <span style="color:red"><?php echo $errPhil; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="philhealth_number" name="philhealth_number" class="form-control" />
    <label class="form-label" for="philhealth_number" name= "philhealth_number">Philhealth number</label>
  </div>

  <!-- Number input -->
  <span style="color:red"><?php echo $errPagibig; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="pag_ibig_number" name="pag_ibig_number" class="form-control" />
    <label class="form-label" for="pag_ibig_number">Pag-ibig number</label>
  </div>
  <span style="color:red"><?php echo $errCname; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="contact_name" class="form-control" name="contact_name"/>
    <label class="form-label" for="contact_name">Contact Name</label>
  </div>
  <span style="color:red"><?php echo $errCadd; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="contact_address" class="form-control" name="contact_address" />
    <label class="form-label" for="contact_address">Contact Address</label>
  </div>
  <span style="color:red"><?php echo $errContact; ?></span>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="number" id="contact_number" class="form-control" name="contact_number" />
    <label class="form-label" for="contact_number">Contact Number</label>
  </div>



  <!-- Checkbox -->
  <div class="form-check d-flex justify-content-center mb-4">
   
  </div>
  <!-- Submit button -->
  <button data-mdb-ripple-init type="submit" style="" class="btn btn-primary btn-block mb-4">SAVE</button>
</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
</body>
</html>