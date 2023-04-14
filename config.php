<?php
$host = "us-cdbr-east-06.cleardb.net";
$username = "b68c2e8034dbed";
$password = "1a709ba9";
$database = "heroku_5042c069d70871f"; 

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
