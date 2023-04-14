<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('us-cdbr-east-06.cleardb.net', 'b68c2e8034dbed', '1a709ba9', 'heroku_5042c069d70871f');

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM tbl_account WHERE email='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
    $row = mysqli_fetch_array($results);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $row['email'];
      $_SESSION['admin'] = $row['role'];
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}
    else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>