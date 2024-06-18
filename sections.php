<?php
//we are calling the php file that connects to the database
require 'connect.php';



function deleteSection($section_id){
    $conn = connect();
    $sql = "DELETE FROM `sections` WHERE id = '$section_id'";

    //Condition: if the query is unsuccessful
    if(!$conn -> query($sql)){
        //error message will be displayed while terminating the script
        die("Error deleting section" . $conn -> error);
    }
    header("refresh: 0");
}

function getAllSections(){
    $conn = connect();
    $sql = "SELECT * FROM sections";

    // if there is no result in the query
    if(!$result = $conn -> query($sql)){
        //terminate the script
        die("Error getting sections" . $conn -> error);
    }
    //otherwise return the result of the SQL query
    return $result;

}

function createSection($name){
    $conn = connect(); //this is the function connect() in connect.php file
    $sql = "INSERT INTO sections(`name`) VALUES('$name')"; //the SQL query

    //we are executing the query
    //Condition: if the query is unsuccessful,
    if(!$conn -> query($sql)){
        //error message will be displayed while terminating the script
        die("Error adding new product sectiion" . $conn -> error);
    }
    header("refresh: 0"); //refresh the page after 0 seconds
}



if(isset($_POST['btn_add'])){
    $name = $_POST['name'];
    createSection($name);
}
if(isset($_POST['btn_delete'])){
    $section_id = $_POST['btn_delete'];
    deleteSection($section_id);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <title>Sections</title>
</head>
<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2 class="fw-light mb-3">Sections</h2>
                <!-- Form Start-->
                <div class="mb-3">
                    <form action="" method="post">
                        <div class="row gx-2">
                            <div class="col">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Add a new section" max="50" required autofocus>
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="btn_add" class="btn btn-info w-100 fw-bold">
                                    <i class="fa-solid fa-plus"></i>Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Form End-->

                <!-- Table Start-->
                <table class="table table-sm align-middle text-center">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //pass the return value of getAllSections() to $all_sections
                        $all_sections = getAllSections(); 
                        while($section = $all_sections -> fetch_assoc()){
                            // fetch_assoc() returns an associative array
                            // $section will contain the rows of the table
                            // then we print the contents of the table, similar to print_r($section)
                        ?>
                        <tr>
                            <td><?= $section['id'] ?></td>
                            <td><?= $section['name'] ?></td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" class="btn btn-outline-danger border-0" id="btn_delete" name="btn_delete" value="<?= $section['id'] ?>" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Table End-->
            </div>
        </div>
    </main>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>