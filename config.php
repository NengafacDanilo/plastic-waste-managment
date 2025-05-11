<?php session_start();

// init_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL); 

 //session_start

$host = "localhost";
$user = "root";
$password = "";
$database = "waste";

$con = mysqli_connect($host, $user, $password, $database);

// if($con) echo "Database connection successful";
// else die("Couldn't connect to the database");

?>