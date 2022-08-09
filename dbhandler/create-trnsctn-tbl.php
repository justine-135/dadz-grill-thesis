<?php
// Create connection
require_once ('connection.php');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE transactions (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
table_id INT(6) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`order` VARCHAR(1000) NOT NULL,
`total` VARCHAR(50) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>