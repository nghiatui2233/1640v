<!DOCTYPE html>
<html>
<?php include_once "header.php" ?>
<head>
	<title>Add Category</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
		}

		h1 {
			text-align: center;
			color: #333;
		}

		form {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		label {
			display: block;
			margin-bottom: 10px;
			color: #333;
			font-size: 16px;
			font-weight: bold;
		}

		input[type="text"] {
			display: block;
			box-sizing: border-box;
			margin-bottom: 20px;
			padding: 10px;
			width: 100%;
			border-radius: 5px;
			border: 1px solid #ccc;
			font-size: 16px;
			outline: none;
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
	</style>
</head>

<body>
	<h1>Edit Category</h1>
	<form method="post" action="">
		<?php
		include_once("config.php");
		if (isset($_GET["id"])) {
			$id = $_GET['id'];
			$sql = "SELECT * FROM tbl_category where category_Id = '$id'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
		?>

			<label for="categoryName">Category Name:</label>
			<input type="text" name="categoryName" value="<?php echo $row["categoryName"] ?>" required><br>
			<input type="submit" class="site-btn" name="btnUpdate" id="btnUpdate" value="Update" />
			<input type="button" onclick="window.location='categorylist.php'" value="Cancel">
	<?php }?>
	</form>
<?php
			include_once("config.php");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			if (isset($_POST['btnUpdate'])) {
				$name = $_POST['categoryName'];
				$sql = "UPDATE tbl_category SET categoryName='$name' WHERE category_Id = '$id'";
				if (mysqli_query($conn, $sql)) {
					echo "<script>
					$(document).ready(function() { 
					swal({
					  title: 'Susscess!',
					  text: 'Category update successfully!',
					  icon: 'susscess',
					  button: 'OK',
					})
					});
					</script>";
				} else {
					echo "Error updating record: " . mysqli_error($conn);
				}
			}
		mysqli_close($conn);
?>

</body>
<?php include_once "footer.php" ?>
</html>
