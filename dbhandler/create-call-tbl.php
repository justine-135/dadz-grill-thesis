<?php
// Create connection
require_once ('connection.php');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE calls (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
table_id INT(6),
links VARCHAR(1000)
)";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>