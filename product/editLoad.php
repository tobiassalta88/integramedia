<?php
session_start();
include '../conn.php';

$mysqli  = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";
  exit;
}

$id = $_POST['id'];
$name = $_POST['name'];
$brand = $_POST['brand'];
$price = $_POST['price'];
$id_provider = $_POST['id_provider'];
$expiration_date = $_POST['expiration_date'];;

$sql = "UPDATE products SET name='".$name."', brand='".$brand."', price='".$price."', id_provider='".$id_provider."', expiration_date='".$expiration_date."' WHERE id=".$id;

if ($mysqli->query($sql) === TRUE) {
  $_SESSION['message'] = "Changes were saved successfully.";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$mysqli->close();
?>
