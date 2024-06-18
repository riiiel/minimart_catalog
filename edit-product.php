<?php
session_start();
require "connect.php";

$id = $_GET['id'];
$product =getProduct($id);

function getAllSections(){
    $conn = connect();
    $sql = "SELECT * FROM sections";
   //if there is no  result  in the query
    if(!$result = $conn -> query($sql)){
        //terminate the script
        die("Error getting sections" . $conn -> error);
    }
    //otherwise return the result of the SQL query
    return $result;
}

function getProduct($id){

    $conn =connect();
    $sql ="SELECT * FROM products WHERE id = '$id'";

    if(!$result = $conn -> query($sql)){
        die("Error  getting product" . $conn -> error);
    }
    return $result -> fetch_assoc();
}

function updateProduct($id,$name, $description,$price,$section_id){
    $conn =connect();
    $sql = "UPDATE products
    SET name ='$name',
    description ='$description',
    price ='$price',
    section_id ='$section_id'
    WHERE id = '$id' "; 

    if(!$conn -> query($sql)){
        die("Error updating product". $conn -> error);
    }
    header("location: products.php");
    exit;
}


if(isset($_POST['btn_update'])){
   $id  =$_GET['id'];
   $name = $_POST['name'];
   $description = $_POST['description'];
   $price = $_POST['price'];
   $section_id = $_POST['section_id'];

   updateProduct( $id, $name, $description, $price, $section_id);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <title>Edit Product</title>
</head>
<body>
<?php include 'main-nav.php' ;?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2 class="fw-light mb-3">Edit Product</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" max="50" required autofocus value="<?= $product['name']?>">
                </div>
                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" autofocus><?= $product['description'] ?></textarea>
                </div>
                    <div class="mb-3">
                        <label for="price" class="form-label small fw-bold">Price</label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="number" name="price" id="price" class="form-control" step="any" required value="<?=$product['price'] ?>">
                        </div>
                </div>
                    <div class="mb-4">
                        <label for="section-id" class="form-label small fw-bold">Section</label>
                        <select name="section_id" id="section_id" class="form-select">
                            <option value="" hidden>Select Section</option>
                            <?php
                              $all_sections = getAllSections();
                              while( $section = $all_sections -> fetch_assoc() ){
                                if( $section['id'] == $product['section_id'] ){
                                    echo "<option value='" . $section['id'] . "' selected>" .$section['name'] . "</option>";
                                }
                             
                                else{
                                echo "<option value='" . $section['id'] ."'>" . $section['name'] . "</option>";
                                    }
                              }
                             ?>
                        </select>
                </div>
                <a href="products.php" class="btn btn-outline-success">Cancel</a>
                <button type="submit" class="btn btn-secondary fw-bold " id="btn_update" name="btn_update">
                  <i class="fa-solid fa-check"></i> Save Changes
                </button>
                </form>
            </div>
        </div>
    </main>







    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>