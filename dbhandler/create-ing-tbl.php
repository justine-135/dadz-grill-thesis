<?php
// Create connection
require_once ('connection.php');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE ingridients (
iid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
code VARCHAR(30) NOT NULL,
item_name VARCHAR(30) NOT NULL,
item_group VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
onhand_quantity VARCHAR(50) NOT NULL,
sold VARCHAR(50),
cost INT(10) NOT NULL,
photo VARCHAR(50) NOT NULL,
order_status VARCHAR(10) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>