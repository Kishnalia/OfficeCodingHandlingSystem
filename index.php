<?php
include 'db.php';


session_start();

if(!isset($_SESSION['email'])){

    header("Location: login.php");
    exit();

}


$email = $_SESSION['email'];

// $_SESSION['createModalVisible'] = false;



$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">

<!-- Optional: Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Optional: jQuery (needed for some MDB components) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>

.createEmployee {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color:rgb(2, 2, 2);
            color:white;
            border: 1px solid white;
        }

        .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
#createModal {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    <!-- Employee Creation Form -->
     <div id="createModal" style="height: 100vh; width: 100vw;">
        <div>
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
                <button id="closeCreateModal">Close</button>
                <button id ="subs" type="submit">Submit</button>
            </form>
        </div>
     </div>

    <!-- Display Employee Table -->
    <button id="createEmployee">Create Employee</button>
    <h2>EMPLOYEES INFORATION LIST</h2>
    <table class="table">
        <tr  class="table-dark" style = "background:black;">
            <th  class="table-dark">ID</th>
            <th  class="table-dark">First Name</th>
            <th  class="table-dark">Middle Name</th>
            <th  class="table-dark">Last Name</th>
            <th  class="table-dark">Date of Hired</th>
            <th  class="table-dark">TIN Number</th>
            <th  class="table-dark">SSS Number</th>
            <th  class="table-dark">PhilHealth Number</th>
            <th  class="table-dark">PAG-IBIG Number</th>
            <th  class="table-dark">Date of Birth</th>
            <th  class="table-dark">Contact Name</th>
            <th  class="table-dark">Contact Address</th>
            <th  class="table-dark">Contact Number</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['employee_id'] . "</td>
                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                    <td>" . htmlspecialchars($row['middle_name']) . "</td>
                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                    <td>" . $row['date_of_hired'] . "</td>
                    <td>" . $row['tin_number'] . "</td>
                    <td>" . $row['sss_number'] . "</td>
                    <td>" . $row['philhealth_number'] . "</td>
                    <td>" . $row['pag_ibig_number'] . "</td>
                    <td>" . $row['date_of_birth'] . "</td>
                    <td>" . htmlspecialchars($row['contact_name']) . "</td>
                    <td>" . htmlspecialchars($row['contact_address']) . "</td>
                    <td>" . htmlspecialchars($row['contact_number']) . "</td>
                    
                </tr>";
            }
        } else {
            echo "<tr><td colspan='13'>No employees found</td></tr>";
        }
        ?>
    </table>

   

    

    <!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Social media -->
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
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="https://toyotamaterialhandling-international.com/about-us/local-representation/handling-innovation-incorporated" class="text-reset">HANDLING INNOVATION INC.</a>
          </p>
         
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Km 19 West Service Road, South Luzon Expressway, Marcelo Green
          Paranaque, Philippines</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            sales@toyotaforklifts-philippines.com
          </p>
          <p><i class="fas fa-phone me-3"></i> (+63) 2 8821 1414</p>
         
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-reset fw-bold">JOHN NERI ESCOBELLA & GABRIELLE PEREZ</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
<script>
var modal = document.getElementById("createModal");
var btn = document.getElementById("createEmployee");
var close = document.getElementById("closeCreateModal");
var sub = document.getElementById("subs");

btn.onclick = function(){
    modal.style.display = "block";
}

close.onclick = function() {
  modal.style.display = "none";
}

sub.onclick = function(){
    modal.style.display ="none";
}


    </script>
</body>
</html>