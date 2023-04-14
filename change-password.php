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
    <?php
    session_start(); // Bắt đầu phiên làm việc
    include_once "header.php";
    include_once("config.php"); // Kết nối đến cơ sở dữ liệu

    // Kiểm tra đăng nhập
    if (!isset($_SESSION['username'])) {
        header('Location: login.php'); // Chuyển hướng đến trang đăng nhập
        exit();
    }

    $username = $_SESSION['username'];

    if (isset($_POST["btnUpdate"])) { // Kiểm tra xem form đã được submit hay chưa
        $password = $_POST["password"];

        // Kiểm tra mật khẩu
        if (strlen($password) < 6) {
            echo "<script>
        alert('Mật khẩu phải chứa ít nhất 6 ký tự');
        </script>";
        } else {
            // Mã hóa mật khẩu
            $pass = md5($password);

            // Cập nhật mật khẩu trong cơ sở dữ liệu
            $sqlstring = "UPDATE tbl_account SET 
        password='$pass'
        WHERE email ='$username'";

            if (mysqli_query($conn, $sqlstring)) {
                // Hiển thị thông báo thành công
                echo "
        <script>
          swal({
            title: 'Success!',
            text: 'Change password success',
            icon: 'success',
            button: 'OK',
          })
        </script>";
            } else {
                // Hiển thị thông báo lỗi
                echo "<script>
          alert('Đã xảy ra lỗi khi cập nhật mật khẩu');
        </script>";
            }
        }
    }
    ?>

    <form action="" method="post">
        <h3>Change Password</h3>
        <div class="form-group col-md-12">
            <label for="fullname">New Password:</label>
            <input type="password" name="password" value="" required />
        </div>

        <br />
        <input type="submit" name="btnUpdate" value="Update" />
        <input type="button" value="Cancel" onclick="window.location='index.php'" />
    </form>

</body>

</html>
<?php include_once "footer.php" ?>