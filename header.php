<?php
session_start();

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}
?>
<?php if (isset($_SESSION['success'])) : ?>
  <div class="error success">
    <h3>
      <?php
      echo $_SESSION['success'];
      unset($_SESSION['success']);
      ?>
    </h3>
  </div>
<?php endif ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="author" content="Bin-It" />
  <meta property="og:url" />
  <meta property="og:type" content="truongbinit" />
  <meta property="og:title" content="Website TruongBin" />
  <meta property="og:description" content="Wellcome to my Website" />

  <title>Feedback</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
  <!--===============================================================================================-->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Latest compiled and minified CSS -->
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <!-- jQuery library -->
  <!--===============================================================================================-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!--===============================================================================================-->
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
  <!--===============================================================================================-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

  <style>
    img {
      width: 120px;

      height: 40px;
      display: block;
      margin: 0 auto;
      border-radius: 15px;
    }
  </style>
</head>

<body onload="time()">
  <?php
  if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- <a class="navbar-brand" href="index.php"><i class="fa fa-user-circle" aria-hidden="true"></i>IdeaManagement</a> -->
          <a class="navbar-brand" href="index.php"><img src="./HatchfulExport-All/linkedin_banner_image_1.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="index.php" data-toggle="tooltip" data-placement="bottom" title="Feedback">Feedback</a>
            </li>
            <li>
              <a href="listpost.php" data-toggle="tooltip" data-placement="bottom" title="Post">Post</a>
            </li>
            <li>
              <a href="categorylist.php" data-toggle="tooltip" data-placement="bottom" title="Category">Category</a>
            </li>
            <li>
              <a href="stafflist.php" data-toggle="tooltip" data-placement="bottom" title="Staff">Staff</a>
            </li>
            <li>
              <a href="Q&A.php" data-toggle="tooltip" data-placement="bottom" title="Quality Assurance Manager">Quality Assurance Manager</a>
            </li>
            <li>
              <a href="department.php" data-toggle="tooltip" data-placement="bottom" title="Department">Department</a>
            </li>
            <li>
              <a href="#" data-toggle="tooltip" data-placement="bottom"><b>
                  <p>Hi, <strong><?php echo $_SESSION['username']; ?></strong></p>
                </b>
              </a>
              <ul class="dropdown">
                <li>
                  <a href="index.php?logout='1'" data-toggle="tooltip" data-placement="bottom">
                    <b>Logout <i class="fas fa-sign-out-alt"></i></b></a>
                </li>
                <li>
                  <a href="update-profile.php" data-toggle="tooltip" data-placement="bottom">
                    <b>Update Profile <i class="fas fa-sign-out-alt"></i></b></a>
                </li>
                <li>
                  <a href="change-password.php" data-toggle="tooltip" data-placement="bottom">
                    <b>Change Password <i class="fas fa-sign-out-alt"></i></b></a>
                </li>
              </ul>
            </li>
            <li><?php include_once('notifications.php'); ?></li>
          </ul>
        </div>
      </div>
    </nav>

  <?php
  } else {
  ?>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="fas fa-bars"></i>
          </button>
          <a class="navbar-brand" href="index.php"><i class="fa fa-user-circle" aria-hidden="true"></i>IdeaManagement</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="index.php" data-toggle="tooltip" data-placement="bottom" title="Feedback">Feedback</a>
            </li>
            <li>
              <a href="#" data-toggle="tooltip" data-placement="bottom"><b>
                  <p>Hi, <strong><?php echo $_SESSION['username']; ?></strong></p>
                </b>
                <span class="caret"></span>
              </a>
              <ul class="dropdown">
                <li>
                  <a href="index.php?logout='1'" data-toggle="tooltip" data-placement="bottom">
                    <b>Logout <i class="fas fa-sign-out-alt"></i></b></a>
                </li>
                <li>
                  <a href="update-profile.php" data-toggle="tooltip" data-placement="bottom">
                    <b>Update Profile <i class="fas fa-sign-out-alt"></i></b></a>
                </li>
                <li>
                  <a href="change-password.php" data-toggle="tooltip" data-placement="bottom">
                    <b>Change Password <i class="fas fa-sign-out-alt"></i></b></a>
                </li>
              </ul>
            </li>
            <li><?php include_once('notifications.php'); ?></li>
          </ul>
        </div>
      </div>
    </nav>
  <?php } ?>
  <!-- notification message -->


  <!-- logged in user information -->
  <?php if (isset($_SESSION['username'])) : ?>
  <?php endif ?>
  </div>

</body>

</html>
