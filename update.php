<?php
session_start();

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

// Debugging line to check if employee_id is being passed correctly
// var_dump($_GET);  // Uncomment this line to check the GET parameters

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if employee_id is provided in the URL
if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    // Fetch the employee details from the database
    $sql = "SELECT * FROM employees WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit();
    }

    // Handle form submission for updating employee data
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        // Get updated data from the form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $date_of_hired = $_POST['date_of_hired'];
        $tin_number = $_POST['tin_number'];
        $sss_number = $_POST['sss_number'];
        $philhealth_number = $_POST['philhealth_number'];
        $pag_ibig_number = $_POST['pag_ibig_number'];
        $date_of_birth = $_POST['date_of_birth'];
        $contact_name = $_POST['contact_name'];
        $contact_address = $_POST['contact_address'];
        $contact_number = $_POST['contact_number'];

        if (empty($first_name)) {
            $errFN = "First Name is required.";
            $hasError = true;
        } elseif (preg_match('/\d/', $first_name)) {
            $errFN = "First Name should not contain numbers.";
            $hasError = true;
        }

        if (empty($last_name)) {
            $errLN = "Last Name is required.";
            $hasError = true;
        } elseif (preg_match('/\d/', $last_name)) {
            $errLN = "Last Name should not contain numbers.";
            $hasError = true;
        }

        if (empty($tin_number) || !is_numeric($tin_number) || strlen($tin_number) != 12) {
            $errTin = "TIN is required and should be a 12-digit number.";
            $hasError = true;
        }

        if (empty($sss_number) || !is_numeric($sss_number) || strlen($sss_number) != 10) {
            $errSSS = "SSS is required and should be a 10-digit number.";
            $hasError = true;
        }

        if (empty($philhealth_number) || !is_numeric($philhealth_number) || strlen($philhealth_number) != 12) {
            $errPhil = "PhilHealth is required and should be a 12-digit number.";
            $hasError = true;
        }

        if (empty($pag_ibig_number) || !is_numeric($pag_ibig_number) || strlen($pag_ibig_number) != 12) {
            $errPagibig = "Pag-IBIG is required and should be a 12-digit number.";
            $hasError = true;
        }

        if (empty($date_of_hired)) {
            $errDofhired = "Date of Hire is required.";
            $hasError = true;
        }

        if (empty($date_of_birth)) {
            $errDbirth = "Date of Birth is required.";
            $hasError = true;
        }

        if (empty($contact_name)) {
            $errCname = "Contact Name is required.";
            $hasError = true;
        }

        if (empty($contact_address)) {
            $errCadd = "Contact Address is required.";
            $hasError = true;
        }

        if (empty($contact_number) || !is_numeric($contact_number)) {
            $errContact = "Contact Number is required and should be numeric.";
            $hasError = true;
        }

        if(!$hasError){
            // Update query
            $sql = "UPDATE employees SET 
                    first_name = ?, 
                    middle_name = ?, 
                    last_name = ?, 
                    date_of_hired = ?, 
                    tin_number = ?, 
                    sss_number = ?, 
                    philhealth_number = ?, 
                    pag_ibig_number = ?, 
                    date_of_birth = ?, 
                    contact_name = ?, 
                    contact_address = ?, 
                    contact_number = ? 
                    WHERE employee_id = ?";

            $stmt = $conn->query($sql);
            

            if ($stmt->execute()) {
                echo "Record updated successfully.";
                header('Location: index.php'); // Redirect to index page after successful update
                exit();
            } else {
                echo "Error updating record: " . $stmt->error;
            }
        }
    }
} else {
    echo "No employee ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Information</title>
    <link href="update.css" rel="stylesheet">
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
    <div class="form-container">
        <h2>Update Employee Information</h2>
        <form method="POST" action="update.php?employee_id=<?php echo $employee['employee_id']; ?>">
            <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">

            <div class="form-group">
            
                <div class="col">
                <span style="color:red"><?php echo $errFN; ?></span>
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>" >
                </div>
                <div class="col">
                    <label for="middle_name">Middle Name (optional)</label>
                    <input type="text" name="middle_name" value="<?php echo htmlspecialchars($employee['middle_name']); ?>">
                </div>
                
                <div class="col">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($employee['last_name']); ?>" >
                    <span style="color:red"><?php echo $errLN; ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="date_of_hired">Date of Hired</label>
                    <input type="date" name="date_of_hired" value="<?php echo $employee['date_of_hired']; ?>" >
                </div>
                <div class="col">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="<?php echo $employee['date_of_birth']; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="tin_number">TIN Number</label>
                    <input type="text" name="tin_number" value="<?php echo $employee['tin_number']; ?>">
                </div>
                <div class="col">
                    <label for="sss_number">SSS Number</label>
                    <input type="text" name="sss_number" value="<?php echo $employee['sss_number']; ?>" >
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="philhealth_number">PhilHealth Number</label>
                    <input type="text" name="philhealth_number" value="<?php echo $employee['philhealth_number']; ?>" >
                </div>
                <div class="col">
                    <label for="pag_ibig_number">Pag-IBIG Number</label>
                    <input type="text" name="pag_ibig_number" value="<?php echo $employee['pag_ibig_number']; ?>" >
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="contact_name">Contact Name</label>
                    <input type="text" name="contact_name" value="<?php echo $employee['contact_name']; ?>" >
                </div>
                <div class="col">
                    <label for="contact_address">Contact Address</label>
                    <input type="text" name="contact_address" value="<?php echo $employee['contact_address']; ?>" >
                </div>
                <div class="col">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" value="<?php echo $employee['contact_number']; ?>" >
                </div>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
</body>
</html>
