<?php
include 'db.php';

$errorName ="";
$errorPass = "";

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $inputEmail = $_POST['email'];
    $inputPass = $_POST['password'];

  if(empty($_POST['email'])){
    $errorName = "email cannot be empty";
  }else {
    
      $sql_check = "select * from users where email = '$inputEmail'";
      $result = $conn -> query($sql_check);
      if($result->num_rows > 0){
        $errorName ="The email has been registered already find new one";
      
    } 
  }

if (empty($_POST['password'])){
  $errorPass="The password is required";

} else if(empty($errorName)) {
    $passhash = password_hash($inputPass , PASSWORD_DEFAULT);
    $sql = "insert into users (email, password) values ('$inputEmail','$passhash')";

    if($conn->query($sql)){
        echo"nalagay na sa database bubu!!!!";
        header('location:login.php');
    } else {
     echo "error" . $conn->error;
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

<!-- Optional: Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Optional: jQuery (needed for some MDB components) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<section class="vh-100" style="background-color:rgb(0, 0, 0);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="image/123.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:75vh;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post" action="signup.php">

                <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="image/2.jpeg"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:60px" />
                        <span class="h1 fw-bold mb-0">HANDLING INNOVATION INC.</span>
                    </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign up for account!</h5>
                  <span style="color:red"><?php echo $errorName; ?></span>
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" />
                    <label class="form-label" for="email" name="email">Email address</label>
                    
                  </div>
                  
                  <span style="color:red"><?php echo $errorPass; ?></span>
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                    <label class="form-label" name="password" for="password">Password</label>
                    
                  </div>
                 

                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">register</button>
                  </div>

                 
                  <p class="mb-5 pb-lg-2" style="color: #393f81;"> <a href="login.php"
                      style="color: #393f81;">Click here to sign in...</a></p>
              
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>
</html>