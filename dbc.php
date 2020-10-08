<?php
$server = "localhost"; 
$username = "root" ; 
$password = ""; 
$db = "db"; 

$conn = mysqli_connect($server, $username, $password, $db);
if (!$conn) {

  header("Location: 404.php?msg=db");
  exit(); 
}


