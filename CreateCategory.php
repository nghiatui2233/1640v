<!DOCTYPE html>
<html>
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
	</style>
</head>
<body>
	<h1>Add Category</h1>
	<form method="post" action="">
		<label for="categoryName">Category Name:</label>
		<input type="text" name="categoryName" required><br><br>
		<input type="submit" id="category_Id"name="submit" value="Add Category">
		<button    style="    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;"     onclick="window.location='categorylist.php'"
>Cancel </button>
	</form>
	<?php
	// Check if the form was submitted
	if (isset($_POST['submit'])) {
		// Get the category name from the form
		$category_name = $_POST['categoryName'];

		// Include the database configuration file
		require_once "config.php";

		// Prepare the INSERT statement

		
$sql = "INSERT INTO tbl_category (categoryName) VALUES ('$category_name')";

if (mysqli_query($conn, $sql)) {
	echo "<script>
	$(document).ready(function() { 
	swal({
	  title: 'Susscess!',
	  text: 'Category added successfully!',
	  icon: 'susscess',
	  button: 'OK',
	})
	});
	</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
		// Close the statement
		// Close the database connection
		mysqli_close($conn);
	}
	?>
</body>
</html>
