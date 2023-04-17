<!DOCTYPE html>
<html>

<head>
  <title>Create Post</title>

  <style>
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
      margin: auto;
      margin-top: 100px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #555;
    }

    input[type='text'],
    textarea,
    input[type='datetime-local'] {
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
      font-size: 16px;
      margin-bottom: 20px;
    }

    select {
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

    .form-group {
      margin-bottom: 20px;
    }

    @media only screen and (max-width: 500px) {
      form {
        max-width: 100%;
      }
    }
  </style>
</head>
<?php include_once "header.php" ?>

<body>

  <?php
  include_once("config.php");
  if (isset($_SESSION['username'])) {
    $admin = $_SESSION['username'];
    $sqlString = "SELECT * from tbl_account where email= '$admin'";
    $result = mysqli_query($conn, $sqlString);
    $row = mysqli_fetch_array($result);
    $department = $row["department_Id"];
    $account_Id = $row["account_Id"];
  }
  if (isset($_POST["btnAdd"])) {


    $title = $_POST["title"];
    $category = $_POST['CategoryList'];
    $date_ending = $_POST['enddate'];
    $content = $_POST['content'];
    $date_end_read = $_POST['enddatecmt'];
    $err = "";

    $sqlstring = "INSERT INTO tbl_post (title, content, date_ending, category_Id, department_Id, account_Id,date_end_read, active) VALUES ('$title','$content','$date_ending','$category','$department','$account_Id','$date_end_read','1')";
    if (mysqli_query($conn, $sqlstring)) {
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Susscess!',
        text: 'Add Susscess',
        icon: 'susscess',
        button: 'OK',
      })
      });
      </script>";
    } else {
      echo "Lỗi: " . mysqli_error($conn);
    }
  }
  ?>


  <form action="" method="post" enctype="multipart/form-data">
    <h3>Create Post</h3>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required />
    <div class="form-group col-md-12">
      <label for="exampleSelect1" class="control-label">Category</label>
      <select class='form-control' name='CategoryList'>
        <option>-- Choose Category --</option>
        <?php
        $sqlstring = "SELECT * from tbl_category";
        $result = mysqli_query($conn, $sqlstring);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <option value="<?php echo $row["category_Id"]; ?>">
            <?php echo $row["categoryName"]; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group col-md-12">
      <label for="enddate">End submit :</label>
      <input type="datetime-local" id="enddate" name="enddate" />
    </div>
    <div class="form-group col-md-12">
      <label for="enddate">End Comment :</label>
      <input type="datetime-local" id="enddatecmt" name="enddatecmt" />
    </div>
    <label for="content">Content:</label>
    <textarea id="content" name="content" rows="5" cols="50" required></textarea>

    <br />
    <input type="submit" name="btnAdd" value="Post" />
    <input type="button" value="Cancel" onclick="window.location='listpost.php'" />
  </form>
</body>
<?php include_once "footer.php" ?>

</html>
