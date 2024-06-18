<?php
/* This file serves as the database connection parameters */

function connect(){
    //We are setting the parameters to connect to SQL
     $sever_name     ="localhost";
     $username      ="root";
     $password       ="root"; // MAMP password is "root"
     $database_name  ="minimart_catalog";

     //Create a connectio object named conn by using mysqli construct.
     $conn    = new mysqli($server_name,$username, $password,$database_name);

     //Check the connection
     
     if($conn -> connect_error){
        die("Connection faild: " . $conn -> connect_error);
     //terminate the script
     //die is used to terminate the script
     //connect_error() returns an error message if the connection fails
    
     } 
     //if the connection is successful,return the connectioon object
      return $conn;

}






?>