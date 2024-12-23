<?php
include 'db.php';
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);
    $sql = "SELECT * FROM employees WHERE (
            first_name LIKE '%$query%' OR 
            middle_name LIKE '%$query%' OR 
            last_name LIKE '%$query%' OR 
            contact_name LIKE '%$query%') AND  is_deleted = 0";

     $result = $conn->query($sql);

} else {
    $sql = "SELECT * FROM employees where is_deleted = 0";
    $result = $conn->query($sql);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
 
</head>
<body>

    
<nav class="navbar navbar-light bg-body-tertiary" style="margin-bottom:20px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img
        src="image/2.jpeg"
        class="me-2"
        height="50"
        alt="MDB Logo"
        loading="lazy"
      />
      <small>EMPLOYEE INFORMATION MANAGEMENT SYSTEM</small>
    </a>
    <form action='create.php' style='display:inline; '>
    <button class="btn btn-outline-primary" type='submit' onclick='return confirm(\"Are you sure you want to create ?\");'>CREATE EMPLOYEE INFO.</button>
    </form>
    <form action="logout.php" method="post">
    <button type="submit" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-init  data-mdb-ripple-color="dark">LOGOUT</button>
    </form>
  </div>
</nav>

  
   
<h2 style="text-align: center; display: inline-block; margin: 0 auto; width: 100%;">EMPLOYEES INFORMATION LIST</h2>


   
<form method="get" action="index.php" style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
  <input type="text" name="query" class="form-control rounded" placeholder="Search employees" aria-label="Search" style="width: 300px; margin-right: 10px;" />
  <button type="submit" class="btn btn-outline-primary">Search</button>
</form>
<div class="table-responsive">
<table class="table table-hover table-striped">
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
            <th  class="table-dark">Action</th>
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
                    <td> 
                        <form method='POST' action='delete.php' style='display:inline;'>
                            <input type='hidden' name='employee_id' value=".$row['employee_id'].">
                            <button type='submit' onclick='return confirm('Are you sure you want to delete this record?');' >Delete</button>
                        </form>
                     
                        <form method='GET' action='update.php' style='display:inline;'>
                            <input type='hidden' name='employee_id' value=".$row['employee_id'].">
                            <button type='submit' onclick='return confirm(\"Are you sure you want to update this record?\");'>Update</button>
                        </form>
                    </td>

                    
                </tr>"; 
            }
        } else {
            echo "<tr><td colspan='14'>No employees found</td></tr>";
        }
        ?>
    </table>
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
