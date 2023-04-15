<?php
 include_once "header.php" ?>
<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .comment-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      margin-top: 75px;
    }

    h1 {
      color: #333;
      text-align: center;
    }

    .button {
      display: inline-block;
      background-color: royalblue;
      color: white;
      padding: 12px 24px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      border: none;
      border-radius: 150px;
      cursor: pointer;
      float: right;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      color: #555;
    }

    input[type="text"],
    textarea {
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);
      font-size: 16px;
      margin-bottom: 20px;
    }

    input[type="file"] {
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    .preview-image {
      max-width: 100%;
      margin-top: 10px;
    }

    .scroll-btn {
      position: fixed;
      top: 100px;
      left: 20px;
      width: 100px;
      height: 50px;
      background-color: royalblue;
      border-radius: 150px;
      color: white;
      text-align: center;
      line-height: 50px;
      font-size: 20px;
      cursor: pointer;
    }

    .a {
      float: right;
      margin-left: 10px;
      margin-top: 10px;
    }
  </style>
</head>

<?php
include_once("config.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sqlString = "SELECT *from tbl_feedback WHERE feedback_Id = '$id'";

  $result = mysqli_query($conn, $sqlString);
  $row = mysqli_fetch_array($result);

  if (isset($_POST['like'])) {
    $feedback_id = $row['feedback_Id'];
    $user_id = $_SESSION['username'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_feedback WHERE feedback_Id = '$feedback_id'");
    $row = mysqli_fetch_array($result);
    $result2 = mysqli_query($conn, "SELECT * FROM tbl_account WHERE email = '$user_id'");
    $row2 = mysqli_fetch_array($result2);
    $name = $row2['fullname'];
    $likes = $row['likes'];
    $liked_by = $row['liked_by'];
    if ($liked_by === null || $liked_by === '') { // Check if $liked_by is null or empty
      $liked_by = array();
    } else {
      $liked_by = json_decode($liked_by, true);
    }

    if (in_array($name, $liked_by)) {
      // User has already liked the post, so unlike it
      $likes -= 1;
      $key = array_search($name, $liked_by);
      unset($liked_by[$key]);
      $liked_by = json_encode(array_values($liked_by));
      echo '<meta http-equiv="refresh" content="0;"';
    } else {
      // User has not liked the post, so like it
      $likes += 1;
      array_push($liked_by, $name);
      $liked_by = json_encode($liked_by);
      echo '<meta http-equiv="refresh" content="0;"';
    }

    // Update the post's likes and liked_by fields
    $sql = "UPDATE tbl_feedback SET likes = $likes, liked_by = '$liked_by' WHERE feedback_Id = '$feedback_id'";
    mysqli_query($conn, $sql);
  }

?>

  <body>
    <div class="comment-container">
      <form method='POST'>
        <label for="content">POST</label>
        <textarea id="content" name="content" rows="5" cols="50" disabled><?php echo $row['feedback']; ?></textarea>
        <div class="actions">
          <button class='button' name='like'>
            <i class='fas fa-solid fa-thumbs-up'></i>: <?php echo $row['likes'] ?>
          </button>
        </div>
      </form>
      <h2>Comments</h2>
      <div id="comment-list">
        <?php
        $sql = "SELECT tc.*, ta.fullname 
                FROM tbl_comment tc, tbl_account ta 
                WHERE ta.account_Id = tc.account_Id 
                AND tc.feedback_Id = '$id'";


        $result = mysqli_query($conn, $sql);  
        if (isset($_GET["function"]) && $_GET["function"] == "del") {
          if (isset($_GET["id"])) {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM tbl_comment WHERE comment_Id='$id'");
            echo '<meta http-equiv="refresh" content="0; '.$_SERVER['HTTP_REFERER'].'">';

          }
        }
        

        while ($row = mysqli_fetch_array($result)) {
        ?>
          <div style="display:flex; justify-content:space-between;">
            <div style="text-align:left;"> <?php echo $row['fullname']; ?></div>
            <div style="text-align:right;"><?php echo $row['date_comment']; ?></div>
          </div>
          <div style="display:flex; justify-content:space-between;">
            <input type="text" readonly value="<?php echo $row['content']; ?>">
            <a class="a" href="?&&function=del&&id=<?php echo $row["comment_Id"]; ?>">
              <span style="color: red; font-size:20px; " class="fas fa-trash"></span></a>
          </div>
        <?php
        }
        ?>
      </div>
      <hr>
      <form action="" method="POST">
        <div id="comment-list">
          <input type="text" name="content">
          <input type="submit" name="submit" value="Submit">
      </form>

    </div>
  <?php }
if (isset($_SESSION['username'])) {
  $us = $_SESSION['username'];
  $sqlString = "SELECT * from tbl_account where email= '$us'";
  $result = mysqli_query($conn, $sqlString);
  $row = mysqli_fetch_array($result);
  $account = $row["account_Id"];
}
// Check if the form was submitted
if (isset($_POST['submit'])) {

  $content = $_POST['content'];
  // Check if content is not empty
  if (!empty($content)) {
    // Prepare the INSERT statement
    $sql = "INSERT INTO tbl_comment (content, feedback_Id, account_Id,active) VALUES ('$content','$id','$account','1')";

    if (mysqli_query($conn, $sql)) {
      echo '<meta http-equiv="refresh" content="0;"';
    } else {
      echo "Error: " . mysqli_error($conn);
    }
    // Close the statement
    // Close the database connection
    mysqli_close($conn);
  }
}

  ?>
  <div><a class="scroll-btn" href="index.php"><i class="fa fa-arrow-circle-left"></i></a></div>
  <script>
    const btn = document.querySelector('.scroll-btn');
    window.addEventListener('scroll', function() {
      // tính toán vị trí mới của nút
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const btnTop = document.documentElement.scrollHeight - document.documentElement.clientHeight - 100;
      const progress = scrollTop / btnTop;
      const newPos = Math.max(0, Math.min(1, progress)) * 0;

      // cập nhật vị trí của nút
      btn.style.transform = `translateY(-${newPos}%)`;
    });
  </script>
  </body>
  <?php include 'footer.php'; ?>
  <script src="jquery.min.js"></script>
  <script src="script.js"></script>

</html>
