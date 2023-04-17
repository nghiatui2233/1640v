<style>
  .label {
    display: block;
    margin-bottom: 10px;
    color: black;
  }

  input[type="checkbox"] {}

  #submitButton {
    background-color: #666;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    pointer-events: none;
    /* Không cho phép ấn khi tối màu */
  }

  #submitButton.active {
    background-color: royalblue;
    pointer-events: auto;
    /* Cho phép ấn khi sáng màu */
  }

  /* Ẩn checkbox mặc định */
  input[type="checkbox"] {
    display: none;
  }

  /* Tạo hình vuông tùy chỉnh */
  .checkbox {
    display: inline-block;
    width: 16px;
    height: 16px;
    background-color: #fff;
    border: 2px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
    vertical-align: middle;
    margin-right: 5px;
  }

  /* Hiển thị checkmark khi checkbox được check */
  .checkbox::after {
    content: "";
    display: block;
    position: absolute;
    top: 2px;
    left: 6px;
    width: 5px;
    height: 10px;
    border: solid #333;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
    visibility: hidden;
  }

  /* Sáng màu checkbox khi được hover */
  .checkbox:hover {
    background-color: #e0e0e0;
  }

  /* Sáng màu checkbox khi được check */
  input[type="checkbox"]:checked+.checkbox {
    background-color: #007bff;
    border-color: #007bff;
  }

  /* Hiển thị checkmark khi checkbox được check */
  input[type="checkbox"]:checked+.checkbox::after {
    visibility: visible;
  }
  
  /* Style for dialog container */
dialog {
  margin: 0;
  padding: 10px;
  width: 25em;
  max-width: 90%;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  border-radius: 5px;
  background-color: #fff;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
}

/* Style for dialog heading */
dialog h2 {
  font-size: 24px;
  margin: 0 0 10px;
  text-align: center;
  font-style: Helvetica;
}

/* Style for dialog content */
dialog p {
  font-size: 16px;
  margin: 10px 0;
  font-style: italic;
}

/* Style for accept and reject buttons */
dialog button {
  display: block;
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  font-size: 18px;
  text-align: center;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Style for accept button */
#acceptButton {
  background-color: #0096ff;
  color: #fff;
}

/* Style for reject button */
#rejectButton {
  background-color: #ff6666;
  color: #fff;
}

</style>
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
      <br>
        <label style="text-align: center;" for="agree">Click here before submitting</label>
        <input type="checkbox" id="agree" onchange="showDialog()">
      <input type="submit" id="submitButton" value="Submit" name="postIdea" disabled>
    </form>
    <dialog id="termsDialog">
      <h2>Terms of use:</h2>
      <p>- After sending feedback you cannot withdraw</p>
      <p>- Take all responsibility for your idea if it violates ethical, legal standards or has inappropriate content.</p>
      <button id="acceptButton" type="button" onclick="acceptTerms()">Agree</button>
      <button id="rejectButton" type="button" onclick="rejectTerms()">Disagree</button>
    </dialog>

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
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Success!',
        text: 'Add success!',
        icon: 'error',
        button: 'OK',
      })
      });
      </script>";
    }
  } else {
    $anonymous = $_POST['anonymous'];
    $feedback = $_POST['feedback'];

    // Thêm thông tin vào cơ sở dữ liệu
    $sql = "INSERT INTO tbl_feedback (post_Id, anonymous, feedback, department_Id, account_Id, likes) 
    VALUES ('$id', '$anonymous', '$feedback', '$department', '$account', '0')";

    if (mysqli_query($conn, $sql)) {
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
<script>
  function showDialog() {
    var checkBox = document.getElementById("agree");
    var termsDialog = document.getElementById("termsDialog");
    if (checkBox.checked == true) {
      termsDialog.showModal();
    }
  }

  function acceptTerms() {
    var checkBox = document.getElementById("agree");
    var submitButton = document.getElementById("submitButton");
    var termsDialog = document.getElementById("termsDialog");

    checkBox.checked = true;
    termsDialog.close();

    submitButton.classList.add("active");
    submitButton.removeAttribute("disabled");
  }

  function rejectTerms() {
    var checkBox = document.getElementById("agree");
    var submitButton = document.getElementById("submitButton");
    var termsDialog = document.getElementById("termsDialog");

    checkBox.checked = false;
    termsDialog.close();

    submitButton.classList.remove("active");
    submitButton.setAttribute("disabled", true);
  }
</script>
