<?php
session_start();
include '../conn.php';

$mysqli  = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";
  exit;
}

$name = $_POST['name'];
$brand = $_POST['brand'];
$price = $_POST['price'];
$id_provider = $_POST['id_provider'];
$expiration_date = $_POST['expiration_date'];

$sql = "INSERT INTO products (name, brand, price, id_provider, expiration_date) VALUES ('$name', '$brand', '$price', '$id_provider', '$expiration_date')";

if ($mysqli->query($sql) === TRUE) {
  $_SESSION['message'] = "Congratulations, new record created successfully.";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close();
?>
