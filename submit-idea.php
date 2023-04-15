<?php
include_once("config.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sqlString = "SELECT * from tbl_post where post_Id='$id'";

  $result = mysqli_query($conn, $sqlString);
  $row = mysqli_fetch_array($result);
  if (isset($_SESSION["username"])) {
    $us = $_SESSION["username"];
    $sqlString = "SELECT * from tbl_account where email= '$us'";
    $result = mysqli_query($conn, $sqlString);
    $row2 = mysqli_fetch_array($result);
    $department = $row2["department_Id"];
    $account = $row2["account_Id"];
  }
?>
  <div id="contact-form" class="cf hidden">
    <form method="POST" enctype="multipart/form-data">
      <div class="half left cf">
        <label class="input-title" for="input-title">Title:</label>
        <input type="text" name="" id="input-name" value="<?php echo $row['title']; ?>" />
        <label class="input-title" for="input-title">Upload FIle (pdf or docx):</label>
        <input type="file" name="file" id="input-subject" />
        <label class="input-title" for="input-title">Incognito mode:</label>
        <select id="input-select" name="anonymous">
          <option value="anonymous">Ẩn danh</option>
          <option value="<?php echo $row2['fullname']; ?>">Tên</option>
        </select>
        </br>
        <label class="input-title" for="input-title">Feedback:</label>
      </div>
      <textarea name="feedback" type="text" id="input-message" placeholder="Message"></textarea>
      <input type="submit" value="Submit" name="postIdea" id="input-submit" />
    </form>
  </div>
<?php }

// Kiểm tra xem biểu mẫu đã được gửi đi chưa
if (isset($_POST['postIdea'])) {

  // Lấy thông tin file
  $file_name = $_FILES['file']['name'];
  $temp_file = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_type = $_FILES['file']['type'];

  // Đường dẫn lưu file trên server
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($file_name);

  // Mảng các loại file được phép tải lên
  $allowed_types = array(
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'text/plain',
    'application/msword', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  );


  // Di chuyển file từ thư mục tạm đến thư mục lưu trữ trên server
 if (move_uploaded_file($temp_file, $target_file)) {
    // Lấy các giá trị từ biểu mẫu
    $anonymous = $_POST['anonymous'];
    $feedback = $_POST['feedback'];
    $file_mime_type = mime_content_type($target_file);
    if (!in_array($file_mime_type, $allowed_types)) {
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Fail!',
        text: 'The file is in the wrong format!',
        icon: 'error',
        button: 'OK',
      })
      });
      </script>";
    } else {
      // Thêm thông tin vào cơ sở dữ liệu
      $sql = "INSERT INTO tbl_feedback (post_Id, anonymous, feedback, file_name, file_path, department_Id, account_Id, likes) 
    VALUES ('$id', '$anonymous', '$feedback', '$file_name', '$target_file', '$department', '$account', '0')";

      mysqli_query($conn, $sql);
echo '<meta http-equiv="refresh" content="0;URL =index.php"/>';
    }
  } else {
    $anonymous = $_POST['anonymous'];
    $feedback = $_POST['feedback'];

    // Thêm thông tin vào cơ sở dữ liệu
    $sql = "INSERT INTO tbl_feedback (post_Id, anonymous, feedback, department_Id, account_Id, likes) 
    VALUES ('$id', '$anonymous', '$feedback', '$department', '$account', '0')";

    if(mysqli_query($conn, $sql)){
          echo "<script>
    $(document).ready(function() { 
    swal({
      title: 'Success!',
      text: 'Submit Success!',
      icon: 'error',
      button: 'OK',
    })
    });
    </script>";
    }
  }

  // Đóng kết nối đến cơ sở dữ liệu
  mysqli_close($conn);
}
?>
