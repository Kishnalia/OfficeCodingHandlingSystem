<?php
session_start();

include 'db.php';

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

        $stmt = $conn->prepare($sql);
        // Bind parameters
        $stmt->bind_param("ssssssssssssi", 
            $first_name, $middle_name, $last_name, 
            $date_of_hired, $tin_number, $sss_number, 
            $philhealth_number, $pag_ibig_number, 
            $date_of_birth, $contact_name, 
            $contact_address, $contact_number, $employee_id);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
            header('Location: index.php'); // Redirect to index page after successful update
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
} else {
    echo "No employee ID provided.";
    exit();
}
?>


<!-- Form for updating employee information -->
<div>
    <h2 style="text-align: center; display: inline-block; margin: 20px; auto; width: 100%;">UPDATE EMPLOYEES INFORMATION</h2>
    <form method="POST" action="update.php?employee_id=<?php echo $employee['employee_id']; ?>">
        <!-- Hidden field to store employee_id -->
        <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">


    <input type="text" name="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>" required>
    <input type="text" name="middle_name" value="<?php echo htmlspecialchars($employee['middle_name']); ?>" required>
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($employee['last_name']); ?>" required>
    <input type="date" name="date_of_hired" value="<?php echo $employee['date_of_hired']; ?>" required>
    <input type="text" name="tin_number" value="<?php echo $employee['tin_number']; ?>" required>
    <input type="text" name="sss_number" value="<?php echo $employee['sss_number']; ?>" required>
    <input type="text" name="philhealth_number" value="<?php echo $employee['philhealth_number']; ?>" required>
    <input type="text" name="pag_ibig_number" value="<?php echo $employee['pag_ibig_number']; ?>" required>
    <input type="date" name="date_of_birth" value="<?php echo $employee['date_of_birth']; ?>" required>
    <input type="text" name="contact_name" value="<?php echo $employee['contact_name']; ?>" required>
    <input type="text" name="contact_address" value="<?php echo $employee['contact_address']; ?>" required>
    <input type="text" name="contact_number" value="<?php echo $employee['contact_number']; ?>" required>

    <button type="submit">Update</button>
</form>
</div>