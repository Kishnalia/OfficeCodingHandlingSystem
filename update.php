<?php 
include 'db.php';
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
        var_dump($_POST); // Debugging form data

        // Get updated data from form
        $employee_id = $_POST['employee_id']; // Ensure this is coming from the hidden input
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
            header('location:index.php');
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
} 
?>





<div>
<h2 style="text-align: center; display: inline-block; margin: 20px; auto; width: 100%;">UPDATE EMPLOYEES INFORMATION </h2>
<form method="POST" action="update.php">
        <!-- Hidden field to store employee_id -->
        <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">

<div class="row mb-4">
<div class="col">
            <div data-mdb-input-init class="form-outline">
                <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $employee['first_name']; ?>" required/>
                <label class="form-label" for="first_name" name="first_name">First name</label>
            </div>
        </div>
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="middle_name" name="middle_name"class="form-control"required  value="<?php echo $employee['middle_name'];?>"/>
    <label class="form-label" name="middle_name" for="middle_name">Middle Name</label>
  </div>
</div>
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="last_name" name="last_name" class="form-control"value="<?php echo $employee['last_name']; ?>" required/>
    <label class="form-label" for="last_name"name="last_name">Last name</label>
  </div>
</div>
</div>
           
<div data-mdb-input-init class="form-outline mb-4">
<input type="date" id="date_of_hired" name="date_of_hired"class="form-control"value="<?php echo $employee['date_of_hired']; ?>"required  />
<label class="form-label" name="date_of_hired" for="date_of_hired">DATE HIRED</label>
</div>
<div class="row mb-4">
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="tin_number" name="tin_number"class="form-control" value="<?php echo $employee['tin_number']; ?>" required />
    <label class="form-label" for="tin_number" name="tin_number">TIN NUMBER</label>
  </div>
</div>
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="sss_number" name="sss_number"class="form-control" value="<?php echo $employee['sss_number']; ?>"  required/>
    <label class="form-label" name="sss_number" for="sss_number">SSS NUMBER</label>
  </div>
</div>
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="philhealth_number" name="philhealth_number" class="form-control" value="<?php echo $employee['philhealth_number']; ?>"  required/>
    <label class="form-label" for="philhealth_number"name="philhealth_number">PHILHEALTH NO.</label>
  </div>
</div>
</div>

<div class="row mb-4">
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="pag_ibig_number" name="pag_ibig_number"class="form-control" value="<?php echo $employee['pag_ibig_number']; ?>"  required/>
    <label class="form-label" for="pag_ibig_number" name="pag_ibig_number">PAG-IBIG NUMBER</label>
  </div>
</div>

<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"value="<?php echo $employee['date_of_birth']; ?>" required/>
    <label class="form-label" for="date_of_birth"name="date_of_birth">DATE OF BIRTH</label>
  </div>
</div>
</div>
            
<h2 style="text-align: center; display: inline-block; margin: 0 auto; width: 100%; margin-bottom:20px;">IN CASE OF EMERGENCY CONTACTS</h2>

            
<div class="row mb-4">
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="contact_name" name="contact_name"class="form-control" value="<?php echo $employee['contact_name']; ?>"  required/>
    <label class="form-label" for="contact_name" name="contact_name">CONTACT NAME</label>
  </div>
</div>
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="contact_address" name="contact_address"class="form-control" value="<?php echo $employee['contact_address']; ?>"  required/>
    <label class="form-label" name="contact_address" for="contact_address">ADDRESS</label>
  </div>
</div>
<div class="col">
  <div data-mdb-input-init class="form-outline">
    <input type="text" id="contact_number" name="contact_number" class="form-control"value="<?php echo $employee['contact_number']; ?>"  required/>
    <label class="form-label" for="contact_number"name="contact_number">CONTACT NUMBER</label>
  </div>
</div>
</div>
            <div style="text-align: center; display: inline-block; margin: 0 auto; width: 100%; margin-bottom:20px;">

<button type="submit" id="subs" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-init  data-mdb-ripple-color="dark" style="margin-bottom:20px; margin-top:50px; margin-left:20px">Submit</button>
</div>
           
        </form>
    </div>
 