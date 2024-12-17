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
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    <!-- Employee Creation Form -->
     <div hidden id="createModal" style="height: 100vh; width: 100vw;">
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
    <h2>Employee List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Date of Hired</th>
            <th>TIN Number</th>
            <th>SSS Number</th>
            <th>PhilHealth Number</th>
            <th>PAG-IBIG Number</th>
            <th>Date of Birth</th>
            <th>Contact Name</th>
            <th>Contact Address</th>
            <th>Contact Number</th>
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