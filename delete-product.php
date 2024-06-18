<?php
session_start();
require "connect.php";

$id = $_GET['id'];
$product =getProduct($id);


function getProduct($id){

    $conn = connect();
    $sql ="SELECT * FROM products WHERE id = '$id'";

    if(!$result = $conn -> query($sql)){
        die("Error  getting product" . $conn -> error);
    }
    return $result -> fetch_assoc();
}

function deleteProduct($id){
    $conn =connect();
    $sql = "DELETE FROM products WHERE id = '$id'";

    if(!$conn -> query($sql)){
        die("Error deleting product" . $conn -> error);
    }
    header("location: products.php");
    exit;
}

if(isset($_POST['btn_delete'])){
    $id = $_GET['id'];
    deleteProduct($id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <title>Delete Product</title>
</head>
<body>
<?php include 'main-nav.php' ;?>
    <main class="container">
        <div class="row justiy-content-center">
            <div class="col-3">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-warning display-4"></i>
                    <h2 class="fw-light mb-3 text-danger">Delete Product</h2>
                    <p class="fw-bold mb-0">Are you sure you want to delete " <?= $product['name'] ?> "?</p>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="products.php" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
                <div class="col">
                    <form action="" method="post"><button class="btn btn-outline-secondary w-100" type="submit" name="btn_delete">Delete</button>
                </form>
                </div>
                </div>
            </div>
        </div>
    </main>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
