<?php
session_start();

include 'db.php';

$errFN = "";
$errLN = "";
$errDofhired = "";
$errTin = "";
$errSSS = "";
$errPhil = "";
$errPagibig = "";
$errDbirth = "";
$errCname = "";
$errCadd = "";
$errContact = "";
$hasError = false;

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    // Fetch the employee details
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

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
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

        // Validation
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

        if (empty($contact_number) || !is_numeric($contact_number) || strlen($contact_number) != 12) {
            $errContact = "Contact Number is required and should be numeric with 11 digit.";
            $hasError = true;
        }

        if (!$hasError) {
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
            
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Statement preparation failed: " . $conn->error);
            }

            $stmt->bind_param(
                'ssssssssssssi',
                $first_name,
                $middle_name,
                $last_name,
                $date_of_hired,
                $tin_number,
                $sss_number,
                $philhealth_number,
                $pag_ibig_number,
                $date_of_birth,
                $contact_name,
                $contact_address,
                $contact_number,
                $employee_id
            );

            if (!$stmt->execute()) {
                die("Error executing query: " . $stmt->error);
            } else {
                echo "Record updated successfully.";
                header('Location: index.php');
                exit();
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
               
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>">
                    <span style="color:red"><?php echo $errFN; ?></span>
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
                    <span style="color:red"><?php echo $errDofhired; ?></span>
                </div>
                <div class="col">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="<?php echo $employee['date_of_birth']; ?>">
                    <span style="color:red"><?php echo $errDbirth; ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="tin_number">TIN Number(12digit)</label>
                    <input type="text" name="tin_number" value="<?php echo $employee['tin_number']; ?>">
                    <span style="color:red"><?php echo $errTin; ?></span>
                </div>
                <div class="col">
                    <label for="sss_number">SSS Number(10digit)</label>
                    <input type="text" name="sss_number" value="<?php echo $employee['sss_number']; ?>" >
                    <span style="color:red"><?php echo $errSSS; ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="philhealth_number">PhilHealth Number(12digit)</label>
                    <input type="text" name="philhealth_number" value="<?php echo $employee['philhealth_number']; ?>" >
                    <span style="color:red"><?php echo $errPhil; ?></span>
                </div>
                <div class="col">
                    <label for="pag_ibig_number">Pag-IBIG Number(12digit)</label>
                    <input type="text" name="pag_ibig_number" value="<?php echo $employee['pag_ibig_number']; ?>" >
                    <span style="color:red"><?php echo $errPagibig; ?></span>
                </div>
            </div>
           
            <div style="align-items:center; justify-items:center"><h3>IN CASE OF EMERGENCY CONTACTS</h3></div>
            <div class="form-group">
            <div class="col">
                    <label for="contact_name">Contact Name</label>
                    <input type="text" name="contact_name" value="<?php echo $employee['contact_name']; ?>" >
                    <span style="color:red"><?php echo $errCname; ?></span>
                </div>
              
                <div class="col">
                    <label for="contact_address">Contact Address</label>
                    <input type="text" name="contact_address" value="<?php echo $employee['contact_address']; ?>" >
                    <span style="color:red"><?php echo $errCadd; ?></span>
                </div>
                <div class="col">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" value="<?php echo $employee['contact_number']; ?>" >
                    <span style="color:red"><?php echo $errContact; ?></span>
                </div>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>



    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
  
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>HANDLING INNOVATION INC.
          </h6>
          <p>
          Toyota Material Handling International is a total solution provider within the material handling business. With a leading position in material handling and financial strengths to back it up, we provide worldwide logistic solutions and high-quality products to optimize our customers' operations.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            BRANDS
          </h6>
          <p>
            <a href="#!" class="text-reset">AWithin material handling, we provide you with the total solution, with a lineup consisting of TOYOTA, BT, and RAYMOND brands. </a>
          </p>
         
        </div>
      

   
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
       
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="https://toyotamaterialhandling-international.com/about-us/local-representation/handling-innovation-incorporated" class="text-reset">HANDLING INNOVATION INC.</a>
          </p>
         
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
        
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Km 19 West Service Road, South Luzon Expressway, Marcelo Green
          Paranaque, Philippines</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            sales@toyotaforklifts-philippines.com
          </p>
          <p><i class="fas fa-phone me-3"></i> (+63) 2 8821 1414</p>
         
        </div>
    
      </div>
      
    </div>
  </section>
  


  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-reset fw-bold">JOHN NERI ESCOBELLA & GABRIELLE PEREZ</a>
  </div>
 
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
</body>
</html>
