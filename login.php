<?php
require "connect.php";

function login($username, $password){
    $conn  = connect();
    $sql = "SELECT * FROM users WHERE username = '$username' ";

  //Check if the query is successful
    if($result = $conn -> query($sql)){
     
      //Check if username exists
        if($result -> num_rows == 1 ){

         $user  =$result -> fetch_assoc();  //feches SQL result and stores it to $user
        //Check if password is correct
        if(password_verify($password, $user['password'])) {


            //store the information from the user to a session variable
            session_start();

            $_SESSION['id']        = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

            //
            header("location: products.php");
            exit;  //terminate the script
    
         } else{echo "<div class='alert alert-danger'>Incorrect password</div>"; } //if password is wrong
        } else{echo "<div class='alert alert-danger'>Username not found.</div>";} //if username is not found
    } else{ die("Error retrieving user: " . $conn -> error);} //if the query is unsucccessful
}


if(isset($_POST['btn_login'])){
    $username =$_POST['username'];
    $password =$_POST['password'];
    login($username, $password);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <title>Minimart Catalog</title>
</head>
<body class="bg-light">
    <div style="height:100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0">
                <div class="card-header text-primary">
                    <h1 class="card-title text-center mb-0">Minimart Catalog</h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">
    
                        <div class="mb-3"><label for="username" class="form-label small fw-bold">Username</label>
                        <input type="text" name="username" id="username" class="form-control" maxlength="15" required>

                    </div>
                        <div class="mb-3"><label for="password" class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>

                    </div>
                      <button type="submit" class="btn btn-primary w-100" name="btn_login">Log in.</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="sign-up.php" class="small">Create Account.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
    
</html>