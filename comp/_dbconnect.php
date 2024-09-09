<!-- Code to connect to database -->

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = "phpmyadmin";
$servername = "localhost";
$password = "893305";
$dbname = "users";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Error occured during connecting to server");
}

?>