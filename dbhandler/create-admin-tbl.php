<?php
// Create connection
require_once ('connection.php');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
username VARCHAR(30) NOT NULL,
pwd VARCHAR(100) NOT NULL,
fullname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
contact VARCHAR(50) NOT NULL,
birth_date VARCHAR(50) NOT NULL,
location_address VARCHAR(100) NOT NULL,
is_superuser INT(1),
is_cashier INT(1),
is_waiter INT(1),
is_cook INT(1),
is_cleaner INT(1),
is_active INT(1)
)";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>