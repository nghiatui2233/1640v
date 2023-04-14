<?php
$host = "us-cdbr-east-06.cleardb.net";
$username = "bd223dd95bff34";
$password = "a962f2f0";
$database = "heroku_34b7fd1b4a79a0f"; 

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
