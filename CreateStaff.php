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
  <?php include_once "header.php";
  include_once("config.php");

  if (isset($_POST["btnAdd"])) {
    $fullname = $_POST["fullname"];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $birthdaytime = $_POST['birthdaytime'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $err = "";

    $sqlstring = "INSERT INTO tbl_account (fullname, gender, department_Id, role, date_of_birth, address,phone,email,password) VALUES ('$fullname','$gender','$department','0','$birthdaytime','$address','$phonenumber','$email','e10adc3949ba59abbe56e057f20f883e')";
    if (mysqli_query($conn, $sqlstring)) {
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Susscess!',
        text: 'Add susscess',
        icon: 'susscess',
        button: 'OK',
      }).then(function() {
        window.location.href = '?page=sign-up';
      });
      });
      </script>";

    } else {
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Error!',
        text: 'Add Fail',
        icon: 'error',
        button: 'OK',
      }).then(function() {
        window.location.href = '?page=sign-up';
      });
      });
      </script>";
    }
  }
  ?>

  <form action="" method="post">
    <h3>Create Staff</h3>
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" required />
    <div class="form-group col-md-12">
      <label for="exampleSelect1" class="control-label">Gender</label>
      <select class="form-control" name="gender">
        <option>-- Choose Gender --</option>
        <option>Male</option>
        <option>FeMale</option>
        <option>Other</option>
      </select>
    </div>
    <div class="form-group col-md-12">
      <label for="exampleSelect1" class="control-label">Department</label>
      <select class='form-control' name="department">
        <option>-- Choose Department --</option>
        <?php
        $sqlstring = "SELECT * from tbl_department";
        $result = mysqli_query($conn, $sqlstring);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <option value="<?php echo $row["department_Id"]; ?>">
            <?php echo $row["departmentName"]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group col-md-12">
      <label for="birthdaytime">Date of birth:</label>
      <input type="date" id="birthdaytime" name="birthdaytime" />
    </div>
    <div class="form-group col-md-12">
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required />
    </div>
    <div class="form-group col-md-12">
      <label for="phonenumber">Phone number:</label>
      <input type="text" id="phonenumber" name="phonenumber" required />
    </div>
    <div class="form-group col-md-12">
      <label for="email">Email:</label>
      <input type="email" width="1000px" id="email" name="email" required />
    </div>

    <br />
    <input type="submit" name="btnAdd" value="Add" />
    <input type="submit" value="Cancel" onclick="history.back()" />
  </form>
</body>

</html>
<?php include_once "footer.php" ?>