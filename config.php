<?php
$host = "us-cdbr-east-06.cleardb.net";
$username = "bdea88aeb912e6";
$password = "61a9eddb";
$database = "heroku_484bc174daa4b81"; 

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>