<!DOCTYPE html>
<html>

<head>
  <title>Edit Post</title>

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

<body>

  <?php
  include_once("config.php"); // Kết nối đến cơ sở dữ liệu
  include_once("header.php");
  function bind_Category_List($conn, $selectedValue)
  {
    $sqlString = "SELECT * from tbl_category";
    $result = mysqli_query($conn, $sqlString);
    echo "<SELECT name ='CategoryList' class='from-control'>
			<option value='0'>Choose Category</option>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      if ($row['category_Id'] == $selectedValue) {
        echo "<option value ='" . $row['category_Id'] . "' selected>" . $row['categoryName'] . "</option>";
      } else {
        echo "<option value='" . $row['category_Id'] . "'>" . $row['categoryName'] . "</option>";
      }
    }
    echo "</select>";
  }
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlString = "SELECT * from tbl_post where post_Id='$id'";

    $result = mysqli_query($conn, $sqlString);
    $row = mysqli_fetch_array($result);

  ?>

    <form action="" method="post" enctype="multipart/form-data">
      <h3>Edit Post</h3>
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" value="<?php echo $row["title"] ?>" required />

      <div class="form-group col-md-12">
        <label for="exampleSelect1" class="control-label">Category</label>
        <?php bind_Category_List($conn, $row['category_Id']); ?>
        </select>
      </div>
      <div class="form-group col-md-12">
        <label for="enddate">End submit :</label>
        <input type="datetime-local" id="enddate" name="enddate" value="<?php echo $row["date_ending"] ?>" />
      </div>
      <div class="form-group col-md-12">
        <label for="enddate">End submit :</label>
        <input type="datetime-local" id="enddate" name="date_end_read" value="<?php echo $row["date_end_read"] ?>" />
      </div>
      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="5" cols="50" required><?php echo $row["content"] ?></textarea>

      <br />
      <input type="submit" name="btnUpdate" value="Post" />
      <input type="button" value="Cancel" onclick="window.location='listpost.php'" />
    </form>
  <?php
    if (isset($_POST["btnUpdate"])) { // Kiểm tra xem form đã được submit hay chưa
      $title = $_POST["title"];
      $category = $_POST['CategoryList'];
      $date_ending = $_POST['enddate'];
      $date_end_read = $_POST['date_end_read'];
      $content = $_POST['content'];
      $err = "";

      $sqlstring = "UPDATE tbl_post SET 
      title='$title',
      date_ending = '$date_ending',
      date_end_read = '$date_end_read',
      content='$content',
      category_Id = '$category'
      where post_Id ='$id'";
      if (mysqli_query($conn, $sqlstring)) { // Thực hiện truy vấn SQL để thêm sản phẩm mới vào cơ sở dữ liệu
        echo "<script>
        $(document).ready(function() { 
        swal({
          title: 'Susscess!',
          text: 'Update Susscess',
          icon: 'susscess',
          button: 'OK',
        })
        });
        </script>";
      }
    }
  }
  ?>
</body>

</html>
