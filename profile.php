<?php
session_start();
require "connect.php";
$user = getUser();

$person = array("P"=>"20","R"=>"15","M"=>"30");
echo $person['P'];


function getuser(){
    $conn = connect(); 
    $id   = $_SESSION['id'];//we are transferring the id from the session to the local php variable
    $sql  = "SELECT * FROM users WHERE id = $id";  //getting information regarding

    if(!$result = $conn -> query($sql)){
        die("Error getting user information" . $conn -> error);

    }
    return $result -> fetch_assoc();
}

function updatePhoto($id, $photo_name, $photo_tmp){
    $conn  = connect();
    $sql   = "UPDATE users SET photo = '$photo_name' WHERE id $id";

    if(!$conn -> query($sql)){
        die("Error updating photo" . $conn -> error);
    }
   $destination ="assets/images/" . $photo_name; //we are setting the save locastionn
   move_uploaded_file($photo_tmp,$destination);
   header("refresh:0");
}
if(isset($_POST['btn_upload'])){
    $id     =$_SECTION['id'];
    $photo_name = $_FILES['photo']['name'];
    $photo_temp = $_FILES['photo']['tmp_name'];
    updatePhoto($id,$photo_name,$photo_tmp);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile - <?= $_SESSION['full_name'];?></title>
</head>
<body>
    <?php include 'main-nav.php';?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3 mt-4">
                <?php if($user['photo'] ){   //if user has a photo  ?>
                      <img src="assets/images/<?= $user['photo'] ?>" alt="<?= $user['photo']?>" class="profile-photo d-block mx-auto img-thumbnail">
                      <?php }  else{ ?>
                  <img src="assets/images/placeholder.jpg" alt="" class="profile-photo d-block mx-auto img-thumbnail">
                  <?php } ?>
                 
                  <div class="mt-2 mb-3 text-center">
                    <p class="h4 mb-0"><?=$user['username']?></p>
                    <p><?=$_SESSION['full_name']?></p>
                  </div>

                <form enctype="multipart/form-data" method="post">
                    <div class="input-group mb-2">
                        <input type="file" name="photo" class="form-control">
                        <button type="submit" class="btn btn-outline-secondary" name="btn_upload">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>