<?php
/* This file serves as the database connection parameters */


function connect(){
    //we are setting the parameters to connect to mySQL.
    $server_name             = "localhost";
    $username               = "root";
    $password                = "root"; //XAMPP password is "", MAMP password is "root"
    $database_name           = "minimart_catalog";

    //Create a connection object named $conn by using mysqli construct.
    $conn = new mysqli($server_name, $username, $password, $database_name);

    //Check the connection
    if($conn -> connect_error){
        //if the connection fails
        die("Connection failed: " . $conn -> connect_error);
        //terminate the script
        //die() is used to terminate the script
        //connect_error() returns an error message if the connection fails
    }
    //if the connection is successful, return the connection object
    return $conn;
}












?>