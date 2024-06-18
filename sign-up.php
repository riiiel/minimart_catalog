<?php
require "connect.php";

function createAccount($first_name, $last_name ,$username , $password){
    $conn     = connect();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql      = "INSERT INTO users(
                 first_name,
                 last_name,
                 username,
                 password
                  )VALUES(
                '$first_name',
                '$last_name',
                '$username',
                '$password'
                 )";
     //checks if query is unsuccessful            

                 if(!$conn  ->  query($sql)){
                    die("Error creating account:" . $conn -> error);
                 }

                 header("location: login.php");
}

if(isset($_POST['btn_signup'])){
    $first_name  = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $username  = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if( $password == $confirm_password){
        createAccount($first_name, $last_name ,$username , $password);
    }
    else{
       echo " <p class='alert alert-danger'>Password and Confirm password do not match.</p>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <title>Sign Up</title>
</head>
<body class="bg-light">
    <div style="height:100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0">
                <div class="card-header text-success">
                    <h1 class="card-title h3 mb-0">Create your account</h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="first-name" class="form-label small fw-bold">First Name</label>
                              <input type="text" name="first_name" id="first-name" class="form-control" maxlength="50" required autofocus>
                        </div>
                        <div class="mb-3"><label for="last-name" class="form-label small fw-bold">Last Name</label>
                              <input type="text" name="last_name" id="last-name" class="form-control" maxlength="50" required>

                    </div>
                        <div class="mb-3"><label for="username" class="form-label small fw-bold">Username</label>
                        <input type="text" name="username" id="username" class="form-control" maxlength="15" required>

                    </div>
                        <div class="mb-3"><label for="password" class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>

                    </div>
                        <div class="mb-5"><label for="confirm-password" class="form-label small fw-bold">Confirm Password</label>
                          <input type="password" name="confirm_password" id="confirm-password" class="form-control" required>
                    </div>
                      <button type="submit" class="btn btn-success w-100" name="btn_signup">Sign Up</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="small"> Already have an account?<a href="login.php">Log in.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>