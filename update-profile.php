<!DOCTYPE html>
<html>

<head>
  <title>Create Post</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    h3 {
      color: #333;
      text-align: center;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
      max-width: 500px;
      margin: 0 auto;
      margin-top: 100px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #555;
    }

    input[type='text'],
    textarea {
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
      font-size: 16px;
      margin-bottom: 20px;
    }

    input[type='file'] {
      margin-bottom: 20px;
    }

    input[type='submit'] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type='submit']:hover {
      background-color: #555;
    }


    input[type='button'] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type='button']:hover {
      background-color: #555;
    }

    .preview-image {
      max-width: 100%;
      margin-top: 10px;
    }
  </style>
  <script>
    function previewImage() {
      var preview = document.querySelector('.preview-image');
      var file = document.querySelector('input[type=file]').files[0];
      var reader = new FileReader();

      reader.addEventListener(
        'load',
        function() {
          preview.src = reader.result;
        },
        false
      );

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
</head>

<body>
  <?php
  session_start(); 
  include_once "header.php";
  include_once("config.php"); 

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "SELECT * from tbl_account where email='$username' ");
    $row = mysqli_fetch_array($query);

  ?>
    <form action="" method="post">
      <h3>Update Profile</h3>
      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname'] ?>" required />
      <div class="form-group col-md-12">
        <label for="exampleSelect1" class="control-label">Gender</label>
        <select class="form-control" name="gender">
          <?php
          if ($row['gender'] == 0) {
          ?>
            <option value="FeMale" selected>FeMale</option>
            <option value="Male">Male</option>
            <option value="Other">Other</option>
          <?php
          } elseif ($row['gender'] == 1) {
          ?>
            <option value="FeMale">FeMale</option>
            <option value="Male" selected>Male</option>
            <option value="Other">Other</option>
          <?php
          } else {
          ?>
            <option value="FeMale">FeMale</option>
            <option value="Male">Male</option>
            <option value="Other" selected>Other</option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="form-group col-md-12">
        <label for="birthdaytime">Date of birth:</label>
        <input type="date" id="birthdaytime" name="birthdaytime" value="<?php echo $row['date_of_birth'] ?>" />
      </div>
      <div class="form-group col-md-12">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required value="<?php echo $row['address'] ?>" />
      </div>
      <div class="form-group col-md-12">
        <label for="phonenumber">Phone number:</label>
        <input type="text" id="phonenumber" name="phonenumber" required value="<?php echo $row['phone'] ?>" />
      </div>
      <br />
      <input type="submit" name="btnUpdate" value="Update" />
      <input type="button" value="Cancel" onclick="window.location='index.php'" />
    </form>
  <?php
    if (isset($_POST["btnUpdate"])) {
      $fullname = $_POST['fullname'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $phone = $_POST['phonenumber'];
      $date_of_birth = $_POST['birthdaytime'];

      $sqlstring = "UPDATE tbl_account SET 
        fullname='$fullname',
        gender='$gender',
        address='$address',
        phone='$phone',
        date_of_birth='$date_of_birth'
        WHERE email ='$username'";

      if (mysqli_query($conn, $sqlstring)) {
echo "<script>
	$(document).ready(function() { 
	swal({
	  title: 'Susscess!',
	  text: 'Update successfully!',
	  icon: 'susscess',
	  button: 'OK',
	})
	});
	</script>";
      } else {
        echo "<script>
          alert('Error');
        </script>";
      }
    }
  } else {
    header('Location: login.php');
    exit();
  }
  ?>

</body>

</html>
<?php include_once "footer.php" ?>
