<?php

// Include the database configuration file
require_once "config.php";

// Select data from the "users" table
$sql = "SELECT * FROM tbl_category";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and display the data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
    }
} else {
    echo "No results found.";
}

// Close the database connection
mysqli_close($conn);

?>