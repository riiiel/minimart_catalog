<?php
session_start();
require "connect.php";

function getAllproducts(){
      $conn = connect();
      $sql = "SELECT products.id AS id,
                     products.name AS name,
                     products.description AS description,
                     products.price AS price,
                     sections.name AS section
            FROM products
            INNER JOIN sections
            ON products.section_id = sections.id
            ORDER BY products.id DESC";
        
     if(!$result = $conn -> query($sql)){
            //terminate the script
            die("Error getting sections" . $conn -> error);
        }
        //otherwise return the result of the SQL query
        return $result;
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <title>Products</title>
</head>
<body>
    <?php include 'main-nav.php' ;?>
    <main class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-light"> Products</h2>
            </div>
            <div class="col text-end">
                <a href="add-product.php" class="btn btn-success">
                    <i class="fa-solid fa-plus-circle"></i> New Product
                </a>

            </div>
        </div>
        <table class="table table-hover align-middle border">
            <thead class="small table-success">
                <tr>
                    <th>ID</th>
                    <th style="width:250px">NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>SECTION</th>
                    <th style="width:95px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $all_products =getAllProducts();
                   while( $product = $all_products -> fetch_assoc() ){
               
                   
                  
                ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td>$<?= $product['price'] ?></td>
                    <td><?= $product['section'] ?></td>
                    <td>
                      <a href="edit-product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-pencil-alt"></i></a>
                      <a href="delete-product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>